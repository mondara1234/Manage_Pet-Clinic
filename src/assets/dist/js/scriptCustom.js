

//กราฟแท่ง หน้า homepage
function init_wysiwyg() {

    if( typeof ($.fn.wysiwyg) === 'undefined'){ return; }
    console.log('init_wysiwyg');

    window.prettyPrint;
    prettyPrint();

};

 //กราฟแท่ง หน้า homepage
function init_morris_charts() {

    if( typeof (Morris) === 'undefined'){ return; }
    console.log('init_morris_charts');

    if ($('#graph_bar').length){

        Morris.Bar({
            element: 'graph_bar',
            data: [
                {device: 'ไดอารี่', geekbench: 380},
                {device: 'รายการอาหาร', geekbench: 655},
                {device: 'BMI', geekbench: 275},
                {device: 'เคล็ดลับ', geekbench: 1571},
                {device: 'ท่าออกกำลังกาย', geekbench: 655},
                {device: 'เกี่ยวกับเรา', geekbench: 2154},
                {device: 'คู่มือการใช้งาน', geekbench: 1144},
                {device: 'ตั้งค่า', geekbench: 2371},
                {device: 'โปรไฟล์', geekbench: 1471},
                {device: 'Other', geekbench: 1371}
            ],
            xkey: 'device',
            ykeys: ['geekbench'],
            labels: ['Geekbench'],
            barRatio: 0.4,
            barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
            xLabelAngle: 50,
            hideHover: 'auto',
            resize: true
        });

    }

};


// Panel toolbox
$(document).ready(function() {

    $('.collapse-link').on('click', function() {
        let $BOX_PANEL = $(this).closest('.x_panel'),
            $ICON = $(this).find('i'),
            $BOX_CONTENT = $BOX_PANEL.find('.x_content');

        // fix for some div with hardcoded fix class
        if ($BOX_PANEL.attr('style')) {
            $BOX_CONTENT.slideToggle(200, function(){
                $BOX_PANEL.removeAttr('style');
            });
        } else {
            $BOX_CONTENT.slideToggle(200);
            $BOX_PANEL.css('height', 'auto');
        }

        $ICON.toggleClass('fa-chevron-up fa-chevron-down');
    });

    $('.close-link').click(function () {
        let $BOX_PANEL = $(this).closest('.x_panel');

        $BOX_PANEL.remove();
    });
    init_wysiwyg();
    init_morris_charts();
});