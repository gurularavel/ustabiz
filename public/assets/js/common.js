function toggleMenu(){const m=document.getElementById('mobileMenu');m.classList.toggle('open');document.body.style.overflow=m.classList.contains('open')?'hidden':''}
function toggleFaq(item){const a=item.classList.contains('active');document.querySelectorAll('.faq-item').forEach(el=>el.classList.remove('active'));if(!a)item.classList.add('active')}
function submitForm(btn){const orig=btn.innerHTML;btn.innerHTML='⏳ Göndərilir...';btn.disabled=true;setTimeout(()=>{btn.innerHTML='✅ Uğurla göndərildi!';btn.style.background='#22c55e';setTimeout(()=>{btn.innerHTML=orig;btn.style.background='';btn.disabled=false},3000)},1200)}
// Phone mask: +994 XX XXX XX XX
(function(){
    function applyPhoneMask(input){
        var digits=input.value.replace(/\D/g,'');
        if(digits.startsWith('994')) digits=digits.slice(3);
        else if(digits.startsWith('0')) digits=digits.slice(1);
        digits=digits.slice(0,9);
        var out='+994';
        if(digits.length>0) out+=' '+digits.slice(0,2);
        if(digits.length>2) out+=' '+digits.slice(2,5);
        if(digits.length>5) out+=' '+digits.slice(5,7);
        if(digits.length>7) out+=' '+digits.slice(7,9);
        input.value=out;
    }
    document.querySelectorAll('input[data-phone]').forEach(function(el){
        el.addEventListener('input',function(){ applyPhoneMask(this); });
        el.addEventListener('focus',function(){ if(!this.value) this.value='+994 '; });
        el.addEventListener('blur',function(){ if(this.value==='+994 '||this.value==='+994') this.value=''; });
    });
})();

document.querySelectorAll('a[href^="#"]').forEach(l=>{l.addEventListener('click',e=>{const t=document.querySelector(l.getAttribute('href'));if(t){e.preventDefault();t.scrollIntoView({behavior:'smooth',block:'start'})}})});
const obs=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting){e.target.style.opacity='1';e.target.style.transform='translateY(0)'}})},{threshold:0.08});
document.querySelectorAll('.problem-card,.process-step,.service-adv-card,.brand-chip,.faq-item,.other-service-card,.service-card,.advantage-item,.testimonial-card,.step-item,.partner-logo').forEach(el=>{el.style.opacity='0';el.style.transform='translateY(20px)';el.style.transition='opacity 0.5s ease,transform 0.5s ease';obs.observe(el)});
document.querySelectorAll('.lang-btn').forEach(btn=>{btn.addEventListener('click',function(){document.querySelectorAll('.lang-btn').forEach(b=>b.classList.remove('active'));this.classList.add('active')})});
