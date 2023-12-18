import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/css/post_timeline.css",
                "resources/css/userside_comp_prof",
                "resources/js/post.js",
            ],
            refresh: true,
        }),
    ],
});
