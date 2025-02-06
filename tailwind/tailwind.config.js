// Set the Preflight flag based on the build target.
const includePreflight = 'editor' === process.env._TW_TARGET ? false : true;

module.exports = {
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require('./tailwind-typography.config.js'),
	],
	content: [
		// Ensure changes to PHP files and `theme.json` trigger a rebuild.
		'./theme/**/*.php',
	],
	future: {
		hoverOnlyWhenSupported: true
	},
	theme: {
		container: {
			center: true,
		},
		// Extend the default Tailwind theme.
		extend: {
			animation: {
				'fade-in': 'fade-in 500ms ease-in-out',
				'fade-in-from-top': 'fade-in-from-top 700ms ease-in-out',
				'fade-in-from-bottom': 'fade-in-from-bottom 700ms ease-in-out',
				'move-bg': 'move-bg 16s ease infinite',
			},
			aspectRatio: {
				'headshot': '95 / 127',
				'featured-image': '384 / 125',
				'feat-3.75': '3.75 / 1',
				'feat-4.3': '4.3 / 1',
				'feat-card': '1.91',
			},
			backgroundImage: {
				'featured-image': 'var(--ll--page-feat-img)',
				'headshot': 'url(img/dots-neutral-500.svg)',
				'hero-gradient':
					'linear-gradient(to right, hsla(0, 0%, 16%, 0.9) 0%, hsla(0, 0%, 16%, 0.891) 8.1%, hsla(0, 0%, 16%, 0.866) 15.5%, hsla(0, 0%, 16%, 0.827) 22.5%, hsla(0, 0%, 16%, 0.777) 29%, hsla(0, 0%, 16%, 0.719) 35.3%, hsla(0, 0%, 16%, 0.654) 41.2%, hsla(0, 0%, 16%, 0.585) 47.1%, hsla(0, 0%, 16%, 0.515) 52.9%, hsla(0, 0%, 16%, 0.446) 58.8%, hsla(0, 0%, 16%, 0.381) 64.7%, hsla(0, 0%, 16%, 0.323) 71%, hsla(0, 0%, 16%, 0.273) 77.5%, hsla(0, 0%, 16%, 0.234) 84.5%, hsla(0, 0%, 16%, 0.209) 91.9%, hsla(0, 0%, 16%, 0.2) 100%)',
			},
			boxShadow: {
				'service': '8px 8px 6px rgb(0 0 0 / 0.16)',
			},
			"colors": {
				// via: https://tints.dev/atlantis/B2D235
				"atlantis": {
					50: "#F7FAEA",
					100: "#EFF6D5",
					200: "#E1EDB0",
					300: "#D1E486",
					400: "#C2DB5C",
					500: "#B2D235",
					600: "#90AB26",
					700: "#6D811D",
					800: "#4A5813",
					900: "#232A09",
					950: "#121505"
				},
				// via: https://tints.dev/aqua/45C2CC
				"aqua": {
					50: "#EBF9FA",
					100: "#DBF3F5",
					200: "#B3E6EA",
					300: "#8FDBE0",
					400: "#6BCFD6",
					500: "#45C2CC",
					600: "#2FA4AC",
					700: "#237A80",
					800: "#175054",
					900: "#0C2A2C",
					950: "#051314"
				},
			},
			containers: {
				'2xs': '16rem',
			},
			fontFamily: {
				head: ['serenity', 'sans-serif'],
				mono: ['Fira Code', 'Consolas', 'monospace'],
				serif: ['Georgia', 'serif'],
			},
			keyframes: {
				'fade-in': {
					'0%': { opacity: 0 },
					'100%': { opacity: 1 },
				},
				'fade-in-from-top': {
					'0%': {
						opacity: '0',
						transform: 'translateY(-32px)'
					},
					'100%': {
						opacity: '1',
						transform: 'translateY(0)'
					},
				},
				'fade-in-from-bottom': {
					'0%': {
						opacity: '0',
						transform: 'translateY(64px)'
					},
					'100%': {
						opacity: '1',
						transform: 'translateY(0)'
					},
				},
				'move-bg': {
					'0%, 100%': { transform: 'translateX(0)' },
					'50%': { transform: 'translateX(-40vw)'	},
				},
			},
			maxWidth: {
				'46char': '46ch',
				'65char': '65ch',
				'socimg': '736px',
				'main': '976px',
			},
			minHeight: {
				hero: '360px',
			},
			textShadow: {
				none: 'none',
				sm: '0 1px 2px var(--tw-shadow-color)',
				DEFAULT: '0 2px 4px var(--tw-shadow-color)',
				lg: '0 8px 16px var(--tw-shadow-color)',
			},
		},
	},
	safelist: [
		'aspect-feat-3.75',
		'aspect-feat-4.3',
		'aspect-feat-card',
		'border-4',
		'flex-wrap',
		'grid-cols-2',
		'place-content-start',
		'md:place-content-start',
		'min-w-60',
		'min-w-72',
		'mt-0',
		'p-8',
		'w-fit',
	],
	corePlugins: {
		// Disable default tailwind aspect-* classes
		aspectRatio: false,
		// Disable Preflight base styles in builds targeting the editor.
		preflight: includePreflight,
	},
	plugins: [
		// Add Tailwind Typography (via _tw fork).
		// require('@_tw/typography'),

		// Extract colors and widths from `theme.json`.
		require('@_tw/themejson'),

		// Uncomment below to add additional first-party Tailwind plugins.
		require('@tailwindcss/forms'),
		// require('@tailwindcss/aspect-ratio'),
		// require('@tailwindcss/container-queries'),
		// require('@shrutibalasa/tailwind-grid-auto-fit'),
		require('tailwindcss-motion'),

		// via: https://www.hyperui.dev/blog/text-shadow-with-tailwindcss
		({ matchUtilities, theme }) => {
			matchUtilities(
				{
					'text-shadow': (value) => ({
						textShadow: value,
					}),
				},
				{ values: theme('textShadow') }
			);
		},

		// via: https://www.viget.com/articles/adding-safari-14-support-to-tailwinds-aspect-ratio/
		({ matchUtilities, theme }) => {
			matchUtilities(
				{
					aspect: (value) => ({
						'@supports (aspect-ratio: 1 / 1)': {
							aspectRatio: value,
						},
						'@supports not (aspect-ratio: 1 / 1)': {
							'&::before': {
								content: '""',
								float: 'left',
								paddingTop: `calc(100% / (${value}))`,
							},
							'&::after': {
								clear: 'left',
								content: '""',
								display: 'block',
							},
						},
					}),
				},
				{ values: theme('aspectRatio') }
			);
		},
	],
};
