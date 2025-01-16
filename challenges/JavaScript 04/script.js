const ldEkr = document.getElementById('ldEkr');
const pocEkr = document.getElementById('pocEkr');
const prsEkr = document.getElementById('prsEkr');
const rezEkr = document.getElementById('rezEkr');
const errEkr = document.getElementById('errEkr');
const pocBtn = document.getElementById('pocBtn');
const pnvBtn = document.getElementById('pnvBtn');
const ppdBtn = document.getElementById('ppdBtn');
const retBtn = document.getElementById('retBtn');
const prsTxt = document.getElementById('prsTxt');
const odgBtn = document.getElementById('odgBtn');
const brjNap = document.getElementById('brjNap');
const rezKraj = document.getElementById('rezKraj');

let prs = [];
let trPrsIdx = 0;
let kvzAkt = false;

pocBtn.addEventListener('click', pocKvz);
pnvBtn.addEventListener('click', rstKvz);
ppdBtn.addEventListener('click', rstKvz);
retBtn.addEventListener('click', initKvz);
window.addEventListener('hashchange', handleHash);

function showEkr(ekran) {
    const ekrani = [ldEkr, pocEkr, prsEkr, rezEkr, errEkr];
    ekrani.forEach(e => e.classList.add('skr'));
    ekran.classList.remove('skr');
}

async function getPrs() {
    const response = await fetch('https://opentdb.com/api.php?amount=20');
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    const data = await response.json();
    return data.results;
}

async function initKvz() {
    showEkr(ldEkr);
    try {
        const data = await getPrs();
        if (data && data.length > 0) {
            prs = data;
            showEkr(pocEkr);
        } else {
            throw new Error('No questions received');
        }
    } catch (error) {
        console.error('Error:', error);
        showEkr(errEkr);
    }
}

function pocKvz() {
    kvzAkt = true;
    trPrsIdx = 0;
    localStorage.setItem('kvzRez', '0');
    window.location.hash = 'prs-1';
}

function handleHash() {
    if (!kvzAkt) return;

    const hash = window.location.hash;
    if (hash.startsWith('#prs-')) {
        const brPrs = parseInt(hash.replace('#prs-', ''));
        if (brPrs <= prs.length && brPrs === trPrsIdx + 1) {
            showPrs();
        } else {
            window.location.hash = `prs-${trPrsIdx + 1}`;
        }
    }
}

function decodeHTML(html) {
    const txt = document.createElement('textarea');
    txt.innerHTML = html;
    return txt.value;
}

function shuffleArr(array) {
    const newArr = [...array];
    for (let i = newArr.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [newArr[i], newArr[j]] = [newArr[j], newArr[i]];
    }
    return newArr;
}

function showPrs() {
    showEkr(prsEkr);
    const prasanje = prs[trPrsIdx];
    
    // tekst za prasanje
    prsTxt.textContent = decodeHTML(prasanje.question);
    
    // ponudeni odgovori
    odgBtn.innerHTML = '';
    const odgovori = shuffleArr([
        ...prasanje.incorrect_answers,
        prasanje.correct_answer
    ]);
    
    odgovori.forEach(odgovor => {
        const btn = document.createElement('button');
        btn.className = 'odg-btn animated fadeIn';
        btn.textContent = decodeHTML(odgovor);
        btn.addEventListener('click', () => handleOdg(odgovor === prasanje.correct_answer));
        odgBtn.appendChild(btn);
    });
    
    // kategorija
    const katEl = document.getElementById('prsKat');
    katEl.textContent = decodeHTML(prasanje.category);
    
    // n / 20 , n se menuva
    brjNap.textContent = `${trPrsIdx + 1}/20`;
}

function handleOdg(isCorr) {
    if (isCorr) {
        const trRez = parseInt(localStorage.getItem('kvzRez') || '0');
        localStorage.setItem('kvzRez', (trRez + 1).toString());
    }
    
    trPrsIdx++;
    
    if (trPrsIdx < prs.length) {
        window.location.hash = `prs-${trPrsIdx + 1}`;
    } else {
        showRez();
    }
}

function showRez() {
    kvzAkt = false;
    showEkr(rezEkr);
    const rez = localStorage.getItem('kvzRez') || '0';
    rezKraj.textContent = `Total Correct Answers: ${rez}/20`;
}

function rstKvz() {
    localStorage.removeItem('kvzRez');
    window.location.hash = '';
    window.location.reload();
}

// inicijaliziranje na kvizot koga stranicata ke se vcita
document.addEventListener('DOMContentLoaded', initKvz);