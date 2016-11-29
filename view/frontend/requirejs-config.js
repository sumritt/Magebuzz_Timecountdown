var config = {
    paths: {
        'magebuzz/owlcarousel': 'Magebuzz_Timecountdown/js/owl.carousel.min',
        'jquery_plugin': 'Magebuzz_Timecountdown/js/jquery.plugin',
        'simple_style': 'Magebuzz_Timecountdown/js/simple.countdown',
        'reverse_style': 'Magebuzz_Timecountdown/js/reverse.countdown',
        'flip_style': 'Magebuzz_Timecountdown/js/flip.countdown'
    },
    shim: {
        'magebuzz/owlcarousel': {
            deps: ['jquery']
        },
        'jquery_plugin': {
            deps: ['jquery']
        },
        'simple_style': {
            deps: ['jquery', 'jquery_plugin']
        },
        'reverse_style': {
            deps: ['jquery']
        },
        'flip_style': {
            deps: ['jquery']
        }
    }
};
