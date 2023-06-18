import dayjs from 'dayjs';
import utcPlugin from 'dayjs/plugin/utc';
import timezonePlugin from 'dayjs/plugin/timezone';

dayjs.extend(utcPlugin);
dayjs.extend(timezonePlugin);

export function useLocalTime(timeString, format = '') {
    return dayjs.utc(timeString).local().format(format)
}
