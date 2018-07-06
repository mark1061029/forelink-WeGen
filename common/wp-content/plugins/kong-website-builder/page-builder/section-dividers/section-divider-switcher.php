<?php
function kong_get_section_separator($style) {
    switch ($style) {
        case 'half-circle':
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0 100C40 0 60 0 100 100z"/></svg>';
            break;
        case 'triangle-1':
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" preserveAspectRatio="none"><path fill-rule="evenodd" d="M-.03 500v-28.064L169.85 0l330.62 471.936V500"/></svg>';
            break;
        case 'triangle-2':
            return'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" preserveAspectRatio="none"><path fill-rule="evenodd" d="M-.178 504.3v-54.448L250 0l250.395 449.852V505"/></svg>';
            break;
        case 'triangle-3':
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0 0l50 90 50-90v100H0"/></svg>';
            break;
        case 'triangle-4':
            return '<svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 500 500"><path fill-rule="evenodd" d="M500 0v499.977H-16"/></svg>';
            break;
        case 'triangle-5':
            return '<svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 500 500"><g fill-rule="evenodd"><path fill-opacity=".3" d="M500.28 488.464l-.15-448.186L-.02 443.082l.5 53"/><path d="M-.473.08L500.64 426.764V500H-.472"/></g></svg>';
            break;
        case 'stamp':
            return '<svg preserveAspectRatio="none" viewBox="0 0 1000 250" xmlns="http://www.w3.org/2000/svg"><title>stamp copy</title><g fill="#000" fill-rule="evenodd"><path d="M7.5 250H5v-3.126V250H0V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C6.466 52.393 8.11 0 10 0v250H7.5zM17.5 250H15v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C16.466 52.393 18.11 0 20 0v250h-2.5zM27.5 250H25v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C26.466 52.393 28.11 0 30 0v250h-2.5zM37.5 250H35v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C36.466 52.393 38.11 0 40 0v250h-2.5zM47.5 250H45v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C46.466 52.393 48.11 0 50 0v250h-2.5zM57.5 250H55v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C56.466 52.393 58.11 0 60 0v250h-2.5zM67.5 250H65v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C66.466 52.393 68.11 0 70 0v250h-2.5zM77.5 250H75v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C76.466 52.393 78.11 0 80 0v250h-2.5zM87.5 250H85v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C86.466 52.393 88.11 0 90 0v250h-2.5zM97.5 250H95v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C96.466 52.393 98.11 0 100 0v250h-2.5zM107.5 250H105v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C106.466 52.393 108.11 0 110 0v250h-2.5zM117.5 250H115v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C116.466 52.393 118.11 0 120 0v250h-2.5zM127.5 250H125v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C126.466 52.393 128.11 0 130 0v250h-2.5zM137.5 250H135v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C136.466 52.393 138.11 0 140 0v250h-2.5zM147.5 250H145v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C146.466 52.393 148.11 0 150 0v250h-2.5zM157.5 250H155v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C156.466 52.393 158.11 0 160 0v250h-2.5zM167.5 250H165v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C166.466 52.393 168.11 0 170 0v250h-2.5zM177.5 250H175v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C176.466 52.393 178.11 0 180 0v250h-2.5zM187.5 250H185v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C186.466 52.393 188.11 0 190 0v250h-2.5zM197.5 250H195v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C196.466 52.393 198.11 0 200 0v250h-2.5zM207.5 250H205v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C206.466 52.393 208.11 0 210 0v250h-2.5zM217.5 250H215v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C216.466 52.393 218.11 0 220 0v250h-2.5zM227.5 250H225v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C226.466 52.393 228.11 0 230 0v250h-2.5zM237.5 250H235v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C236.466 52.393 238.11 0 240 0v250h-2.5zM247.5 250H245v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C246.466 52.393 248.11 0 250 0v250h-2.5zM257.5 250H255v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C256.466 52.393 258.11 0 260 0v250h-2.5zM267.5 250H265v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C266.466 52.393 268.11 0 270 0v250h-2.5zM277.5 250H275v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C276.466 52.393 278.11 0 280 0v250h-2.5zM287.5 250H285v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C286.466 52.393 288.11 0 290 0v250h-2.5zM297.5 250H295v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C296.466 52.393 298.11 0 300 0v250h-2.5zM307.5 250H305v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C306.466 52.393 308.11 0 310 0v250h-2.5zM317.5 250H315v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C316.466 52.393 318.11 0 320 0v250h-2.5zM327.5 250H325v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C326.466 52.393 328.11 0 330 0v250h-2.5zM337.5 250H335v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C336.466 52.393 338.11 0 340 0v250h-2.5zM347.5 250H345v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C346.466 52.393 348.11 0 350 0v250h-2.5zM357.5 250H355v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C356.466 52.393 358.11 0 360 0v250h-2.5zM367.5 250H365v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C366.466 52.393 368.11 0 370 0v250h-2.5zM377.5 250H375v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C376.466 52.393 378.11 0 380 0v250h-2.5zM387.5 250H385v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C386.466 52.393 388.11 0 390 0v250h-2.5zM397.5 250H395v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C396.466 52.393 398.11 0 400 0v250h-2.5zM407.5 250H405v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C406.466 52.393 408.11 0 410 0v250h-2.5zM417.5 250H415v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C416.466 52.393 418.11 0 420 0v250h-2.5zM427.5 250H425v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C426.466 52.393 428.11 0 430 0v250h-2.5zM437.5 250H435v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C436.466 52.393 438.11 0 440 0v250h-2.5zM447.5 250H445v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C446.466 52.393 448.11 0 450 0v250h-2.5zM457.5 250H455v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C456.466 52.393 458.11 0 460 0v250h-2.5zM467.5 250H465v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C466.466 52.393 468.11 0 470 0v250h-2.5zM477.5 250H475v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C476.466 52.393 478.11 0 480 0v250h-2.5zM487.5 250H485v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C486.466 52.393 488.11 0 490 0v250h-2.5zM497.5 250H495v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C496.466 52.393 498.11 0 500 0v250h-2.5zM507.5 250H505v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C506.466 52.393 508.11 0 510 0v250h-2.5zM517.5 250H515v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C516.466 52.393 518.11 0 520 0v250h-2.5zM527.5 250H525v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C526.466 52.393 528.11 0 530 0v250h-2.5zM537.5 250H535v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C536.466 52.393 538.11 0 540 0v250h-2.5zM547.5 250H545v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C546.466 52.393 548.11 0 550 0v250h-2.5zM557.5 250H555v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C556.466 52.393 558.11 0 560 0v250h-2.5zM567.5 250H565v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C566.466 52.393 568.11 0 570 0v250h-2.5zM577.5 250H575v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C576.466 52.393 578.11 0 580 0v250h-2.5zM587.5 250H585v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C586.466 52.393 588.11 0 590 0v250h-2.5zM597.5 250H595v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C596.466 52.393 598.11 0 600 0v250h-2.5zM607.5 250H605v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C606.466 52.393 608.11 0 610 0v250h-2.5zM617.5 250H615v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C616.466 52.393 618.11 0 620 0v250h-2.5zM627.5 250H625v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C626.466 52.393 628.11 0 630 0v250h-2.5zM637.5 250H635v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C636.466 52.393 638.11 0 640 0v250h-2.5zM647.5 250H645v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C646.466 52.393 648.11 0 650 0v250h-2.5zM657.5 250H655v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C656.466 52.393 658.11 0 660 0v250h-2.5zM667.5 250H665v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C666.466 52.393 668.11 0 670 0v250h-2.5zM677.5 250H675v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C676.466 52.393 678.11 0 680 0v250h-2.5zM687.5 250H685v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C686.466 52.393 688.11 0 690 0v250h-2.5zM697.5 250H695v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C696.466 52.393 698.11 0 700 0v250h-2.5zM707.5 250H705v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C706.466 52.393 708.11 0 710 0v250h-2.5zM717.5 250H715v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C716.466 52.393 718.11 0 720 0v250h-2.5zM727.5 250H725v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C726.466 52.393 728.11 0 730 0v250h-2.5zM737.5 250H735v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C736.466 52.393 738.11 0 740 0v250h-2.5zM747.5 250H745v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C746.466 52.393 748.11 0 750 0v250h-2.5zM757.5 250H755v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C756.466 52.393 758.11 0 760 0v250h-2.5zM767.5 250H765v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C766.466 52.393 768.11 0 770 0v250h-2.5zM777.5 250H775v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C776.466 52.393 778.11 0 780 0v250h-2.5zM787.5 250H785v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C786.466 52.393 788.11 0 790 0v250h-2.5zM797.5 250H795v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C796.466 52.393 798.11 0 800 0v250h-2.5zM807.5 250H805v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C806.466 52.393 808.11 0 810 0v250h-2.5zM817.5 250H815v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C816.466 52.393 818.11 0 820 0v250h-2.5zM827.5 250H825v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C826.466 52.393 828.11 0 830 0v250h-2.5zM837.5 250H835v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C836.466 52.393 838.11 0 840 0v250h-2.5zM847.5 250H845v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C846.466 52.393 848.11 0 850 0v250h-2.5zM857.5 250H855v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C856.466 52.393 858.11 0 860 0v250h-2.5zM867.5 250H865v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C866.466 52.393 868.11 0 870 0v250h-2.5zM877.5 250H875v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C876.466 52.393 878.11 0 880 0v250h-2.5zM887.5 250H885v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C886.466 52.393 888.11 0 890 0v250h-2.5zM897.5 250H895v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C896.466 52.393 898.11 0 900 0v250h-2.5zM907.5 250H905v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C906.466 52.393 908.11 0 910 0v250h-2.5zM917.5 250H915v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C916.466 52.393 918.11 0 920 0v250h-2.5zM927.5 250H925v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C926.466 52.393 928.11 0 930 0v250h-2.5zM937.5 250H935v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C936.466 52.393 938.11 0 940 0v250h-2.5zM947.5 250H945v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C946.466 52.393 948.11 0 950 0v250h-2.5zM957.5 250H955v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C956.466 52.393 958.11 0 960 0v250h-2.5zM967.5 250H965v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C966.466 52.393 968.11 0 970 0v250h-2.5zM977.5 250H975v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C976.466 52.393 978.11 0 980 0v250h-2.5zM987.5 250H985v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C986.466 52.393 988.11 0 990 0v250h-2.5zM997.5 250H995v-3.126V250h-5V0c1.886 0 3.528 52.205 4.38 129.29.203 6.243.486 14.065.633 14.235.145.17.41-7.514.603-13.822C996.466 52.393 998.11 0 1000 0v250h-2.5z"/></g></svg>';
            break;
        case 'cloud-1':
            return '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M-5 100q5-80 10 0zm5 0q5-100 10 0m-5 0q5-70 10 0m-5 0q5-90 10 0m-5 0q5-70 10 0m-5 0q5-110 10 0m-5 0q5-90 10 0m-5 0q5-70 10 0m-5 0q5-90 10 0m-5 0q5-50 10 0m-5 0q5-80 10 0m-5 0q5-60 10 0m-5 0q5-40 10 0m-5 0q5-50 10 0m-5 0q5-80 10 0m-5 0q5-55 10 0m-5 0q5-70 10 0m-5 0q5-80 10 0m-5 0q5-50 10 0m-5 0q5-75 10 0m-5 0q5-85 10 0z"/></svg>';
            break;
        case 'cloud-2':
            return '<svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 500 500"><g fill-rule="evenodd"><path d="M-.106 58.52s23.99-4.667 39.443 290.685c.142 0 2.752-63.456 11.558-55.44.297 6.977 17.955-155.555 49.205-32.965.033 1.284 32.94-193.722 56.375 88.11-.014.793 9.04-10.628 10.54 63.896 1.503 2.092 0-80.783 14.154-86.638.893-14.466 1.492-101.832 19.26-122.576.105 0 36.382-191.485 60.406 102.98 0 1.14 7.878-69.913 15.69-14.293 0 .576 12.456-193.01 43.867-169.936 0-1.695 19.244-129.112 45.956-8.124.23 1.94 14.293-107.23 36.587-17.914.384.894 25.888-70.036 41.285 67.69.148 0 4.416-31.584 10.74-30.948 6.323.636 10.038 32.88 12.13 33.373 0-2.488 11.21-178.614 33.298-165.67V500H-.106"/><path d="M500 132.143l.018 358.827L.313 495.215l-.1-356.654s26.138-6.417 40.217 78.88c.174 0 25.648-62.856 48.367 66.53.203-.41 22.263-189.263 55.916-45.133.1.806 12.918-146.022 46.604-60.244-.033.87 24.86-125.516 48.09 27.04-.076.33 26.02-68.36 44.722 111.212.02.74 73.658-255.055 116.724-120.537.365.256 9.304-118.585 27.984-129.755 18.68-11.17 29.542 50.922 37.407 104.414.08-.59 8.747-57.29 15.887-65.417 7.14-8.128 17.868 26.593 17.868 26.593z" opacity=".3"/></g></svg>';
            break;
        case 'arrow':
            return'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" preserveAspectRatio="none"><path d="M15 0l5 500H10M5 0l5 500H0M35 0l5 500H30M25 0l5 500H20M55 0l5 500H50M45 0l5 500H40M75 0l5 500H70M65 0l5 500H60M95 0l5 500H90M85 0l5 500H80M115 0l5 500h-10M105 0l5 500h-10M135 0l5 500h-10M125 0l5 500h-10M155 0l5 500h-10M145 0l5 500h-10M175 0l5 500h-10M165 0l5 500h-10M195 0l5 500h-10M185 0l5 500h-10M215 0l5 500h-10M205 0l5 500h-10M235 0l5 500h-10M225 0l5 500h-10M255 0l5 500h-10M245 0l5 500h-10M275 0l5 500h-10M265 0l5 500h-10M295 0l5 500h-10M285 0l5 500h-10M315 0l5 500h-10M305 0l5 500h-10M335 0l5 500h-10M325 0l5 500h-10M355 0l5 500h-10M345 0l5 500h-10M375 0l5 500h-10M365 0l5 500h-10M395 0l5 500h-10M385 0l5 500h-10M415 0l5 500h-10M405 0l5 500h-10M435 0l5 500h-10M425 0l5 500h-10M455 0l5 500h-10M445 0l5 500h-10M475 0l5 500h-10M485 0l5 500h-10M495 0l5 500h-10M465 0l5 500h-10"/></svg>';
            break;
        case 'oval-1':
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill-rule="evenodd" d="M0 0v100h100V0c-.003-.665 0-1.332 0-2 0-55.228-22.386-100-50-100S0-57.228 0-2c0 .668.003 1.335.01 2zm.01 0h99.98C99.458 54.305 77.28 98 50 98S.542 54.305.01 0z"></path></svg>';
            break;
        case 'oval-2':
            return'<svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 100 100"><path fill-rule="evenodd" d="M104.545 38.728V100H-4.545V38.728C-8.047 26.03-10 11.898-10-2.992-10-58.226 16.863-103 50-103s60 44.775 60 100.007c0 14.892-1.953 29.023-5.455 41.72zm0 0V-.007H-4.545v38.735C4.94 73.128 25.797 97.015 50 97.015c24.203 0 45.06-23.886 54.545-58.287z"/></svg>';
            break;
        case 'wave-1':
            return'<svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 500 500"><g fill-rule="evenodd"><path d="M-.28.515s40.227-7.837 79.96 177.6c25.156 112.32 42.3 166.31 70.492 182.945 45.74 21.64 62.578-255.908 109.78-262.18 50.632-2.382 83.18 259.043 128.45 259.043 38.23-10.463 50.71-118.947 80.96-179.808 16.986-26.213 30.738 17.325 30.738 17.325v302.248l-500.403-1.83L-.28.516z" opacity=".5"/><path d="M1.62 422.31s18.566 36.575 72.788 12.7c54.223-23.876 69.485-268.672 108.455-270.634 15.824-4.665 35.223 49.408 55.153 126.516 20.062 77.62 53.244 136.34 74.91 62.8 21.666-73.538 39.058-148.968 72.6-148.968 45.033 0 114.7 206.41 114.7 206.41v86.554L.483 493.946l1.14-71.637z" opacity=".5"/><path d="M.157 442.835H0v57.157h500v-7.845h.014L500 271.434s-65.817 131.75-98.123 117.734c-42.9-11.03-92.244-182.88-129.96-166.316-37.718 16.562-69.91 156.24-114.556 152.3C80.138 373.987 0 67.537 0 67.537l.157 375.3z"/></g></svg>';
            break;
        case 'wave-2':
            return '<svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 500 500"><g fill-rule="evenodd"><path d="M.69 390.18s6.076-11.11 25.84 18.016c19.767 29.126 30.308 73.268 57.282 65.636 11.34-3.21 36.2-33.494 54.313-90.006 18.113-56.513 37.49-150.38 71.438-150.38 18.863 0 40.718 0 87.708 77.785 46.992 77.788 101.267-24.286 125.062-94.328C465.57 74.275 499.514 74.275 499.514 74.275V500L.572 499.613l.12-109.433z"/><path fill-opacity=".3" d="M-.11 385.386s10.758 3.59 24.97 18.994c14.214 15.403 29.684 62.274 58.173 62.274 19.84 0 49.82-69.348 67.342-140.296 17.52-70.948 32.088-129.515 69.596-129.515 25.89 0 41.245 27.093 59.792 62.377 18.547 35.284 33.307 67.138 60.13 67.138 13.327-.64 67.124-31.635 98.446-191.185 31.322-159.55 62.025-130.32 62.025-130.32l-.523 492.7L.406 498.708-.11 385.385z" opacity=".5"/><path fill-opacity=".3" d="M.21 382.136s11.218-.775 32.005 11.452C53 405.815 61.198 427.974 85.11 422.66c24.488-5.44 41.824-51.95 49.358-79.768 15.486-57.18 43.1-161.826 78.524-161.826 34.864 0 55.885 46.465 65.22 61.862 9.333 15.397 28.882 42.427 62.132 42.427s59.373-10.743 94.545-155.42C470.06-14.74 500.26 3.61 500.26 3.61v493.453L.21 498.1"/></g></svg>';
            break;
        case 'wave-3':
            return '<svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 500 500"><g fill-rule="evenodd"><path d="M.037 448.028V500H501.86V.932s-174.542 336.31-383.153 409.2C-89.903 483.018.037 448.027.037 448.027z"/><path d="M.494 181.126c2.053 0 50.683-103.435 81.54-103.435 30.856 0 60.622 93.04 81.238 120.884 8.597 11.61 43.382 84.788 69.13 90.972 25.746 6.183 126.524-67.585 126.524-67.585L500 320.454l.38 170.48L0 495.577s-1.56-314.452.494-314.452z" opacity=".3"/><path fill-opacity=".3" d="M-.096 290.596s26.71 23.525 55.778 23.525c14.32 0 28.005 3.153 52.788-70.367 24.782-73.52 40.042-73.52 55.372-73.52 30.22 0 74.783 194.82 99.47 194.82 24.688 0 237.436 21.776 237.436 21.776l.022 107.337-500.866 2.96v-206.53z"/></g></svg>';
            break;
        case 'wave-4':
            return '<svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 500 500"><g fill-rule="evenodd"><path d="M.256 454.27S97.348 211.135 166.32 172.86c46.407-36.233 138.467 169.03 165.215 178.34 58.3 15.937 87.172-159.888 169.606-325.215-.456 53.958 0 474.013 0 474.013H.257v-45.73z"/><path fill-opacity=".3" d="M-.098 266.673c19.21 0 36.448 41.112 36.448 41.112s42.46-192.334 76.23-200.763c33.77-8.43 103.816 247.145 103.816 247.145s41.868-247.145 86.63-247.145c39.913 0 86.708 141.493 86.708 141.493s53.93-357.606 110.565 0c-.98 1.244 0 248.823 0 248.823l-500.33.936S-.1 291.458-.1 266.674z"/><path fill-opacity=".1" d="M-.234 80.518s12.797-49.78 41.828-55.552c41.424-.936 116.744 263.99 116.744 263.99S194.36 37.778 229.62 24.03c35.262-13.75 86.855 203.265 86.855 203.265S370.645-12.86 420.168 1.005c49.523 13.867 79.875 164.728 79.875 164.728V490.04L-.234 496.108V80.517z"/></g></svg>';
            break;
        default:
            return '';
            break;
    }
}
?>