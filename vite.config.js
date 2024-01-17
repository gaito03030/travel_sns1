import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/css/post_timeline.css",
                "resources/css/style.css",
                "resources/css/userside_comp_prof",
                "resources/js/post.js",
                "resources/js/preview.js",
                "resources/js/jquery-3.7.0.min.js",
                "resources/css/login.js",
            ],
            refresh: true,
        }),
    ],
});
