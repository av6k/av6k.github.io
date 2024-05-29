function createFieldElem(option) {
    var title = option.title;
    var items = option.items;
    var plainText = option.plainText;
    var classStr = option.classStr;
    var text = option.text;
    var fieldElem = document.createElement('div');
    var fieldClass = ['field', classStr].join(' ');
    fieldElem.setAttribute('class', fieldClass);
    var titleElem = document.createElement('h4');
    titleElem.setAttribute('class', 'title');
    titleElem.innerHTML = title;
    fieldElem.appendChild(titleElem);
    var ulElem = document.createElement('ul');
    var htmlStr = ''
    for (var i = 0; i < items.length; i++) {
        if (plainText) {
            htmlStr = htmlStr + '<li>' + items[i] + '</li>';
        } else {
            htmlStr = htmlStr + '<li><a href="' + items[i] + '" target="_blank">' + items[i] + '</a><span speed="' + items[i] + '">测速中</span></li>';
        }
    }
    if (text) {
        htmlStr = htmlStr + '<li class="text">' + text + '</li>';
    }
    ulElem.innerHTML = htmlStr;
    fieldElem.appendChild(ulElem);
    return fieldElem;
}

const emails = ['av6k.com@gmail.com',];
const newestUrls = [
'https://m.av6ker.cc/app/',
'https://av6ker.top/app/',
'https://av6k17.top',
'https://av6kc.one',
'https://av6k333.top',
'https://随意.av6k13.buzz',
'https://随意.av6k14.buzz',
'https://随意.av6k15.buzz',
'https://随意.av6k16.buzz',
];
const newestUrls2 = [
'https://av6k.cc',
'https://av6k.co',
'https://av6k.co.uk',
'https://av6k.in',
'https://av6k.info',
'https://av6k.me',
'https://av6k.online',
'https://av6k.org',
'https://av6k.pro',
'https://av6k.sbs',
'https://av6k.site',
'https://av6k.vip',
];
const otherUrls = ['https://av6k.app'];
const foreverUrls = ['https://av6k.app'];
const notices = ['* 發送郵件到 / 五分鐘左右會回復最新可進入地址,可能會進垃圾箱,註意查。',
    '* 我們推薦PC和Andriod手機用戶使用Chrome(谷歌)瀏覽器訪問，iPhone用戶我們建立您使用手機自帶Safria瀏覽器訪問。','* 如果點擊進入後打不開本站，請換（電信或聯通）網絡在訪問本站，移動網絡頻繁屏蔽本站～。',];

var mainElem = document.getElementById('main');
var logoElem = document.createElement('div');
logoElem.setAttribute('class', 'brand');
logoElem.setAttribute('id', 'logo');
logoElem.innerHTML = 'AV<span class="flag">6K</span>'
mainElem.appendChild(logoElem);
//
var foreverFieldElem = createFieldElem({
    title: '请收藏永久地址發布頁面',
    items: foreverUrls
});
mainElem.appendChild(foreverFieldElem);
var newestFieldElem = createFieldElem({
    title: '以下为最新地址(定期更新，牢记上面发布页)',
    items: newestUrls,
    text: ''
});
mainElem.appendChild(newestFieldElem);
var newestFieldElem2 = createFieldElem({
    title: '以下为永久地址(部份地区线路和谐)',
    items: newestUrls2,
    text: ''
});
mainElem.appendChild(newestFieldElem2);
//


var mailFieldElem = createFieldElem({
    title: '發送郵件獲得',
    items: emails,
    plainText: true
});
//mainElem.appendChild(mailFieldElem);

var noticeFieldElem = createFieldElem({
    title: '注意事項',
    items: notices,
    plainText: true,
    classStr: 'desc'
});
mainElem.appendChild(noticeFieldElem);

var ping = 1;
    setInterval("ping++", 1);

document.querySelectorAll('span[speed]').forEach(function(ele,i){
    var sortid = ele.getAttribute('speed');
    var img = new Image();
        var start = new Date().getTime();
        img.onerror = function() {
            var str = "较慢";
                if (ping < 300) {
                    ele.setAttribute('style', 'color: green')
                    str = "极快";
                }
                if (ping > 300 && ping < 500) {
                    ele.setAttribute('style', 'color: #a72eff')
                    str = "较快";
                }
                if (ping > 500) {
                    ele.setAttribute('style', 'color: #666666')
                }
                ele.innerHTML = "" + str + "" + "(" + ping * 1 + "ms)";
        };
        img.src = sortid + '?' +  start;

    ele.appendChild(img)
})