import { showSwal, showLoading, hideLoading } from '@/Plugins/sweetalert'

export function useSwal(options: Record<string, any> = {}) {
  return showSwal(options)
}

export function useLoading() {
  function show() {
    showLoading()
  }

  function hide() {
    hideLoading()
  }

  return { show, hide }
}
