(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/articulo/ArticulosRecomendado.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/templates/articulo/ArticulosRecomendado.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_owl_carousel__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-owl-carousel */ "./node_modules/vue-owl-carousel/dist/vue-owl-carousel.js");
/* harmony import */ var vue_owl_carousel__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_owl_carousel__WEBPACK_IMPORTED_MODULE_0__);
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
  components: {
    carousel: vue_owl_carousel__WEBPACK_IMPORTED_MODULE_0___default.a
  },
  // Parametros de la vista
  props: {
    snackbar: {
      type: String
    }
  },
  data: function data() {
    // Respuesta
    return {
      articulosRecomendados: []
    };
  },
  mounted: function mounted() {
    var _this = this;

    axios.get('/api/articulos?destacados=1').then(function (response) {
      _this.articulosRecomendados = response.data;
    })["catch"](function (err) {
      console.log(err);
    });
  },
  computed: {}
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/articulo/ArticulosRecomendado.vue?vue&type=template&id=3b71c34a&":
/*!******************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/templates/articulo/ArticulosRecomendado.vue?vue&type=template&id=3b71c34a& ***!
  \******************************************************************************************************************************************************************************************************************************************/
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
  return _c("div", [
    _c("h2", { staticClass: "mt-3" }, [_vm._v("Artículos Recomendados")]),
    _vm._v(" "),
    _vm.articulosRecomendados.length > 0
      ? _c(
          "div",
          [
            _c(
              "carousel",
              {
                staticClass: "mt-5",
                attrs: { loop: false, items: 6, nav: false }
              },
              _vm._l(_vm.articulosRecomendados, function(articulo) {
                return _c(
                  "div",
                  { key: articulo.id },
                  [
                    _c(
                      "v-tooltip",
                      {
                        attrs: { bottom: "", color: "primary" },
                        scopedSlots: _vm._u(
                          [
                            {
                              key: "activator",
                              fn: function(ref) {
                                var on = ref.on
                                return [
                                  _c(
                                    "a",
                                    {
                                      attrs: {
                                        href: "/articulos/" + articulo.id
                                      }
                                    },
                                    [
                                      _c(
                                        "img",
                                        _vm._g(
                                          {
                                            attrs: {
                                              height: "200px",
                                              src: articulo.imagenes[0].url,
                                              alt: articulo.nombre
                                            }
                                          },
                                          on
                                        )
                                      )
                                    ]
                                  )
                                ]
                              }
                            }
                          ],
                          null,
                          true
                        )
                      },
                      [
                        _vm._v(" "),
                        _c("span", [_vm._v(_vm._s(articulo.nombre))])
                      ]
                    )
                  ],
                  1
                )
              }),
              0
            )
          ],
          1
        )
      : _vm._e()
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/templates/articulo/ArticulosRecomendado.vue":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/templates/articulo/ArticulosRecomendado.vue ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ArticulosRecomendado_vue_vue_type_template_id_3b71c34a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ArticulosRecomendado.vue?vue&type=template&id=3b71c34a& */ "./resources/js/components/templates/articulo/ArticulosRecomendado.vue?vue&type=template&id=3b71c34a&");
/* harmony import */ var _ArticulosRecomendado_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ArticulosRecomendado.vue?vue&type=script&lang=js& */ "./resources/js/components/templates/articulo/ArticulosRecomendado.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ArticulosRecomendado_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ArticulosRecomendado_vue_vue_type_template_id_3b71c34a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ArticulosRecomendado_vue_vue_type_template_id_3b71c34a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/templates/articulo/ArticulosRecomendado.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/templates/articulo/ArticulosRecomendado.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************!*\
  !*** ./resources/js/components/templates/articulo/ArticulosRecomendado.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticulosRecomendado_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ArticulosRecomendado.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/articulo/ArticulosRecomendado.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticulosRecomendado_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/templates/articulo/ArticulosRecomendado.vue?vue&type=template&id=3b71c34a&":
/*!************************************************************************************************************!*\
  !*** ./resources/js/components/templates/articulo/ArticulosRecomendado.vue?vue&type=template&id=3b71c34a& ***!
  \************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticulosRecomendado_vue_vue_type_template_id_3b71c34a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ArticulosRecomendado.vue?vue&type=template&id=3b71c34a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/articulo/ArticulosRecomendado.vue?vue&type=template&id=3b71c34a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticulosRecomendado_vue_vue_type_template_id_3b71c34a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticulosRecomendado_vue_vue_type_template_id_3b71c34a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);