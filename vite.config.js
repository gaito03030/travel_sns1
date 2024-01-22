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
                "resources/css/login.css",
                "resources/css/userside_comp_prof.css",
                "resources/js/post.js",
                "resources/js/preview.js",
                "resources/js/jquery-3.7.0.min.js",
                "resources/js/setting.js",
                "resources/js/popup.js"
            ],
            refresh: true,
        }),
    ],
});
