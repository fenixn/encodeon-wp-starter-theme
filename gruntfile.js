module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON("package.json"),
        concat: {
            css: {
                src: ["src/css/*.css"],
                dest: "dist/css/theme.css"
            },
            js: {
                src: ["src/js/*.js"],
                dest: "dist/js/theme.js"
            }
        },
        cssmin: {
            target: {
                src: "dist/css/theme.css",
                dest: "dist/css/theme.min.css"
            }
        },
        uglify: {
            target: {
                src: "dist/js/theme.js",
                dest: "dist/js/theme.min.js"
            }
        },
        watch: {
            /**
             * Watch the theme CSS, JS and PHP files and
             * refresh the page on change
             */
            css: {
                files: ["src/css/*.css"],
                tasks: ["concat:css", "cssmin"]
            },
            js: {
                files: ["src/js/*.js"],
                tasks: ["concat:js", "uglify"]
            },
            php: {
                files: ["*.php"],
                tasks: [],
            },
            options: {
                livereload: true,
                spawn: true
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
};
