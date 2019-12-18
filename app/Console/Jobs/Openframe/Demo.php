<?php
/******************************************************************************
 * Copyright (c) 2019-2021 Mixlinker Networks Inc. <mixiot@mixlinker.com>
 * All rights reserved.
 *
 * This program and the accompanying materials are made available under the
 * terms of the Application License of Mixlinker Networks License and Mixlinker
 * Distribution License which accompany this distribution.
 *
 * The Mixlinker License is available at
 *    [图片]http://www.mixlinker.com/legal/license.html
 * and the Mixlinker Distribution License is available at
 *    [图片]http://www.mixlinker.com/legal/distribution.html
 *
 * Contributors:
 *    Mixlinker Technical Team
 *****************************************************************************/

/**
 * 命名空间定义
 * 格式：App\Console\Jobs\{$OpenframeId}
 * 约定：框架目录名称和{$OpenframeId}相同
 */
namespace App\Console\Jobs\Openframe;
use Illuminate\Console\Command;

/**
 * 类名与文件名称相同
 * 约定：除特别标注，类名(字符串)不能使用
 */
class Demo extends Command {
	/**
	 * 执行命令
	 * 格式：{$OpenframeId}:{$CalssName}
	 *
	 * @var string
	 */
	protected $name = 'Openframe:Demo';

	/**
	 * 入口函数
	 *
	 * @return void
	 */
	public function handle()
	{
		// TODO
	}
}