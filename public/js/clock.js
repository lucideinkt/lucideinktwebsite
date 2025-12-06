// Public runtime copy of resources/js/clock.js
(function(global){
    function setRotation(el, angle){
        if(!el) return;
        el.style.transform = 'translate(-50%, 0) rotate(' + angle + 'deg)';
    }

    function updateClock(container){
        var now = new Date();
        var hours = now.getHours() % 12;
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var hourHand = container.querySelector('.css-hour-hand');
        var minuteHand = container.querySelector('.css-minute-hand');
        var secondHand = container.querySelector('.css-second-hand');

        if(hourHand) {
            var hourAngle = (hours + minutes/60) * 30; // 360/12
            setRotation(hourHand, hourAngle);
        }
        if(minuteHand){
            var minuteAngle = (minutes + seconds/60) * 6; // 360/60
            setRotation(minuteHand, minuteAngle);
        }
        if(secondHand){
            var secondAngle = seconds * 6;
            setRotation(secondHand, secondAngle);
        }
    }

    function startClock(container){
        if(!container) return;
        updateClock(container);
        container._lucideClockInterval = setInterval(function(){ updateClock(container); }, 1000);
    }

    function stopClock(container){
        if(container && container._lucideClockInterval){
            clearInterval(container._lucideClockInterval);
            delete container._lucideClockInterval;
        }
    }

    function attachModalHandlers(container){
        var openBtn = document.getElementById('openModalBtn') || container.querySelector('.clock-button');
        var modal = document.getElementById('leesMeerModal');
        var closeBtn = document.getElementById('closeModalBtn');
        var overlay = modal && modal.querySelector('.custom-modal-overlay');
        if(!openBtn || !modal) return;

        function open(){
            modal.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }
        function close(){
            modal.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        openBtn.addEventListener('click', open);
        if(closeBtn) closeBtn.addEventListener('click', close);
        if(overlay) overlay.addEventListener('click', close);
        document.addEventListener('keydown', function(e){ if(e.key === 'Escape') close(); });
    }

    function replaceChevron(el){
        if(!el) return;
        var svgs = el.querySelectorAll('svg.bc-chevron');
        svgs.forEach(function(svg){
            var hollow = document.createElementNS('http://www.w3.org/2000/svg','svg');
            hollow.setAttribute('viewBox','0 0 16 16');
            hollow.setAttribute('width',svg.getAttribute('width')||'16');
            hollow.setAttribute('height',svg.getAttribute('height')||'16');
            hollow.classList.add('bc-chevron','bc-chevron-hollow');

            var path = document.createElementNS('http://www.w3.org/2000/svg','path');
            path.setAttribute('d','M6 12l4-4-4-4');
            path.setAttribute('fill','none');
            path.setAttribute('stroke','currentColor');
            path.setAttribute('stroke-width','1.6');
            path.setAttribute('stroke-linecap','round');
            path.setAttribute('stroke-linejoin','round');
            hollow.appendChild(path);

            svg.parentNode.replaceChild(hollow, svg);
        });
    }

    function injectHomeIcon(el){
        var placeholders = el.querySelectorAll('[data-home-icon], .home-icon');
        placeholders.forEach(function(ph){
            var i = document.createElement('i');
            i.className = 'fa-solid fa-house';
            ph.innerHTML = '';
            ph.appendChild(i);
        });
    }

    function initLucideClock(root){
        if(typeof root === 'string') root = document.querySelector(root);
        if(!root) root = document.querySelector('.clock-image');
        if(!root) return;

        startClock(root);
        attachModalHandlers(root);
        replaceChevron(document);
        injectHomeIcon(document);

        return { stop: function(){ stopClock(root); } };
    }

    document.addEventListener('DOMContentLoaded', function(){
        if(document.querySelector('.clock-image')){
            try{ initLucideClock(document.querySelector('.clock-image')); }catch(e){ console.error(e); }
        }
    });

    global.initLucideClock = initLucideClock;

})(window);


