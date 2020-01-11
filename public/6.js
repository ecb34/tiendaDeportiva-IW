(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[6],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/filtro/MarcaFiltro.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/templates/filtro/MarcaFiltro.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);

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
  name: "articulos",
  // Datos que recibe la vista
  props: ['selected_marca'],
  data: function data() {
    // Datos que devuelve la vista EJ: Un objeto nuevo/modificado/borrado
    return {
      marcas: [],
      selection: []
    };
  },
  mounted: function mounted() {
    var items;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function mounted$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            _context.prev = 0;
            console.log("Filtro marcas montado");
            _context.next = 4;
            return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(axios__WEBPACK_IMPORTED_MODULE_1___default.a.get("/api/marcas"));

          case 4:
            items = _context.sent;
            this.marcas = items.data.data; //this.traerMarcas();

            _context.next = 10;
            break;

          case 8:
            _context.prev = 8;
            _context.t0 = _context["catch"](0);

          case 10:
          case "end":
            return _context.stop();
        }
      }
    }, null, this, [[0, 8]]);
  },
  methods: {
    traerMarcas: function traerMarcas() {
      var _this = this;

      axios__WEBPACK_IMPORTED_MODULE_1___default.a.get("/api/marcas").then(function (response) {
        _this.marcas = response.data.data;
      });
    }
  },
  watch: {
    $route: function $route(to, from) {
      this.marcas = [];
      this.selection = [];
    },
    selection: function selection() {
      // Con $emit Devolvemos la lista de articulos ordenadas a la vista padre
      this.$emit('newMarcaSelection', this.selection);
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/filtro/MarcaFiltro.vue?vue&type=template&id=36d6f2c4&":
/*!*******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/templates/filtro/MarcaFiltro.vue?vue&type=template&id=36d6f2c4& ***!
  \*******************************************************************************************************************************************************************************************************************************/
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
    "v-expansion-panel",
    [
      _c("v-expansion-panel-header", [_vm._v("Marcas")]),
      _vm._v(" "),
      _c(
        "v-expansion-panel-content",
        _vm._l(_vm.marcas, function(marca) {
          return _c("v-checkbox", {
            key: marca.id,
            attrs: { label: marca.nombre, value: marca.id },
            model: {
              value: _vm.selection,
              callback: function($$v) {
                _vm.selection = $$v
              },
              expression: "selection"
            }
          })
        }),
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/templates/filtro/MarcaFiltro.vue":
/*!******************************************************************!*\
  !*** ./resources/js/components/templates/filtro/MarcaFiltro.vue ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _MarcaFiltro_vue_vue_type_template_id_36d6f2c4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MarcaFiltro.vue?vue&type=template&id=36d6f2c4& */ "./resources/js/components/templates/filtro/MarcaFiltro.vue?vue&type=template&id=36d6f2c4&");
/* harmony import */ var _MarcaFiltro_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MarcaFiltro.vue?vue&type=script&lang=js& */ "./resources/js/components/templates/filtro/MarcaFiltro.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _MarcaFiltro_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _MarcaFiltro_vue_vue_type_template_id_36d6f2c4___WEBPACK_IMPORTED_MODULE_0__["render"],
  _MarcaFiltro_vue_vue_type_template_id_36d6f2c4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/templates/filtro/MarcaFiltro.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/templates/filtro/MarcaFiltro.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/templates/filtro/MarcaFiltro.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MarcaFiltro_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./MarcaFiltro.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/filtro/MarcaFiltro.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MarcaFiltro_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/templates/filtro/MarcaFiltro.vue?vue&type=template&id=36d6f2c4&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/components/templates/filtro/MarcaFiltro.vue?vue&type=template&id=36d6f2c4& ***!
  \*************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MarcaFiltro_vue_vue_type_template_id_36d6f2c4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./MarcaFiltro.vue?vue&type=template&id=36d6f2c4& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/filtro/MarcaFiltro.vue?vue&type=template&id=36d6f2c4&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MarcaFiltro_vue_vue_type_template_id_36d6f2c4___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MarcaFiltro_vue_vue_type_template_id_36d6f2c4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);