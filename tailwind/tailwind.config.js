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
		fontFamily: {
			head: ['serenity', 'sans-serif'],
			body: ['-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Oxygen-Sans', 'Ubuntu', 'Cantarell', 'Helvetica Neue', 'sans-serif'],
			mono: ['Fira Code', 'Consolas', 'monospace'],
			serif: ['Georgia', 'serif'],
		},
		// Extend the default Tailwind theme.
		extend: {
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
	corePlugins: {
		// Disable Preflight base styles in builds targeting the editor.
		preflight: includePreflight,
	},
	plugins: [
		// Add Tailwind Typography (via _tw fork).
		require('@_tw/typography'),

		// Extract colors and widths from `theme.json`.
		require('@_tw/themejson'),

		// Uncomment below to add additional first-party Tailwind plugins.
		require('@tailwindcss/forms'),
		// require('@tailwindcss/aspect-ratio'),
		// require('@tailwindcss/container-queries'),

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
	],
};
