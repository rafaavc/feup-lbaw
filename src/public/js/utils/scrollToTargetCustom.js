import { getHeaderHeight } from "./getHeaderHeight.js";

export const scrollToTargetCustom = (target, offset=0) => {
    const elementPosition = window.scrollY + target.getBoundingClientRect().top - getHeaderHeight() - offset;

    window.scrollTo({
         top: elementPosition
    });
}
