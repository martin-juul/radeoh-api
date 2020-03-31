Nova.booting((Vue, router, store) => {
  Vue.component('index-json-schema-field', require('./components/IndexField'))
  Vue.component('detail-json-schema-field', require('./components/DetailField'))
  Vue.component('form-json-schema-field', require('./components/FormField'))
})
