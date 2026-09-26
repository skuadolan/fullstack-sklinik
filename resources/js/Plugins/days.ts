import dayjs from 'dayjs'

import 'dayjs/locale/id'
import 'dayjs/locale/en'

import relativeTime from 'dayjs/plugin/relativeTime'
import localizedFormat from 'dayjs/plugin/localizedFormat'

dayjs.extend(relativeTime)
dayjs.extend(localizedFormat)

export default dayjs
