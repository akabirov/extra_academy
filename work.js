a = document.createElement('div');
a.classList.add('banner_leasing');
document.getElementsByTagName('body')[0].append(a);
a.style.backgroundColor = 'white';
var all = document.getElementsByClassName('promo_page_top promo_form_middle')[0];
var bod = document.getElementsByTagName('body')[0];


a.style.position = 'fixed';

a.style.height = '325px';
a.style.width = '638px';
a.style.top = '30%';
a.style.left = '30%';
a.style.zIndex = '1000';


b = document.createElement('div');

a.appendChild(b);
b.style.position = 'relative';
a.style.display = 'flex';

b.innerHTML = 'Не нашли подходящее пердложение?';
b.style.fontFamily = 'Gilroy';
b.style.fontWeight = '700';
b.style.fontSize = '32px';
b.style.lineHeight = '40px';

b.style.width = '210px';
b.style.height = '120px';
b.style.top = '32px';
b.style.left = '32px';

c = document.createElement('div');
a.appendChild(c);
c.style.position = 'relative';
c.innerHTML = 'Посмотрите каталог марок и моделей';
c.style.width = '210px';
c.style.height = '24px';
c.style.fontSize = '16px';
c.style.lineHeight = '24px';
c.style.fontWeight = '400';
c.style.fontFamily = 'Gilroy';
a.style.flexDirection = 'column';

c.style.left = '32px';
c.style.top = '50px';


var db = document.createElement('div');
a.appendChild(db);
db.style.position = 'relative';

db.style.top = '100px';
db.style.width = '200px';
db.style.height = '40px';

db.style.display = 'flex';
db.style.justifyContent = 'center';
db.style.left = '32px';




var pic = document.createElement('div');
a.appendChild(pic);



pic.style.position = 'absolute';
pic.style.backgroundImage = "url('http://xn--80aafaxhj3c.xn--p1ai/s3/img/banners/main_img_popup.png')";
pic.style.width = '350px';
pic.style.height = '250px';
pic.style.top = '70px';
pic.style.right = '20px';
pic.style.backgroundRepeat = 'no-repeat';
pic.style.backgroundSize = 'contain';




foo = document.createElement('div');
document.getElementsByTagName('body')[0].append(foo);
foo.style.position = 'fixed';
foo.style.bottom = '10px';
foo.style.width = '100%';
foo.style.height = '100%';
foo.style.backgroundColor = 'black';
foo.style.opacity = '0.3';
foo.style.zIndex = '100';


var cl = document.createElement('div');
a.appendChild(cl);
//cl.className = 'sendsay-close sendsay-close--with-icon';
//'sendsay-close sendsay-close--with-icon'
cl.style.position = 'absolute';
cl.style.width = '30px';
cl.style.height = '30px';
cl.style.top = '20px';
cl.style.right = '20px';


var btn = document.createElement('a');
db.appendChild(btn);
btn.innerHTML = 'Выбрать авто';
btn.setAttribute('href', 'https://request.развивай.рф/?utm_source=razvivairf&utm_medium=banner&utm_campaign=popupnewlp');

btn.style.border = '1px solid rgb(245, 44, 68)';

btn.style.height = '56px';
btn.style.maxWidth = '100%';
btn.style.transitionDuration = '0.2s';

btn.style.transitionTimingFunction = 'ease';
btn.style.background = 'rgb(245, 44, 68)';
btn.style.borderRadius = 'calc(28px)';
btn.style.fontWeight = 'bold';
btn.style.cursor = 'pointer';
btn.style.display = 'inline-flex';
btn.style.justifyContent = 'center';
btn.style.alignItems = 'center';

btn.style.color = 'white';
btn.style.width = '200px';
btn.style.textDecoration = 'none';
btn.setAttribute('target', '_blank');




btn.onmouseover = function () {
    btn.style.backgroundColor = 'rgb(247, 86, 105)';
    btn.style.cursor = 'pointer';
    btn.style.transitionDuration = '0.2s';
}


btn.onmouseout = function () {
    btn.style.backgroundColor = 'rgb(245, 44, 68)';
};


var sp = document.createElement('button');
cl.appendChild(sp);
sp.innerHTML = 'x';
sp.style.lineHeight = '20px';
sp.style.fontSize = '30px';
sp.style.border = '0';
sp.style.backgroundColor = 'white';



sp.onmouseover = function () {
    sp.style.opacity = '0.3';
    sp.style.cursor = 'pointer';
};
sp.onmouseout = function () {
    sp.style.opacity = '100';
};


sp.addEventListener('click', function () {

    a.style.display = 'none';
    foo.style.display = 'none';
})


a.style.visibility = 'visible';
foo.style.opacity = '0.3';
foo.style.visibility = 'visible';
a.style.transition = 'all 1s ease';
foo.style.transition = 'all 0.5s ease';



document.cookie = "catalog_banner = yes; path =/; max-age=7200";

dataLayer.push({
    'event': 'catalog_banner',
    'events_from_GTM': { 'catalog_banner': 'yes' }
});

dataLayer.push({
    'event': 'event-to-ga',
    'eventCategory': 'banner', ///////// категория
    'eventAction': 'view_banner', ///////// действие
    'eventLabel': 'one'  /////// ярлык
});