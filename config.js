    exports.config = {
      conventions: {
        ignored: /^(vendor.*\.less|vendor.*\.php|.+node_modules.+|.+_.+\..+)$/
      },
      modules: {
        definition: false,
        wrapper: false
      },
      paths: {
        "public": '_public'
      },
      files: {
        javascripts: {
          joinTo: {
            'js/app.js': /^app/,
            'js/vendor.js': /^vendor/
          },
          order: {
            before: ['vendor/console-polyfill/index.js']
          }
        },
        stylesheets: {
          joinTo: {
            'css/app.css': /^(app|vendor)/
          }
        },
        templates: {
          joinTo: {
            'js/templates.js': /.+\.jade$/
          }
        }
      },
      plugins: {
        jade: {
          options: {
            pretty: true
          }
        },
        bower: {
          extend: {
            "bootstrap": 'vendor/bootstrap/docs/assets/js/bootstrap.js',
            "angular-mocks": [],
            "styles": []
          },
          asserts: {
            "img": /bootstrap(\\|\/)img/,
            "font": /font-awesome(\\|\/)font/
          }
        }
      }
    };