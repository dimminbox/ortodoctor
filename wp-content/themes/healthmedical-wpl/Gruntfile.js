'use strict';

module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		project: {
			app      : [''],
			src      : ['src'],
			assets   : ['assets'],
			sass     : ['<%= project.src %>/sass'],
			font_src : ['bower_components/Font-Awesome/fonts/*'],
			vendorJS : [
				'bower_components/fastclick/lib/fastclick.js',
				'bower_components/foundation/js/foundation.min.js',
				'bower_components/fitvids/jquery.fitvids.js',
				'bower_components/ajaxchimp/jquery.ajaxchimp.min.js',
				'bower_components/bxslider-4/dist/jquery.bxslider.min.js',
				'bower_components/jquery.stellar/jquery.stellar.min.js',
				'bower_components/wpl-common/google-maps/google-maps.js'
			],
			vendorPHP: [
				'bower_components/wpl-common/google-maps/google-maps.php'
			]
		},

		sass: {
			dev: {
				options: {
					outputStyle: 'expanded',
					compass: false,
					sourceMap: true
				},
				files: {
					'style.css':'<%= project.sass %>/style.scss',
					'<%= project.assets %>/css/admin.css':'<%= project.sass %>/admin.scss'
				}
			},
			dist: {
				options: {
					outputStyle: 'compressed',
					compass: false
				},
				files: {
					'style.css':'<%= project.sass %>/style.scss',
					'<%= project.assets %>/css/admin.css':'<%= project.sass %>/admin.scss'
				}
			}
		},

		bless: {
			css: {
				options: {
					cacheBuster: false
				},
				files: {
					'ie.css':'style.css'
		 		}
			}
		},

		sync: {
			js: {
				files: [{
					expand: true,
					flatten: true,
					src: '<%= project.vendorJS %>',
					dest: '<%= project.assets %>/javascripts/vendor',
				}],
			},
			fonts: {
				files: [
					{
						expand: true,
						flatten: true,
						src: '<%= project.font_src %>',
						dest: '<%= project.assets %>/fonts',
					}
				]
			},
			php: {
				files: [
					{
						expand: true,
						flatten: true,
						src: '<%= project.vendorPHP %>',
						dest: 'inc',
					}
				],
			}
		},

		pot: {
			options: {
				text_domain: 'healthmedical-wpl',
				dest: 'languages/',
				keywords: [ // WordPress i18n functions
					'__:1',
					'_e:1',
					'_x:1,2c',
					'esc_html__:1',
					'esc_html_e:1',
					'esc_html_x:1,2c',
					'esc_attr__:1',
					'esc_attr_e:1',
					'esc_attr_x:1,2c',
					'_ex:1,2c',
					'_n:1,2',
					'_nx:1,2,4c',
					'_n_noop:1,2',
					'_nx_noop:1,2,3c'
				]
			},
			files: {
				src:	[ '**/*.php', '!bower_components/**', '!node_modules/**', '!option-tree/**', '!inc/plugins/**' ], // Parse all php files
				expand: true
			}
		},

		watch: {
			sass: {
				files: '<%= project.src %>/sass/**/*.{scss,sass}',
				tasks: ['sass:dev', 'bless']
			}
		}
	});

	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-sync');
	grunt.loadNpmTasks('grunt-bless');
	grunt.loadNpmTasks('grunt-pot');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('build', ['sass:dist', 'bless', 'pot', 'sync']);

	grunt.registerTask('default', ['sass:dev', 'bless', 'sync', 'watch']);
};
