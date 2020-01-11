(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************/
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
  name: "articulos",
  // Datos que recibe la imagen
  props: ['articulos'],
  data: function data() {
    // Datos que puede devolver la vista
    return {
      // cosas necesarias
      listaArticulos: [],
      listaArticulosSinFiltro: [],
      mostrar_snackbar: false,
      snackbar: "",
      panel: [1, 2],
      // Con [1,2] se indica que paneles han de estar expandidos
      loading: true,
      // filtrado de categorias
      selection: [],
      // filtrado de precios
      rangoPrecio: [0, 0],
      MAX: 0,
      // filtrado de valoraciones
      rating: 0,
      // filtrado de marcas
      selected_marca: []
    };
  },
  mounted: function mounted() {
    var cat;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.async(function mounted$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            _context.prev = 0;
            console.log("Filtro articulos montado");
            this.traerArticulos();
            _context.next = 5;
            return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.awrap(axios__WEBPACK_IMPORTED_MODULE_1___default.a.get("/api/categorias"));

          case 5:
            cat = _context.sent;
            this.items = cat.data;
            _context.next = 12;
            break;

          case 9:
            _context.prev = 9;
            _context.t0 = _context["catch"](0);
            console.log(_context.t0.response);

          case 12:
          case "end":
            return _context.stop();
        }
      }
    }, null, this, [[0, 9]]);
  },
  methods: {
    /** INICIO - Llenar las listas */
    traerArticulos: function traerArticulos() {
      var _this = this;

      this.loading = true;
      axios__WEBPACK_IMPORTED_MODULE_1___default.a.get("/api/articulos").then(function (response) {
        _this.listaArticulos = response.data.filter(_this.filtrarArticulos);
        _this.MAX = _this.listaArticulos.reduce(function (res, current) {
          return current.pvp > res ? current.pvp : res;
        }, -1);
        _this.rangoPrecio[1] = _this.MAX;
        _this.loading = false;
        _this.listaArticulosSinFiltro = _this.listaArticulos;
      })["catch"](function (error) {
        console.log(error);
      });
    },

    /** FIN - Llenar las listas */

    /************************************************************/

    /** INICIO Obtener DATOS desde los TEMPLATES */
    getFiltroCategoria: function getFiltroCategoria(newCategoriaSelection) {
      console.log("Get filtro categoria = ", newCategoriaSelection);
      this.selection = newCategoriaSelection;
    },
    getFiltroMinMax: function getFiltroMinMax(newMinMax) {
      console.log("Get filtro precio (Min,Max)", newMinMax);
      this.rangoPrecio[0] = newMinMax.min;
      this.rangoPrecio[1] = newMinMax.max;
      this.filtroGeneral();
    },
    getFiltroValoracion: function getFiltroValoracion(newRating) {
      console.log("Get filtro rating = ", newRating);
      this.rating = newRating;
    },
    getFiltroMarca: function getFiltroMarca(newMarcaSelection) {
      console.log("Get filtro marca = ", newMarcaSelection);
      this.selected_marca = newMarcaSelection;
    },

    /** FIN - Obtener DATOS desde los TEMPLATES */

    /*************************************************************/

    /** INICIO - FILTRAR la lista de articulos */
    filtrarArticulos: function filtrarArticulos(articulo) {
      if (this.$route.query.q) {
        return articulo.nombre.toUpperCase().includes(this.$route.query.q.toUpperCase());
      } else if (this.$route.name === "hombre" && (articulo.genero == 0 || articulo.genero == 2)) {
        return true;
      } else if (this.$route.name === "mujer" && (articulo.genero == 1 || articulo.genero == 2)) {
        return true;
      } else if (this.$route.name === "articulos") {
        return true;
      }

      return false;
    },
    filtrarPorCategoria: function filtrarPorCategoria() {
      var _this2 = this;

      if (this.selection.length == 0) this.listaArticulos = this.listaArticulosSinFiltro;else {
        this.listaArticulos = this.listaArticulosSinFiltro.filter(function (articulo) {
          return _this2.selection.some(function (s) {
            return s.id == articulo.categoria_id;
          });
        });
      }
    },
    filtrarPorPrecio: function filtrarPorPrecio() {
      var _this3 = this;

      console.log("filtro precio (Min,Max)", this.rangoPrecio[0], this.rangoPrecio[1]);
      this.listaArticulos = this.listaArticulos.filter(function (articulo) {
        var marca = _this3.selected_marca.length != 0 ? _this3.selected_marca.includes(articulo.marca_id) : true;
        var precio = articulo.pvp >= _this3.rangoPrecio[0] && articulo.pvp <= _this3.rangoPrecio[1];
        var valoracion = _this3.rating <= articulo.valoracion;
        return marca && precio && valoracion;
      });
    },
    filtroGeneral: function filtroGeneral() {
      this.filtrarPorCategoria();
      this.filtrarPorPrecio(); // Con $emit Devolvemos la lista de articulos ordenadas a la vista padre

      this.$emit('articulosOrdenados', this.listaArticulos);
    }
    /** FIN - FILTRAR la lista de articulos */

    /****************************************/

  },
  watch: {
    $route: function $route(to, from) {
      this.selection = [];
      this.rangoPrecio = [0, 500];
      this.rating = 0;
      this.selected_marca = [];
      this.traerArticulos();
    },
    selection: function selection() {
      this.filtroGeneral();
    },
    rangoPrecio: function rangoPrecio() {
      this.filtroGeneral();
    },
    rating: function rating() {
      this.filtroGeneral();
    },
    selected_marca: function selected_marca() {
      this.filtroGeneral();
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=style&index=0&lang=css&":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=style&index=0&lang=css& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.v-card--reveal {\r\n  -webkit-box-align: center;\r\n          align-items: center;\r\n  bottom: 0;\r\n  -webkit-box-pack: center;\r\n          justify-content: center;\r\n  opacity: 0.5;\r\n  position: absolute;\r\n  width: 100%;\n}\r\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=style&index=0&lang=css&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=style&index=0&lang=css& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader??ref--6-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--6-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ArticuloFiltro.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=template&id=560b6386&":
/*!************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=template&id=560b6386& ***!
  \************************************************************************************************************************************************************************************************************************************/
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
  return _vm.loading
    ? _c(
        "v-row",
        { attrs: { justify: "center" } },
        [
          _c("v-progress-circular", {
            attrs: { width: 4, size: 100, color: "primary", indeterminate: "" }
          })
        ],
        1
      )
    : _c(
        "v-expansion-panels",
        {
          attrs: { multiple: "" },
          model: {
            value: _vm.panel,
            callback: function($$v) {
              _vm.panel = $$v
            },
            expression: "panel"
          }
        },
        [
          _c("filtro-categoria", {
            attrs: { selection: _vm.selection },
            on: { newCategoriaSelection: _vm.getFiltroCategoria }
          }),
          _vm._v(" "),
          _c("filtro-precio", {
            attrs: { MAX: _vm.MAX },
            on: { newMinMax: _vm.getFiltroMinMax }
          }),
          _vm._v(" "),
          _c("filtro-valoracion", {
            attrs: { rating: _vm.rating },
            on: { newRating: _vm.getFiltroValoracion }
          }),
          _vm._v(" "),
          _c("filtro-marca", {
            attrs: { selected_marca: _vm.selected_marca },
            on: { newMarcaSelection: _vm.getFiltroMarca }
          })
        ],
        1
      )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/templates/articulo/ArticuloFiltro.vue":
/*!***********************************************************************!*\
  !*** ./resources/js/components/templates/articulo/ArticuloFiltro.vue ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ArticuloFiltro_vue_vue_type_template_id_560b6386___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ArticuloFiltro.vue?vue&type=template&id=560b6386& */ "./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=template&id=560b6386&");
/* harmony import */ var _ArticuloFiltro_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ArticuloFiltro.vue?vue&type=script&lang=js& */ "./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _ArticuloFiltro_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ArticuloFiltro.vue?vue&type=style&index=0&lang=css& */ "./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _ArticuloFiltro_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ArticuloFiltro_vue_vue_type_template_id_560b6386___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ArticuloFiltro_vue_vue_type_template_id_560b6386___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/templates/articulo/ArticuloFiltro.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=script&lang=js&":
/*!************************************************************************************************!*\
  !*** ./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticuloFiltro_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ArticuloFiltro.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticuloFiltro_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=style&index=0&lang=css&":
/*!********************************************************************************************************!*\
  !*** ./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=style&index=0&lang=css& ***!
  \********************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticuloFiltro_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader??ref--6-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--6-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ArticuloFiltro.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticuloFiltro_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticuloFiltro_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticuloFiltro_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticuloFiltro_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticuloFiltro_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=template&id=560b6386&":
/*!******************************************************************************************************!*\
  !*** ./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=template&id=560b6386& ***!
  \******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticuloFiltro_vue_vue_type_template_id_560b6386___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ArticuloFiltro.vue?vue&type=template&id=560b6386& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/templates/articulo/ArticuloFiltro.vue?vue&type=template&id=560b6386&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticuloFiltro_vue_vue_type_template_id_560b6386___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ArticuloFiltro_vue_vue_type_template_id_560b6386___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);