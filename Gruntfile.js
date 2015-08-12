module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        copy: {
            release: {
                expand: true,
                src: [
                    'css/**',
                    'docs/**',
                    'js/**',
                    'setup/**',
                    'src/**',
                    'vendor/**',
                    'views/**',
                    'CHANGELOG.md',
                    'config.sample.php',
                    'index.php',
                    'LICENSE',
                    'README.md'
                ],
                dest: '<%= pkg.name %>-<%= pkg.version %>/'
            }
        },
        compress: {
            release: {
                options: {
                    archive: '<%= pkg.name %>-<%= pkg.version %>.zip'
                },
                src: '<%= pkg.name %>-<%= pkg.version %>/**'
            }
        },
        clean: {
            release: {
                src: '<%= pkg.name %>-<%= pkg.version %>/'
            }
        }
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-clean');

    // Default task(s).
    grunt.registerTask('default', ['copy:release', 'compress:release', 'clean:release']);

};