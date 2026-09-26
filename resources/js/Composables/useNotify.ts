import { useSwal, useLoading } from '@/Utils/notification'
import { useToast as toastr } from 'vue-toastification'

export default function useNotify() {
  return { useSwal, useLoading, toastr }
}
