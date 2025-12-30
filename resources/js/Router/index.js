import { createRouter, createWebHistory } from "vue-router";

import App from "@/App.vue";

const routes = [
    {
        path: "/",
        name: "App",
        component: App,
        meta: { guest: true, requiresAuth: false },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
	const isAuthenticated = !!sessionStorage.getItem("_token");

	if (to.meta.requiresAuth && !isAuthenticated) {
		return next({ name: "App" });
	}

	// if (to.meta.guest && isAuthenticated) {
	// 	return next({ name: "DashboardHome" });
	// }

	next();
});

export default router;
