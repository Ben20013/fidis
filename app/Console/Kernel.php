<?php

namespace App\Console;

use App\Console\Commands\TaskDiag;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $job = [];
    protected $job_field = ['job_id', 'job_name', 'openframe_id', 'cycle'];
    protected $shuffle = "\App\Console\Jobs\\";
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Jobs\Openframe\Test::class,
        Commands\TaskDiag::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // 固定定时任务
        // $schedule->command('Openframe:Test')->cron('* * * * *');
        // 动态定时任务
        $this->pushCommands();
        $this->runSchedule($schedule);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }


    /**
     * 向commands添加任务
     * @return null
     */
    protected function pushCommands() {
        $this->job = \DB::table('admin_job')->get($this->job_field)
            ->map(function ($value) {
                return (array)$value;
            })
            ->toArray();
        $this->commands = [];
        foreach ($this->job as $key => $value) {
            $this->commands[$key] = $this->shuffle.$value['openframe_id']."\\".$value['job_name'];
        }
    }

    /**
     * 获取配置文件配置参数
     * @param  [type] $schedule [description]
     * @return null
     */
    protected function runSchedule($schedule) {
        foreach($this->job as $key =>$value){
            // Linux 环境
            $common = $value['openframe_id'].':'.$value['job_name'];
            // $schedule->command($common)->cron($value['cycle'])->runInBackground();
            // // Windows 环境
            $schedule->command($common)->cron($value['cycle']);
        }
    }
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function msgschedule(Schedule $schedule)
    {
        Log::info("entry cron --- Kernel---msgschedule");
        $cronData = (new Route())->RouteAndTpl([],[
            'route_id',
            'route_name',
            'messenger_route.type',
            'pass_id',
            'strategy',
            'schedule',
            'people',
            'messenger_route.description',
            't.content',
            't.tpl_id',
        ],1);
        $start_service = new StartService();
        foreach ($cronData as $route) {
            try{
//                \Log::info($route);
                // 即时
                if ($route['strategy'] === 1) $route["schedule"] = '* * * * *';
                if (empty($route["schedule"]))   throw new \Exception(" schedule is empty");
                $schedule->call(function () use($route,$start_service) {
                    // 驱动路由
                    $start_service->handle($route);
                })->cron($route["schedule"])
                    ->name($route["route_id"])
                    ->withoutOverlapping();

            }catch (\Exception $e) {
                \Log::Error(" is error rule_id is ".$route["route_id"] . " error msg :".$e->getMessage());
                continue;
            }
        }
    }
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function repschedule(Schedule $schedule)
    {
        Log::info("entry cron --- Kernel---repschedule");
        // 添加个redis 缓存 ? 每 2分钟一次查询 、 如果发生添加、增删 将redis缓存更新便是
        $cronData = (new Project())->getProjectForCron();
        foreach ($cronData as $cron) {
            try{
                if (empty($cron["schedule"]))  {
                    Log::Error("project_id " . $cron["project_id"] . " schedule is empty");
                    continue;
                }
                $schedule->call(function () use($cron) {

                    $result = (new ParseJsonService($cron["script"],$cron["template"],["base"=>[

                    ]]))->scriptToExcel();


                    if ($result !== false) {
                        // 写数据
                        /*$user_ids = explode(",", $cron["user_id"]);
                        foreach ($user_ids as $user_id) {
                            $data = [
                                "output_name" => $result[1],
                                "project_id" => $cron["project_id"],
                                "user_id" => $user_id,
                                "description" => $cron['description'],
                                "file"=>$result[0],
                                "created"=>date("Y-m-d H:i:s"),
                            ];
                            $res = (new Output())->change($data);
                            if ($res === false)  Log::info("cron--------output save failed data is ".json_encode($data));
                        }*/
                        $data = [
                            "output_name" => $result[1],
                            "project_id" => $cron["project_id"],
                            "user_id" => $cron["user_id"],
                            "description" => $cron['description'],
                            "file"=>$result[0],
                            "created"=>date("Y-m-d H:i:s"),
                        ];
                        $res = (new Output())->change($data);
                        if ($res === false)  Log::info("cron--------output save failed data is ".json_encode($data));
                        // 开始发送邮件
                        if (!empty($cron["to"])) {
                            $flag = (new EmailService())->preSends($cron["project_id"],$cron["to"],$data=["subject"=>$cron["project_name"]],$attachment=$result);
                            if ($flag === false)  Log::info("cron--------project_id:".$cron["project_id"]."--"."project_name:".$cron["project_name"]."邮件发送失败或者存储失败");
                        }
                        Log::info("cron--------project_id:".$cron["project_id"]."--"."project_name:".$cron["project_name"]."--执行成功! cron-schedule:".$cron["schedule"]);
                    } else {
                        Log::Error("cron--------project_id:".$cron["project_id"]."--"."project_name:".$cron["project_name"]."--执行失败!"."err detail is : " .$result);
                    }

                })->cron($cron["schedule"])
                    ->name($cron["project_id"])
                    ->withoutOverlapping();
            }catch (\Exception $e) {
                Log::Error("cron is error project_id is ".$cron["project_id"] . " error msg :".$e->getMessage());
            }
        }

    }
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function workschedule(Schedule $schedule)
    {
        Log::info("entry cron --- Kernel---workschedule");
        try{
            $schedule->call(function () {
                (new CronService())->entry();
            })->cron("* * * * *")
                ->name("works2_nature")
                ->withoutOverlapping();
        }catch (\Exception $e) {
            Log::Error("works2_nature cron,  error msg :".$e->getMessage());
        }
    }
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function diagschedule(Schedule $schedule)
    {
        Log::info("entry cron --- Kernel---diagschedule");
        // 每月 1号 定时体检
        $schedule->command('TaskDiag')->cron('20 0 1 * *');
        // $schedule->command('TaskDiag')->cron('20 0 * * *');
        // $schedule->command('TaskDiag')->cron('* * * * *');
    }
}
