// Animated realtime clock

/**
 * Initialize animated clock
 */
export function initAnimatedClock() {
    const hourHand = document.querySelector('.css-hour-hand');
    const minuteHand = document.querySelector('.css-minute-hand');
    const secondHand = document.querySelector('.css-second-hand');

    if (!hourHand || !minuteHand || !secondHand) return;

    const speed = {
        hour: 200,
        minute: 50,
        second: 2
    };

    function updateClock() {
        const now = new Date();

        const hours = now.getHours() % 12;
        const minutes = now.getMinutes();
        const seconds = now.getSeconds();
        const milliseconds = now.getMilliseconds();

        const secondAngle = ((seconds + milliseconds / 1000) * 6) * speed.second;
        const minuteAngle = ((minutes + (seconds + milliseconds / 1000) / 60) * 6) * speed.minute;
        const hourAngle = ((hours + (minutes + seconds / 60) / 60) * 30) * speed.hour;

        hourHand.style.transform = `translate(-50%, 0) rotate(${hourAngle}deg)`;
        minuteHand.style.transform = `translate(-50%, 0) rotate(${minuteAngle}deg)`;
        secondHand.style.transform = `translate(-50%, 0) rotate(${secondAngle}deg)`;

        requestAnimationFrame(updateClock);
    }

    requestAnimationFrame(updateClock);
}
