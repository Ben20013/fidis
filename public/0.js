(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/home.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/home.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    var _this = this;

    return {
      tab0: true,
      tab1: true,
      tab2: true,
      tableData1: this.mockTableData1(),
      tableColumns1: [{
        title: "Name",
        key: "name"
      }, {
        title: "Status",
        key: "status",
        render: function render(h, params) {
          var row = params.row;
          var color = row.status === 1 ? "primary" : row.status === 2 ? "success" : "error";
          var text = row.status === 1 ? "Working" : row.status === 2 ? "Success" : "Fail";
          return h("Tag", {
            props: {
              type: "dot",
              color: color
            }
          }, text);
        }
      }, {
        title: "Portrayal",
        key: "portrayal",
        render: function render(h, params) {
          return h("Poptip", {
            props: {
              trigger: "hover",
              title: params.row.portrayal.length + "portrayals",
              placement: "bottom"
            }
          }, [h("Tag", params.row.portrayal.length), h("div", {
            slot: "content"
          }, [h("ul", _this.tableData1[params.index].portrayal.map(function (item) {
            return h("li", {
              style: {
                textAlign: "center",
                padding: "4px"
              }
            }, item);
          }))])]);
        }
      }, {
        title: "People",
        key: "people",
        render: function render(h, params) {
          return h("Poptip", {
            props: {
              trigger: "hover",
              title: params.row.people.length + "customers",
              placement: "bottom"
            }
          }, [h("Tag", params.row.people.length), h("div", {
            slot: "content"
          }, [h("ul", _this.tableData1[params.index].people.map(function (item) {
            return h("li", {
              style: {
                textAlign: "center",
                padding: "4px"
              }
            }, item.n + "：" + item.c + "People");
          }))])]);
        }
      }, {
        title: "Sampling Time",
        key: "time",
        render: function render(h, params) {
          return h("div", "Almost" + params.row.time + "days");
        }
      }, {
        title: "Updated Time",
        key: "update",
        render: function render(h, params) {
          return h("div", _this.formatDate(_this.tableData1[params.index].update));
        }
      }, {
        title: "Action",
        key: "action",
        width: 150,
        align: "center",
        render: function render(h, params) {
          return h("div", [h("Button", {
            props: {
              type: "primary",
              size: "small"
            },
            style: {
              marginRight: "5px"
            },
            on: {
              click: function click() {
                _this.show(params.index);
              }
            }
          }, "View"), h("Button", {
            props: {
              type: "error",
              size: "small"
            },
            on: {
              click: function click() {
                _this.remove(params.index);
              }
            }
          }, "Delete")]);
        }
      }],
      columns7: [{
        title: "类别",
        key: "name",
        render: function render(h, params) {
          return h("div", [h("Icon", {
            props: {
              type: "person"
            }
          }), h("strong", params.row.name)]);
        },
        width: 150
      }, {
        title: "type-a",
        key: "age"
      }, {
        title: "type-b",
        key: "address"
      }, {
        title: "type-c",
        key: "action",
        align: "center"
      }],
      data6: [{
        name: "姓名",
        age: 18,
        address: "New York No. 1 Lake Park"
      }, {
        name: "性别",
        age: 24,
        address: "London No. 1 Lake Park"
      }, {
        name: "年龄",
        age: 30,
        address: "Sydney No. 1 Lake Park"
      }, {
        name: "出生日期",
        age: 26,
        address: "Ottawa No. 2 Lake Park"
      }]
    };
  },
  methods: {
    handleTabRemove: function handleTabRemove(name) {
      this["tab" + name] = false;
    },
    show: function show(index) {
      this.$Modal.info({
        title: "User Info",
        content: "Name\uFF1A".concat(this.data6[index].name, "<br>Age\uFF1A").concat(this.data6[index].age, "<br>Address\uFF1A").concat(this.data6[index].address)
      });
    },
    remove: function remove(index) {
      this.data6.splice(index, 1);
    },
    changeMenu: function changeMenu() {},
    mockTableData1: function mockTableData1() {
      var data = [];

      for (var i = 0; i < 10; i++) {
        data.push({
          name: "Business" + Math.floor(Math.random() * 100 + 1),
          status: Math.floor(Math.random() * 3 + 1),
          portrayal: ["City", "People", "Cost", "Life", "Entertainment"],
          people: [{
            n: "People" + Math.floor(Math.random() * 100 + 1),
            c: Math.floor(Math.random() * 1000000 + 100000)
          }, {
            n: "People" + Math.floor(Math.random() * 100 + 1),
            c: Math.floor(Math.random() * 1000000 + 100000)
          }, {
            n: "People" + Math.floor(Math.random() * 100 + 1),
            c: Math.floor(Math.random() * 1000000 + 100000)
          }],
          time: Math.floor(Math.random() * 7 + 1),
          update: new Date()
        });
      }

      return data;
    },
    formatDate: function formatDate(date) {
      var y = date.getFullYear();
      var m = date.getMonth() + 1;
      m = m < 10 ? "0" + m : m;
      var d = date.getDate();
      d = d < 10 ? "0" + d : d;
      return y + "-" + m + "-" + d;
    },
    changePage: function changePage() {
      // The simulated data is changed directly here, and the actual usage scenario should fetch the data from the server
      this.tableData1 = this.mockTableData1();
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/home.vue?vue&type=style&index=0&lang=css&":
/*!**********************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/home.vue?vue&type=style&index=0&lang=css& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.demo-tabs-style1 {\n    height: 100%;\n    background: #eeeeee;\n    padding: 0px;\n}\n.demo-tabs-style1 > .ivu-tabs-card {\n    height: 100%;\n}\n.demo-tabs-style1 > .ivu-tabs-card > .ivu-tabs-bar {\n    border-bottom: 0px;\n    margin-bottom: 1px;\n}\n.demo-tabs-style1 > .ivu-tabs-card > .ivu-tabs-content {\n    height: 100%;\n}\n.demo-tabs-style1 > .ivu-tabs-card > .ivu-tabs-content > .ivu-tabs-tabpane {\n    background: #fff;\n    padding: 10px 10px;\n}\n.demo-tabs-style1 > .ivu-tabs.ivu-tabs-card > .ivu-tabs-bar .ivu-tabs-tab {\n    border-color: transparent;\n}\n.demo-tabs-style1 > .ivu-tabs-card > .ivu-tabs-bar .ivu-tabs-tab-active {\n    border-color: #fff;\n}\n.layout {\n    border: 0px solid #d7dde4;\n    background: #f5f7f9;\n    position: relative;\n    border-radius: 0px;\n    overflow: hidden;\n    height: 100%;\n}\n.layout-logo {\n    width: 210px;\n    height: 60px;\n    /* background: #5b6270; */\n    background: url(http://dev.fidis.com/images/logo.png) no-repeat;\n    border-radius: 3px;\n    float: left;\n    position: relative;\n    top: 5px;\n    left: 5px;\n}\n.layout-nav {\n    width: 100px;\n    margin: 0 auto;\n    margin-right: 0px;\n    height: 60px;\n}\n.ivu-layout-header {\n    padding: 0px 10px;\n    height: 60px;\n    line-height: 60px;\n}\n.ivu-menu-horizontal.ivu-menu-light:after {\n    height: 0px;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/home.vue?vue&type=style&index=0&lang=css&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/home.vue?vue&type=style&index=0&lang=css& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./home.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/home.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/home.vue?vue&type=template&id=fa6affac&":
/*!*******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/home.vue?vue&type=template&id=fa6affac& ***!
  \*******************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "layout" },
    [
      _c(
        "Layout",
        { style: { height: "100%" } },
        [
          _c(
            "Sider",
            { style: { background: "#515a6e" }, attrs: { "hide-trigger": "" } },
            [
              _c("Row", { staticStyle: { "background-color": "#ffffff" } }, [
                _c("div", { staticClass: "layout-logo" })
              ]),
              _vm._v(" "),
              _c(
                "Row",
                [
                  _c(
                    "Menu",
                    {
                      attrs: {
                        "active-name": "1-2",
                        theme: "dark",
                        width: "auto",
                        "open-names": ["1"]
                      }
                    },
                    [
                      _c(
                        "Submenu",
                        { attrs: { name: "1" } },
                        [
                          _c(
                            "template",
                            { slot: "title" },
                            [
                              _c("Icon", { attrs: { type: "ios-navigate" } }),
                              _vm._v("Item 1\n                        ")
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c("MenuItem", { attrs: { name: "1-1" } }, [
                            _vm._v("Option 1")
                          ]),
                          _vm._v(" "),
                          _c("MenuItem", { attrs: { name: "1-2" } }, [
                            _vm._v("Option 2")
                          ]),
                          _vm._v(" "),
                          _c("MenuItem", { attrs: { name: "1-3" } }, [
                            _vm._v("Option 3")
                          ])
                        ],
                        2
                      ),
                      _vm._v(" "),
                      _c(
                        "Submenu",
                        { attrs: { name: "2" } },
                        [
                          _c(
                            "template",
                            { slot: "title" },
                            [
                              _c("Icon", { attrs: { type: "ios-keypad" } }),
                              _vm._v("Item 2\n                        ")
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c("MenuItem", { attrs: { name: "2-1" } }, [
                            _vm._v("Option 1")
                          ]),
                          _vm._v(" "),
                          _c("MenuItem", { attrs: { name: "2-2" } }, [
                            _vm._v("Option 2")
                          ])
                        ],
                        2
                      ),
                      _vm._v(" "),
                      _c(
                        "Submenu",
                        { attrs: { name: "3" } },
                        [
                          _c(
                            "template",
                            { slot: "title" },
                            [
                              _c("Icon", { attrs: { type: "ios-analytics" } }),
                              _vm._v("Item 3\n                        ")
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c("MenuItem", { attrs: { name: "3-1" } }, [
                            _vm._v("Option 1")
                          ]),
                          _vm._v(" "),
                          _c("MenuItem", { attrs: { name: "3-2" } }, [
                            _vm._v("Option 2")
                          ])
                        ],
                        2
                      ),
                      _vm._v(" "),
                      _c(
                        "Submenu",
                        { attrs: { name: "4" } },
                        [
                          _c(
                            "template",
                            { slot: "title" },
                            [
                              _c("Icon", { attrs: { type: "ios-filing" } }),
                              _vm._v("Navigation Two\n                        ")
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c("MenuItem", { attrs: { name: "4-1" } }, [
                            _vm._v("Option 5")
                          ]),
                          _vm._v(" "),
                          _c("MenuItem", { attrs: { name: "4-2" } }, [
                            _vm._v("Option 6")
                          ]),
                          _vm._v(" "),
                          _c(
                            "Submenu",
                            { attrs: { name: "5" } },
                            [
                              _c("template", { slot: "title" }, [
                                _vm._v("Submenu")
                              ]),
                              _vm._v(" "),
                              _c("MenuItem", { attrs: { name: "5-1" } }, [
                                _vm._v("Option 7")
                              ]),
                              _vm._v(" "),
                              _c("MenuItem", { attrs: { name: "5-2" } }, [
                                _vm._v("Option 8")
                              ])
                            ],
                            2
                          )
                        ],
                        2
                      ),
                      _vm._v(" "),
                      _c("MenuItem", { attrs: { name: "6-1" } }, [
                        _vm._v("Option 5")
                      ])
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "Layout",
            [
              _c(
                "Header",
                {
                  style: {
                    position: "fixed",
                    background: "#fff",
                    boxShadow: "0 0px 0px 0px rgba(0,0,0,.1)"
                  }
                },
                [
                  _c(
                    "Menu",
                    {
                      attrs: {
                        mode: "horizontal",
                        theme: "light",
                        "active-name": "1"
                      }
                    },
                    [
                      _c(
                        "div",
                        { staticClass: "layout-nav" },
                        [
                          _c(
                            "Dropdown",
                            {
                              staticStyle: { float: "right", "z-index": "99" },
                              on: { "on-click": _vm.changeMenu }
                            },
                            [
                              _c(
                                "a",
                                { attrs: { href: "javascript:void(0)" } },
                                [
                                  _vm._v(
                                    "\n                                admin\n                                "
                                  ),
                                  _c("Icon", {
                                    attrs: { type: "ios-arrow-down" }
                                  })
                                ],
                                1
                              ),
                              _vm._v(" "),
                              _c(
                                "DropdownMenu",
                                { attrs: { slot: "list" }, slot: "list" },
                                [
                                  _c("DropdownItem", [_vm._v("修改密码")]),
                                  _vm._v(" "),
                                  _c(
                                    "DropdownItem",
                                    {
                                      staticStyle: { color: "red" },
                                      attrs: { divided: "", name: "logout" }
                                    },
                                    [_vm._v("退出")]
                                  )
                                ],
                                1
                              )
                            ],
                            1
                          )
                        ],
                        1
                      )
                    ]
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Layout",
                { style: { padding: "0 0", "margin-top": "60px" } },
                [
                  _c(
                    "Content",
                    {
                      staticStyle: { "background-color": "#eeeeee" },
                      style: { padding: "10px 10px" }
                    },
                    [
                      _c(
                        "Row",
                        { staticStyle: { height: "100%" } },
                        [
                          _c(
                            "Col",
                            {
                              staticClass: "demo-tabs-style1",
                              attrs: { span: "24" }
                            },
                            [
                              _c(
                                "Tabs",
                                { attrs: { type: "card" } },
                                [
                                  _c(
                                    "TabPane",
                                    { attrs: { label: "标签一" } },
                                    [
                                      _c("Input", {
                                        staticStyle: {
                                          width: "300px",
                                          "margin-bottom": "0px"
                                        },
                                        attrs: {
                                          placeholder: "Enter something..."
                                        },
                                        model: {
                                          value: _vm.value,
                                          callback: function($$v) {
                                            _vm.value = $$v
                                          },
                                          expression: "value"
                                        }
                                      }),
                                      _vm._v(" "),
                                      _c(
                                        "Button",
                                        {
                                          attrs: {
                                            type: "primary",
                                            icon: "ios-search"
                                          }
                                        },
                                        [_vm._v("搜索")]
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "div",
                                        { staticStyle: { float: "right" } },
                                        [
                                          _c(
                                            "Button",
                                            {
                                              attrs: {
                                                type: "primary",
                                                icon: "ios-add"
                                              }
                                            },
                                            [_vm._v("添加")]
                                          )
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c("Table", {
                                        staticStyle: { "margin-top": "10px" },
                                        attrs: {
                                          data: _vm.tableData1,
                                          columns: _vm.tableColumns1,
                                          border: "",
                                          stripe: ""
                                        }
                                      }),
                                      _vm._v(" "),
                                      _c(
                                        "div",
                                        {
                                          staticStyle: {
                                            margin: "10px",
                                            overflow: "hidden"
                                          }
                                        },
                                        [
                                          _c(
                                            "div",
                                            { staticStyle: { float: "right" } },
                                            [
                                              _c("Page", {
                                                attrs: {
                                                  total: 100,
                                                  current: 1
                                                },
                                                on: {
                                                  "on-change": _vm.changePage
                                                }
                                              })
                                            ],
                                            1
                                          )
                                        ]
                                      )
                                    ],
                                    1
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "TabPane",
                                    { attrs: { label: "标签二" } },
                                    [
                                      _c("Table", {
                                        attrs: {
                                          border: "",
                                          columns: _vm.columns7,
                                          data: _vm.data6
                                        }
                                      })
                                    ],
                                    1
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "TabPane",
                                    { attrs: { label: "标签三" } },
                                    [_vm._v("标签三的内容")]
                                  )
                                ],
                                1
                              )
                            ],
                            1
                          )
                        ],
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () { injectStyles.call(this, this.$root.$options.shadowRoot) }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/js/components/home.vue":
/*!******************************************!*\
  !*** ./resources/js/components/home.vue ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _home_vue_vue_type_template_id_fa6affac___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./home.vue?vue&type=template&id=fa6affac& */ "./resources/js/components/home.vue?vue&type=template&id=fa6affac&");
/* harmony import */ var _home_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./home.vue?vue&type=script&lang=js& */ "./resources/js/components/home.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _home_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./home.vue?vue&type=style&index=0&lang=css& */ "./resources/js/components/home.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _home_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _home_vue_vue_type_template_id_fa6affac___WEBPACK_IMPORTED_MODULE_0__["render"],
  _home_vue_vue_type_template_id_fa6affac___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/home.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/home.vue?vue&type=script&lang=js&":
/*!*******************************************************************!*\
  !*** ./resources/js/components/home.vue?vue&type=script&lang=js& ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_home_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./home.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/home.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_home_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/home.vue?vue&type=style&index=0&lang=css&":
/*!***************************************************************************!*\
  !*** ./resources/js/components/home.vue?vue&type=style&index=0&lang=css& ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_home_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./home.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/home.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_home_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_home_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_home_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_home_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_home_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/components/home.vue?vue&type=template&id=fa6affac&":
/*!*************************************************************************!*\
  !*** ./resources/js/components/home.vue?vue&type=template&id=fa6affac& ***!
  \*************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_home_vue_vue_type_template_id_fa6affac___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./home.vue?vue&type=template&id=fa6affac& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/home.vue?vue&type=template&id=fa6affac&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_home_vue_vue_type_template_id_fa6affac___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_home_vue_vue_type_template_id_fa6affac___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);