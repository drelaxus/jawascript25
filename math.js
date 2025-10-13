(() => {
    const Σ = Symbol('Σ'), Λ = Symbol('Λ');
    const ƒ = Object.freeze({
        '+': (a, b) => a + b,
        '-': (a, b) => a - b,
        '*': (a, b) => a * b,
        '/': (a, b) => b === 0 ? NaN : a / b
    });

    class 𝓒 {
        constructor() {
            this[Σ] = 0;
            this[Λ] = null;
        }
        #η(op, val) {
            if (this[Λ]) {
                const fn = ƒ[this[Λ]];
                this[Σ] = fn(this[Σ], val);
                this[Λ] = null;
            } else {
                this[Σ] = val;
            }
        }
        #ξ(op) {
            if (Object.keys(ƒ).includes(op)) this[Λ] = op;
        }
        exec(expr) {
            const toks = expr.match(/(\d+|\+|\-|\*|\/)/g);
            for (let t of toks) {
                if (!isNaN(t)) this.#η(this[Λ], parseFloat(t));
                else this.#ξ(t);
            }
            return this[Σ];
        }
    }

    const Ω = new Proxy(new 𝓒(), {
        get: (t, p) => Reflect.get(t, p),
        apply: (_, __, [x]) => t.exec(x)
    });

    const UI = (() => {
        const r = document.createElement('div');
        Object.assign(r.style, {
            width: '240px', margin: '40px auto',
            fontFamily: 'monospace', background: '#222',
            color: '#0f0', padding: '16px',
            borderRadius: '12px', boxShadow: '0 0 12px #0f0'
        });

        const d = document.createElement('input');
        Object.assign(d, {
            type: 'text',
            style: 'width:100%;padding:8px;font-size:16px;background:#111;color:#0f0;border:1px solid #0f0;border-radius:6px'
        });

        const o = document.createElement('div');
        Object.assign(o.style, { marginTop: '10px', textAlign: 'right', fontSize: '18px' });

        const b = document.createElement('button');
        Object.assign(b, {
            textContent: 'Compute',
            style: 'margin-top:12px;width:100%;padding:8px;background:#0f0;color:#111;font-weight:bold;border:none;border-radius:6px;cursor:pointer'
        });

        b.onclick = () => {
            try {
                const res = Ω.exec(d.value);
                o.textContent = `= ${res}`;
            } catch { o.textContent = 'Error'; }
        };

        [d, b, o].forEach(x => r.appendChild(x));
        document.body.appendChild(r);
    })();
})();
