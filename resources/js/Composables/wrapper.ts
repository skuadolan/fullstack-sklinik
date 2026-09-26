import axios from 'axios'

import useNotify from '@/Composables/useNotify'
const { useSwal, useLoading } = useNotify()

export async function csrLoader(url: string, timeout: number = 15000): Promise<any> {
  try {
    useLoading().show()

    return await axios.get(url, { timeout })
  } catch (error) {
    if (axios.isAxiosError(error)) {
      if (error.code === 'ECONNABORTED' || error.message?.includes('timeout')) {
        useSwal({
          title: 'Request Timeout',
          text: `Request ke ${url} timeout setelah ${timeout}ms`,
          icon: 'warning',
          timer: 3000,
        })
      }
    }

    throw error
  } finally {
    useLoading().hide()
  }
}
