/*console.log('Initially ' + (window.navigator.onLine ? 'on' : 'off') + 'line');

window.addEventListener('online', () => console.log('Became online'));
window.addEventListener('offline', () => console.log('Became offline'));

//document.getElementById('statusCheck').addEventListener('click', () => console.log('window.navigator.onLine is ' + window.navigator.onLine));

console.log(window.navigator.onLine);

*/

if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('https://monedas-conmemorativas.herokuapp.com/sw.js')
    .then(reg => console.log('service worker registered'))
    .catch(err => console.log('service worker not registered', err));
}