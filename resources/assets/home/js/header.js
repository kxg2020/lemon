var input;
var content = 'Well you only need the light when it\'s burning low\n' +
    '只有在朦胧黯淡时才念及灯火光亮\n' +
    'Only miss the sun when it starts to snow\n' +
    '只有在冰天雪地时才怀念阳光温暖，\n' +
    'Only know you love her when you let her go\n' +
    '只有在已然放手后才始知那是真爱，\n' +
    'Only know you\'ve been high when you\'re feeling low\n' +
    '只有在身处低谷时才遥想过去峥嵘，\n' +
    'Only hate the road when you\'re missing home\n' +
    '只有在乡愁涌动时才痛恨旅途遥远\n' +
    'Only know you love her when you let her go\n' +
    '只有在让她走之后才始知那是真爱\n' +
    'And you let her go\n' +
    '你就让她走吧。';

input = document.getElementById("header-text");
$.getJSON({
    url: 'https://open.iciba.com/dsapi?callback=?',
    success: function success(response) {
        var str = response.content + '\n' + response.note;
        if (str.length > 1) {
            content = str;
        }
    }
});

function refresh(content, i) {
    var v = content.substring(0, i);
    input.innerText = v;
}
var i = 1;
setInterval(function() {
    if(i > content.length) return;
    refresh(content, i);
    i++;
}, 200);