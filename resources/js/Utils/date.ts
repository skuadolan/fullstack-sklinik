import dayjs from '@/Plugins/days'
import { useLocaleStore } from '@/Stores/locale'

export function getCurrDateTimeNow(format: string = 'YYYY-MM-DD HH:mm:ss') {
  return dayjs().locale(useLocaleStore().locale).format(format)
}

export function convertDateTime(
  stringtime: string | Date | number,
  format: string = 'YYYY-MM-DD HH:mm:ss',
) {
  if (!stringtime) return 'Invalid date'

  return dayjs(stringtime).locale(useLocaleStore().locale).format(format)
}
