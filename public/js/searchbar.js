/**
 * nearby.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2018, Codrops
 * http://www.codrops.com
 */
{
    /**
     * Distance between two points P1 (x1,y1) and P2 (x2,y2).
     */
    const distancePoints = (x1, y1, x2, y2) => Math.sqrt((x1 - x2) * (x1 - x2) + (y1 - y2) * (y1 - y2));

    // from http://www.quirksmode.org/js/events_properties.html#position
    const getMousePos = (e) => {
        var posx = 0, posy = 0;
        if (!e) var e = window.event;
        if (e.pageX || e.pageY) {
            posx = e.pageX;
            posy = e.pageY;
        }
        else if (e.clientX || e.clientY) {
            posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
            posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
        }
        return { x: posx, y: posy }
    };

    class Nearby {
        constructor(el, options) {
            this.DOM = { el: el };
            this.options = options;
            this.init();
        }
        init() {
            this.mousemoveFn = (ev) => requestAnimationFrame(() => {
                const mousepos = getMousePos(ev);
                const docScrolls = { left: document.body.scrollLeft + document.documentElement.scrollLeft, top: document.body.scrollTop + document.documentElement.scrollTop };
                const elRect = this.DOM.el.getBoundingClientRect();
                const elCoords = {
                    x1: elRect.left + docScrolls.left, x2: elRect.width + elRect.left + docScrolls.left,
                    y1: elRect.top + docScrolls.top, y2: elRect.height + elRect.top + docScrolls.top
                };
                const closestPoint = { x: mousepos.x, y: mousepos.y };

                if (mousepos.x < elCoords.x1) {
                    closestPoint.x = elCoords.x1;
                }
                else if (mousepos.x > elCoords.x2) {
                    closestPoint.x = elCoords.x2;
                }
                if (mousepos.y < elCoords.y1) {
                    closestPoint.y = elCoords.y1;
                }
                else if (mousepos.y > elCoords.y2) {
                    closestPoint.y = elCoords.y2;
                }
                if (this.options.onProgress) {
                    this.options.onProgress(distancePoints(mousepos.x, mousepos.y, closestPoint.x, closestPoint.y))
                }
            });

            window.addEventListener('mousemove', this.mousemoveFn);
        }
    }

    window.Nearby = Nearby;
}


!function (e) { "undefined" == typeof module ? this.charming = e : module.exports = e }(function (e, n) { "use strict"; n = n || {}; var t = n.tagName || "span", o = null != n.classPrefix ? n.classPrefix : "char", r = 1, a = function (e) { for (var n = e.parentNode, a = e.nodeValue, c = a.length, l = -1; ++l < c;) { var d = document.createElement(t); o && (d.className = o + r, r++), d.appendChild(document.createTextNode(a[l])), n.insertBefore(d, e) } n.removeChild(e) }; return function c(e) { for (var n = [].slice.call(e.childNodes), t = n.length, o = -1; ++o < t;)c(n[o]); e.nodeType === Node.TEXT_NODE && a(e) }(e), e });

/**
 * demo3.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2018, Codrops
 * http://www.codrops.com
 */

/**
 * Equation of a line.
 */
const lineEq = (y2, y1, x2, x1, currentVal) => {
    // y = mx + b 
    var m = (y2 - y1) / (x2 - x1), b = y1 - m * x1;
    return m * currentVal + b;
};
const getRandomInt = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min;
const shuffleArray = arr => arr.sort(() => Math.random() - 0.5);

const searchInput = document.querySelector('.search__input');
const searchFeedback = document.querySelector('.search__feedback');
charming(searchFeedback);
const searchFeedbackLetters = Array.from(searchFeedback.querySelectorAll('span'));

const lettersTotal = searchFeedbackLetters.length;
const lettersPosArr = shuffleArray(Array.from(Array(lettersTotal).keys()));
let currentVisible = lettersTotal;

// whatever we do, start at [distanceThreshold.max]px from the element and end at [distanceThreshold.min]px from the element.
const distanceThreshold = { min: 0, max: 200 };
const distanceThresholdInputOpacity = { min: 0.6, max: 100 };
const opacityInterval = { from: 0.6, to: 1 };

new Nearby(searchInput, {
    onProgress: (distance) => {
        const point = lineEq(lettersTotal, 0, distanceThreshold.max, distanceThreshold.min, distance);
        const visible = Math.max(0, Math.min(lettersTotal, Math.floor(point)));
        if (currentVisible != visible) {
            if (visible < currentVisible) {
                for (let i = 0, len = lettersPosArr.length - visible; i < len; ++i) {
                    const letter = searchFeedbackLetters[lettersPosArr[i]];
                    if (letter.dataset.state != 'hidden') {
                        letter.dataset.state = 'hidden';
                        TweenMax.to(letter, 0.5, {
                            ease: 'Expo.easeOut',
                            x: `${getRandomInt(5, 20) * (Math.round(Math.random()) || -1)}%`,
                            y: `${getRandomInt(100, 300) * (Math.round(Math.random()) || -1)}%`,
                            rotationZ: `${getRandomInt(10, 45) * (Math.round(Math.random()) || -1)}%`,
                            opacity: 0
                        });
                    }
                }
            }
            else {
                for (let i = lettersTotal - 1, len = lettersTotal - (lettersPosArr.length - visible); i >= lettersTotal - len; --i) {
                    const letter = searchFeedbackLetters[lettersPosArr[i]];
                    if (letter.dataset.state === 'hidden') {
                        letter.dataset.state = '';
                        TweenMax.to(letter, 0.2, {
                            ease: 'Circ.easeOut',
                            x: '0%',
                            y: '0%',
                            rotationZ: 0,
                            opacity: 1
                        });
                    }
                }
            }

            if (visible <= 0) {
                searchInput.focus();
            }

            currentVisible = visible;
        }

        const o = lineEq(opacityInterval.from, opacityInterval.to, distanceThresholdInputOpacity.max, distanceThresholdInputOpacity.min, distance);
        TweenMax.to(searchInput, .5, {
            ease: 'Expo.easeOut',
            opacity: Math.max(o, opacityInterval.from)
        });
    }
});