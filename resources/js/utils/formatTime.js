import moment from 'moment';

moment.locale('zh-cn');

export default function (timeStr) {
    let time = moment(timeStr);

    if (time.isAfter(moment().subtract(7, 'days'))) {
        return time.fromNow();
    } else {
        return time.format('YYYY年MM月DD日 HH:mm')
    }
};
