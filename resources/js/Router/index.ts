import { createRouter, createWebHistory } from 'vue-router';

const Router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),

  scrollBehavior() {
    return {
      top: 0,
    };
  },

  routes: [
    {
      path: '/',
      name: 'home',
      component: import('@/Pages/Welcome.vue'),
    },

    {
      path: '/demo',
      component: import('@/Pages/Demo.vue'),

      children: [
        {
          path: '',
          name: 'demo.dashboard',
          component: import('@/Components/Demo/Dashboard.vue'),
        },

        {
          path: 'patients',
          name: 'demo.patients',
          component: import('@/Pages/Patients.vue'),
        },

        {
          path: 'patients/:id',
          name: 'demo.patient-detail',
          component: import('@/Components/Patients/PatientDetail.vue'),
        },

        {
          path: 'inventory',
          name: 'demo.inventory',
          component: import('@/Pages/Inventory.vue'),
        },

        {
          path: 'billing',
          name: 'demo.billing',
          component: import('@/Pages/Billing.vue'),
        },
      ],
    },
  ],
});

export default Router;
