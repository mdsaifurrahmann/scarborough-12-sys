import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
	resolve: {
		alias: {
			"@": path.resolve(__dirname, "resources"),
		},
	},
	plugins: [
		laravel({
			input: [
				"resources/assets/scss/main.scss",
				"resources/assets/js/sentry.js",
				"resources/js/app.js",
				"resources/assets/js/products.js",
				"resources/assets/js/main.js",
				"resources/assets/js/contact.js",
				"resources/assets/js/ajax-form.js",
				"resources/assets/scss/products/products.scss",
			],
			refresh: true,
		}),
	],
});
