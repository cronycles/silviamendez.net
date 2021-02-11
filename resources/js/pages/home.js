import CroFullScreenImagesCarousel from "../custom/cro-fs-images-carousel/cro.fs.images.carousel";
import Form from "../custom/form/form";
require("easy-pie-chart/dist/jquery.easypiechart");

export default class PageHome {
    constructor() {
        new CroFullScreenImagesCarousel();
        new Form();
        
        $('.chart').easyPieChart({
            barColor: "#286867",
            trackColor: "rgba(255, 255, 255, 0.3)",
            scaleColor: "transparent",
            easing: 'easeOutBounce',
            lineCap: 'butt',
            lineWidth: 10,
            size: 152,
    rotate: 0,    
            onStep: function (from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            }
        });
    }
};
