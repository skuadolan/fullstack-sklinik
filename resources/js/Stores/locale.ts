import { defineStore } from 'pinia'

export const useLocaleStore = defineStore('locale', {
  state: () => ({
    locale: 'id' as 'id' | 'en',
  }),

  actions: {
    setLocale(locale: 'id' | 'en') {
      this.locale = locale
    },
  },
})
