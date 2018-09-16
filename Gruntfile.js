/* jshint node:true */
module.exports = function (grunt) {

	'use strict';

	var sass = require('node-sass');
	grunt.util.linefeed = '\n';

	// Project configuration.
	grunt.initConfig({

		pkg: grunt.file.readJSON( 'package.json' ),

		// Check textdomain errors.
		checktextdomain: {
			options:{
				text_domain: '<%= pkg.name %>',
				keywords: [
					'__:1,2d',
					'_e:1,2d',
					'_x:1,2c,3d',
					'esc_html__:1,2d',
					'esc_html_e:1,2d',
					'esc_html_x:1,2c,3d',
					'esc_attr__:1,2d',
					'esc_attr_e:1,2d',
					'esc_attr_x:1,2c,3d',
					'_ex:1,2c,3d',
					'_n:1,2,4d',
					'_nx:1,2,4c,5d',
					'_n_noop:1,2,3d',
					'_nx_noop:1,2,3c,4d'
				]
			},
			files: {
				src:  [
					'**/*.php', // Include all files
					'!node_modules/**',
					'!dist/**',
					'!orig/**'
				],
				expand: true
			}
		},

		// Compile all .scss files.
		sass: {
			options: {
				implementation: sass,
				sourceMap: false
			},
			dist: {
				files: [{
					'style.css' : 'sass/style.scss',
					'assets/css/editor-style.css' : 'sass/editor-style.scss'
				}]
			}
		},

		cmq: {
			options: {
				compress: false,
				logFile: false
			},
			media: {
				files: [{
					'style.css' : 'style.css',
					'assets/css/editor-style.css' : 'assets/css/editor-style.css'
				}]
			}
		},

		// Autoprefixer.
		postcss: {
			options: {
				processors: [
					require( 'autoprefixer' )({
						browsers: [
							'> 0.1%',
							'ie 8',
							'ie 9'
						]
					})
				]
			},
			dist: {
				src: [
					'style.css',
					'!style.min.css',
					'assets/css/*.css',
					'!assets/css/*.min.css'
				]
			}
		},

	    wpcss: {
	        style: {
	            options: {
	                commentSpacing: true
	            },
				files: [{
					'style.css' : 'style.css',
					'assets/css/editor-style.css' : 'assets/css/editor-style.css'
				}]
	        }
	    },

		// RTLCSS
		rtlcss: {
			main: {
				options: {},
				expand: true,
				ext: '-rtl.css',
				src: [
					'style.css',
					'assets/css/editor-style.css'
				]
			}
		},

		cssmin: {
			target: {
				files: [{
					expand: true,
					cwd: './',
					src: [
						'./*.css',
						'!./*.min.css',
						'assets/css/*.css',
						'!assets/css/*.min.css'],
					dest: './',
					ext: '.min.css'
				}]
			}
		},

		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'assets/js/customizer.js',
				'assets/js/frontend/frontend.js',
				'assets/js/frontend/navigation.js'
			]
		},

		concat: {
			frontend: {
				src: [
				'assets/js/frontend/skip-link-focus-fix.js',
				'assets/js/frontend/navigation.js',
				'assets/js/frontend/frontend.js'
				],
				dest: 'assets/js/frontend.js'
			}
		},

		uglify: {
			options: {
				preserveComments: 'some'
			},
			js: {
				files: [{
					expand: true,
					cwd: 'assets/js/',
					src: [
						'*.js',
						'!*.min.js'
					],
					dest: 'assets/js/',
					ext: '.min.js'
				}]
			}
		},

		watch: {
			css: {
				files: [
					'sass/*.scss',
					'sass/*/*.scss',
					'sass/*/*/*.scss',
					'sass/*/*/*/*.scss'
				],
				tasks: [
					'sass',
					'rtlcss',
					'cssmin'
				]
			},
			frontend: {
				files: [
					'assets/js/frontend/*.js'
				],
				tasks: [
					'concat',
					'uglify'
				]
			}
		},

		// Replace text
		replace: {
			themeVersion: {
				src: [
					'sass/style.scss'
				],
				overwrite: true,
				replacements: [ {
					from: /^.*Version:.*$/m,
					to: 'Version: <%= pkg.version %>'
				} ]
			},
			stable: {
				src: [
					'readme.txt'
				],
				overwrite: true,
				replacements: [ {
					from: /^.*Stable tag:.*$/m,
					to: 'Stable tag: <%= pkg.version %>'
				} ]
			},
			version: {
				src: [
					'readme.txt'
				],
				overwrite: true,
				replacements: [ {
					from: /^.*Version:.*$/m,
					to: 'Version: <%= pkg.version %>'
				} ]
			}
		},

		wp_readme_to_markdown: {
			your_target: {
				files: {
					'README.md': 'readme.txt'
				}
			}
		}

	});

    grunt.loadNpmTasks( 'grunt-checktextdomain' );
    grunt.loadNpmTasks( 'grunt-combine-media-queries' );
    grunt.loadNpmTasks( 'grunt-contrib-concat' );
    grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
    grunt.loadNpmTasks( 'grunt-contrib-jshint' );
    grunt.loadNpmTasks( 'grunt-contrib-uglify' );
    grunt.loadNpmTasks( 'grunt-contrib-watch' );
    grunt.loadNpmTasks( 'grunt-postcss' );
    grunt.loadNpmTasks( 'grunt-rtlcss' );
    grunt.loadNpmTasks( 'grunt-sass' );
    grunt.loadNpmTasks( 'grunt-text-replace' );
    grunt.loadNpmTasks( 'grunt-wp-css' );
    grunt.loadNpmTasks( 'grunt-wp-readme-to-markdown' );

	grunt.registerTask( 'css', [
		'sass',
		'cmq',
		'postcss',
		'wpcss',
		'rtlcss',
		'cssmin'
	]);

	grunt.registerTask( 'js', [
		'concat',
		'jshint',
		'uglify'
	]);

	grunt.registerTask( 'prepare', [
		'checktextdomain',
		'js',
		'replace',
		'css',
		'wp_readme_to_markdown'
	]);

};
