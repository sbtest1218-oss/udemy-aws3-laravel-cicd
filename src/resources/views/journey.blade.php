<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>みんな、本当によく頑張ったね — 学びの軌跡</title>
    <meta name="description" content="スクラム開発（完全版）講座を駆け抜けた、あなたの学びの軌跡。">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@400;500;700;900&family=Outfit:wght@500;700;900&display=swap" rel="stylesheet">
    <style>
        :root { --ink: #e7ecff; }
        * { -webkit-font-smoothing: antialiased; }
        body {
            font-family: 'Zen Maru Gothic', system-ui, sans-serif;
            background: #070b1f;
            color: var(--ink);
            overflow-x: hidden;
        }
        .display { font-family: 'Outfit', 'Zen Maru Gothic', sans-serif; }

        /* オーロラ背景 */
        .aurora { position: fixed; inset: 0; z-index: 0; overflow: hidden; pointer-events: none; }
        .aurora span {
            position: absolute; display: block; border-radius: 50%;
            filter: blur(90px); opacity: .55; mix-blend-mode: screen;
            animation: drift 18s ease-in-out infinite;
        }
        .aurora span:nth-child(1){ width:46vw;height:46vw;left:-8vw;top:-10vw;background:#6d5efc; }
        .aurora span:nth-child(2){ width:40vw;height:40vw;right:-10vw;top:6vw;background:#ec4faa;animation-delay:-6s; }
        .aurora span:nth-child(3){ width:42vw;height:42vw;left:18vw;bottom:-16vw;background:#22d3ee;animation-delay:-12s; }
        @keyframes drift {
            0%,100%{ transform:translate(0,0) scale(1); }
            33%{ transform:translate(4vw,3vw) scale(1.08); }
            66%{ transform:translate(-3vw,2vw) scale(.95); }
        }

        .glass {
            background: rgba(255,255,255,.045);
            border: 1px solid rgba(255,255,255,.10);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }
        .reveal { opacity:0; transform: translateY(26px); transition: opacity .7s ease, transform .7s cubic-bezier(.2,.7,.2,1); }
        .reveal.in { opacity:1; transform:none; }

        .check {
            width: 30px; height: 30px; flex: 0 0 auto; border-radius: 9999px;
            display:grid; place-items:center;
            background: linear-gradient(135deg,#34d399,#10b981);
            box-shadow: 0 6px 18px -6px rgba(16,185,129,.8);
            color:#062b1e; font-weight:900;
        }
        .timeline-line {
            background: linear-gradient(180deg, rgba(109,94,252,.0), rgba(109,94,252,.7) 12%, rgba(236,79,170,.7) 88%, rgba(236,79,170,0));
        }
        .final-glow { box-shadow: 0 0 0 1px rgba(250,204,21,.5), 0 24px 60px -20px rgba(250,204,21,.45); }
        .shine { background-size:200% auto; -webkit-background-clip:text; background-clip:text; color:transparent;
            background-image: linear-gradient(100deg,#fff 10%,#a5b4fc 30%,#f0abfc 55%,#fff 80%);
            animation: shine 6s linear infinite; }
        @keyframes shine { to { background-position:200% center; } }
        .badge-pop { animation: pop .6s cubic-bezier(.2,1.4,.4,1) both; }
        @keyframes pop { from{ transform:scale(.6); opacity:0; } to{ transform:scale(1); opacity:1; } }
    </style>
</head>
<body>
    <div class="aurora"><span></span><span></span><span></span></div>

    <main class="relative z-10">
        {{-- ===== ヒーロー ===== --}}
        <section class="min-h-screen flex flex-col items-center justify-center text-center px-6 py-20">
            <div class="badge-pop glass inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm text-indigo-200 mb-8">
                🎓 スクラム開発（完全版）— 修了
            </div>

            <h1 class="display font-black leading-tight text-4xl sm:text-6xl md:text-7xl mb-6">
                <span class="shine">みんな、</span><br class="sm:hidden">
                <span class="shine">本当によく頑張ったね。</span>
            </h1>

            <p class="max-w-2xl text-base sm:text-lg text-indigo-100/80 leading-relaxed mb-12">
                環境構築から、TDD、AIコーディング、そしてCI/CD。<br>
                一歩ずつ積み上げてきた、あなたの学びの軌跡です。
            </p>

            {{-- 進捗リング --}}
            <div class="relative w-44 h-44 mb-10">
                <svg class="w-44 h-44 -rotate-90" viewBox="0 0 120 120">
                    <circle cx="60" cy="60" r="52" fill="none" stroke="rgba(255,255,255,.08)" stroke-width="10"/>
                    <circle id="ring" cx="60" cy="60" r="52" fill="none" stroke="url(#grad)" stroke-width="10"
                            stroke-linecap="round" stroke-dasharray="326.7" stroke-dashoffset="326.7"/>
                    <defs>
                        <linearGradient id="grad" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0%" stop-color="#34d399"/>
                            <stop offset="50%" stop-color="#818cf8"/>
                            <stop offset="100%" stop-color="#f0abfc"/>
                        </linearGradient>
                    </defs>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <div id="pct" class="display font-black text-4xl">0%</div>
                    <div class="text-xs text-indigo-200/70 mt-1">達成</div>
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-3 text-sm">
                <div class="glass rounded-2xl px-5 py-3">
                    <div class="display font-black text-2xl text-emerald-300">{{ $completed }}</div>
                    <div class="text-indigo-200/70">クリアした章</div>
                </div>
                <div class="glass rounded-2xl px-5 py-3">
                    <div class="display font-black text-2xl text-indigo-300">{{ $phases->count() }}</div>
                    <div class="text-indigo-200/70">フェーズ</div>
                </div>
                <div class="glass rounded-2xl px-5 py-3">
                    <div class="display font-black text-2xl text-pink-300">100%</div>
                    <div class="text-indigo-200/70">やりきった</div>
                </div>
            </div>

            <div class="mt-16 text-indigo-200/50 text-sm animate-bounce">▼ あなたの歩み</div>
        </section>

        {{-- ===== タイムライン ===== --}}
        <section class="max-w-3xl mx-auto px-5 sm:px-6 pb-24">
            @foreach ($phases as $phase)
                <div class="reveal mb-4 mt-14 flex items-center gap-3">
                    <div class="text-3xl">{{ $phase['icon'] }}</div>
                    <h2 class="display font-black text-2xl sm:text-3xl">{{ $phase['name'] }}</h2>
                </div>

                <div class="relative pl-8">
                    <div class="absolute left-[14px] top-2 bottom-2 w-[2px] timeline-line"></div>

                    @foreach ($phase['items'] as $item)
                        <div class="reveal relative mb-4">
                            <div class="absolute -left-[26px] top-5 w-3 h-3 rounded-full
                                {{ $item->is_final ? 'bg-yellow-300' : 'bg-indigo-300' }} ring-4 ring-[#070b1f]"></div>

                            <div class="glass rounded-2xl p-5 flex items-start gap-4 transition
                                hover:-translate-y-0.5 hover:bg-white/[.07]
                                {{ $item->is_final ? 'final-glow border-yellow-300/40' : '' }}">
                                <div class="check {{ $item->is_final ? '' : '' }}">✓</div>
                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="text-xl">{{ $item->icon }}</span>
                                        <h3 class="font-bold text-lg leading-snug">{{ $item->title }}</h3>
                                        @if ($item->subtitle)
                                            <span class="text-xs glass rounded-full px-2.5 py-0.5 text-indigo-100/80">{{ $item->subtitle }}</span>
                                        @endif
                                        @if ($item->is_final)
                                            <span class="text-xs font-bold rounded-full px-2.5 py-0.5 bg-yellow-300 text-yellow-950">今ここで完成！</span>
                                        @endif
                                    </div>
                                    @if ($item->description)
                                        <p class="text-sm text-indigo-100/70 mt-2 leading-relaxed">{{ $item->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            {{-- ===== 締めのメッセージ ===== --}}
            <div class="reveal glass rounded-3xl p-8 sm:p-12 mt-16 text-center final-glow">
                <div class="text-5xl mb-4">🎉</div>
                <h2 class="display font-black text-2xl sm:text-4xl mb-4 shine">全章クリア、おめでとう！</h2>
                <p class="text-indigo-100/80 leading-relaxed max-w-xl mx-auto">
                    テストで品質を守り、AIを相棒にし、そして自動でデプロイする。<br>
                    これだけのことを、あなたはやり遂げました。<br><br>
                    <span class="text-indigo-100/95">
                        ——そしてこのページ自体が、あなたの組み上げた
                        <span class="font-bold text-yellow-200">CI/CDパイプライン</span>で
                        GitHub から AWS EC2 へ<span class="font-bold">自動デプロイ</span>されています。
                    </span><br><br>
                    その一歩が、これからの開発者人生をきっと支えてくれます。<br>
                    <span class="display font-black text-lg">本当に、おつかれさま。🌱</span>
                </p>
                <button onclick="celebrate()" class="mt-8 inline-flex items-center gap-2 px-6 py-3 rounded-full font-bold
                    bg-gradient-to-r from-indigo-500 to-pink-500 hover:opacity-90 transition text-white shadow-lg">
                    🎊 もう一度祝う
                </button>
            </div>

            <footer class="text-center text-indigo-200/40 text-xs mt-16">
                &copy; <span id="year"></span> アジャイル ビジネス インスティテュート株式会社 — CI/CD Hands-on
            </footer>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
    <script>
        const PERCENT = {{ $percent }};
        document.getElementById('year').textContent = new Date().getFullYear();

        // 進捗リング & カウントアップ
        window.addEventListener('load', () => {
            const ring = document.getElementById('ring');
            const circ = 2 * Math.PI * 52;
            ring.style.transition = 'stroke-dashoffset 1.6s cubic-bezier(.2,.7,.2,1)';
            requestAnimationFrame(() => { ring.style.strokeDashoffset = circ * (1 - PERCENT / 100); });

            const pct = document.getElementById('pct');
            let cur = 0;
            const step = () => { cur += Math.max(1, Math.round((PERCENT - cur) / 8)); if (cur >= PERCENT) cur = PERCENT;
                pct.textContent = cur + '%'; if (cur < PERCENT) requestAnimationFrame(step); };
            requestAnimationFrame(step);

            setTimeout(celebrate, 600);
        });

        // スクロールで出現
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
        }, { threshold: .15 });
        document.querySelectorAll('.reveal').forEach(el => io.observe(el));

        // 紙吹雪
        function celebrate() {
            if (typeof confetti !== 'function') return;
            const end = Date.now() + 1400;
            const colors = ['#818cf8', '#f0abfc', '#34d399', '#fde047', '#22d3ee'];
            (function frame() {
                confetti({ particleCount: 4, angle: 60, spread: 60, origin: { x: 0 }, colors });
                confetti({ particleCount: 4, angle: 120, spread: 60, origin: { x: 1 }, colors });
                if (Date.now() < end) requestAnimationFrame(frame);
            })();
            confetti({ particleCount: 140, spread: 90, origin: { y: .6 }, colors });
        }
    </script>
</body>
</html>
