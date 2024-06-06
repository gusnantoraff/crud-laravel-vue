import { createRouter, createWebHistory } from "vue-router";
//define a routes
const routes = [
    {
        path: "/",
        name: "landing.page",
        component: () =>
            import("@/components/LandingPage.vue"),
    },
    {
        path: "/dataA",
        name: "siswa.dataA",
        component: () =>
            import("@/views/siswa/DataA.vue"),
        meta: { requiresAuth: true },
    },
    {
        path: "/dataU",
        name: "siswa.dataU",
        component: () =>
            import("@/views/siswa/DataU.vue"),
        meta: { requiredRole: 'user' },
    },
    {
        path: "/create",
        name: "siswa.create",
        component: () =>
            import("@/views/siswa/Create.vue"),
        meta: { requiresAuth: true },
    },
    {
        path: "/edit/:id",
        name: "siswa.edit",
        component: () =>
            import("@/views/siswa/Edit.vue"),
        meta: { requiresAuth: true },
    },
    {
        path: "/login",
        name: "login",
        component: () =>
            import("@/views/siswa/Login.vue"),
    },
    {
        path: "/register",
        name: "register",
        component: () =>
            import("@/views/siswa/Register.vue"),
    },
];

//create router
const router = createRouter({
    history: createWebHistory(),
    routes, // config routes
});

export default router;