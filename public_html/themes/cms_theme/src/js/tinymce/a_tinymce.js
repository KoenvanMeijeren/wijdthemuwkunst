!function (j) {
    "use strict";

    function u() {
    }

    var q = function (n, r) {
        return function () {
            for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
            return n(r.apply(null, e))
        }
    }, $ = function (e) {
        return function () {
            return e
        }
    }, W = function (e) {
        return e
    };

    function d(r) {
        for (var o = [], e = 1; e < arguments.length; e++) o[e - 1] = arguments[e];
        return function () {
            for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
            var n = o.concat(e);
            return r.apply(null, n)
        }
    }

    function c(n) {
        return function () {
            for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
            return !n.apply(null, e)
        }
    }

    function e() {
        return i
    }

    var t, s = $(!1), a = $(!0), i = (t = {
        fold: function (e, t) {
            return e()
        },
        is: s,
        isSome: s,
        isNone: a,
        getOr: o,
        getOrThunk: r,
        getOrDie: function (e) {
            throw new Error(e || "error: getOrDie called on none.")
        },
        getOrNull: $(null),
        getOrUndefined: $(undefined),
        or: o,
        orThunk: r,
        map: e,
        each: u,
        bind: e,
        exists: s,
        forall: a,
        filter: e,
        equals: n,
        equals_: n,
        toArray: function () {
            return []
        },
        toString: $("none()")
    }, Object.freeze && Object.freeze(t), t);

    function n(e) {
        return e.isNone()
    }

    function r(e) {
        return e()
    }

    function o(e) {
        return e
    }

    function l(t) {
        return function (e) {
            return function (e) {
                if (null === e) return "null";
                var t = typeof e;
                return "object" == t && (Array.prototype.isPrototypeOf(e) || e.constructor && "Array" === e.constructor.name) ? "array" : "object" == t && (String.prototype.isPrototypeOf(e) || e.constructor && "String" === e.constructor.name) ? "string" : t
            }(e) === t
        }
    }

    function f(e, t) {
        return I.call(e, t)
    }

    function h(e, t) {
        return -1 < f(e, t)
    }

    function C(e, t) {
        for (var n = 0, r = e.length; n < r; n++) {
            if (t(e[n], n)) return !0
        }
        return !1
    }

    function m(e, t, n) {
        return function (e, t) {
            for (var n = e.length - 1; 0 <= n; n--) {
                t(e[n], n)
            }
        }(e, function (e) {
            n = t(n, e)
        }), n
    }

    function y(e, t, n) {
        return U(e, function (e) {
            n = t(n, e)
        }), n
    }

    function g(e, t) {
        for (var n = 0, r = e.length; n < r; n++) {
            var o = e[n];
            if (t(o, n)) return D.some(o)
        }
        return D.none()
    }

    function p(e, t) {
        for (var n = 0, r = e.length; n < r; n++) {
            if (t(e[n], n)) return D.some(n)
        }
        return D.none()
    }

    function v(e, t) {
        return function (e) {
            for (var t = [], n = 0, r = e.length; n < r; ++n) {
                if (!O(e[n])) throw new Error("Arr.flatten item " + n + " was not an array, input: " + e);
                F.apply(t, e[n])
            }
            return t
        }(X(e, t))
    }

    function b(e, t) {
        for (var n = 0, r = e.length; n < r; ++n) {
            if (!0 !== t(e[n], n)) return !1
        }
        return !0
    }

    function w(e) {
        var t = V.call(e, 0);
        return t.reverse(), t
    }

    function x(e, t) {
        return G(e, function (e) {
            return !h(t, e)
        })
    }

    function z(e) {
        return 0 === e.length ? D.none() : D.some(e[0])
    }

    function E(e) {
        return 0 === e.length ? D.none() : D.some(e[e.length - 1])
    }

    function N(e, t) {
        for (var n = J(e), r = 0, o = n.length; r < o; r++) {
            var i = n[r];
            t(e[i], i)
        }
    }

    function S(e, n) {
        return ee(e, function (e, t) {
            return {k: t, v: n(e, t)}
        })
    }

    function k(n) {
        return function (e, t) {
            n[t] = e
        }
    }

    function T(e, n, r, o) {
        return N(e, function (e, t) {
            (n(e, t) ? r : o)(e, t)
        }), {}
    }

    function A(e, t) {
        var n = {}, r = {};
        return T(e, t, k(n), k(r)), {t: n, f: r}
    }

    function M(e, t) {
        return te(e, t) ? D.from(e[t]) : D.none()
    }

    var R = function (n) {
            function e() {
                return o
            }

            function t(e) {
                return e(n)
            }

            var r = $(n), o = {
                fold: function (e, t) {
                    return t(n)
                },
                is: function (e) {
                    return n === e
                },
                isSome: a,
                isNone: s,
                getOr: r,
                getOrThunk: r,
                getOrDie: r,
                getOrNull: r,
                getOrUndefined: r,
                or: e,
                orThunk: e,
                map: function (e) {
                    return R(e(n))
                },
                each: function (e) {
                    e(n)
                },
                bind: t,
                exists: t,
                forall: t,
                filter: function (e) {
                    return e(n) ? o : i
                },
                toArray: function () {
                    return [n]
                },
                toString: function () {
                    return "some(" + n + ")"
                },
                equals: function (e) {
                    return e.is(n)
                },
                equals_: function (e, t) {
                    return e.fold(s, function (e) {
                        return t(n, e)
                    })
                }
            };
            return o
        }, D = {
            some: R, none: e, from: function (e) {
                return null === e || e === undefined ? i : R(e)
            }
        }, K = l("string"), _ = l("object"), O = l("array"), H = l("null"),
        B = l("boolean"), P = l("function"), L = l("number"),
        V = Array.prototype.slice, I = Array.prototype.indexOf,
        F = Array.prototype.push, X = function (e, t) {
            for (var n = e.length, r = new Array(n), o = 0; o < n; o++) {
                var i = e[o];
                r[o] = t(i, o)
            }
            return r
        }, U = function (e, t) {
            for (var n = 0, r = e.length; n < r; n++) {
                t(e[n], n)
            }
        }, Y = function (e, t) {
            for (var n = [], r = [], o = 0, i = e.length; o < i; o++) {
                var a = e[o];
                (t(a, o) ? n : r).push(a)
            }
            return {pass: n, fail: r}
        }, G = function (e, t) {
            for (var n = [], r = 0, o = e.length; r < o; r++) {
                var i = e[r];
                t(i, r) && n.push(i)
            }
            return n
        }, Z = P(Array.from) ? Array.from : function (e) {
            return V.call(e)
        }, J = Object.keys, Q = Object.hasOwnProperty, ee = function (e, r) {
            var o = {};
            return N(e, function (e, t) {
                var n = r(e, t);
                o[n.k] = n.v
            }), o
        }, te = function (e, t) {
            return Q.call(e, t)
        }, ne = function () {
            return (ne = Object.assign || function (e) {
                for (var t, n = 1, r = arguments.length; n < r; n++) for (var o in t = arguments[n]) Object.prototype.hasOwnProperty.call(t, o) && (e[o] = t[o]);
                return e
            }).apply(this, arguments)
        };

    function re(e, t) {
        var n = function (e, t) {
            for (var n = 0; n < e.length; n++) {
                var r = e[n];
                if (r.test(t)) return r
            }
            return undefined
        }(e, t);
        if (!n) return {major: 0, minor: 0};

        function r(e) {
            return Number(t.replace(n, "$" + e))
        }

        return st(r(1), r(2))
    }

    function oe(e, t) {
        return function () {
            return t === e
        }
    }

    function ie(e, t) {
        return function () {
            return t === e
        }
    }

    function ae(e, t) {
        var n = String(t).toLowerCase();
        return g(e, function (e) {
            return e.search(n)
        })
    }

    function ue(e, t) {
        return -1 !== e.indexOf(t)
    }

    function ce(e, t) {
        return function (e, t, n) {
            return "" === t || !(e.length < t.length) && e.substr(n, n + t.length) === t
        }(e, t, 0)
    }

    function se(e) {
        return e.replace(/^\s+|\s+$/g, "")
    }

    function le(e) {
        return e.replace(/\s+$/g, "")
    }

    function fe(t) {
        return function (e) {
            return ue(e, t)
        }
    }

    function de() {
        return kt.get()
    }

    function he() {
        for (var t = [], e = 0; e < arguments.length; e++) t[e] = arguments[e];
        return function () {
            for (var n = [], e = 0; e < arguments.length; e++) n[e] = arguments[e];
            if (t.length !== n.length) throw new Error('Wrong number of arguments to struct. Expected "[' + t.length + ']", got ' + n.length + " arguments");
            var r = {};
            return U(t, function (e, t) {
                r[e] = $(n[t])
            }), r
        }
    }

    function me(e, t, n) {
        return 0 != (e.compareDocumentPosition(t) & n)
    }

    function ge(e, t) {
        var n = e.dom();
        if (n.nodeType !== _t) return !1;
        var r = n;
        if (r.matches !== undefined) return r.matches(t);
        if (r.msMatchesSelector !== undefined) return r.msMatchesSelector(t);
        if (r.webkitMatchesSelector !== undefined) return r.webkitMatchesSelector(t);
        if (r.mozMatchesSelector !== undefined) return r.mozMatchesSelector(t);
        throw new Error("Browser lacks native selectors")
    }

    function pe(e) {
        return e.nodeType !== _t && e.nodeType !== Ot || 0 === e.childElementCount
    }

    function ve(e, t) {
        return e.dom() === t.dom()
    }

    function ye(e) {
        return at.fromDom(e.dom().ownerDocument)
    }

    function be(e) {
        return at.fromDom(e.dom().ownerDocument.defaultView)
    }

    function Ce(e) {
        return D.from(e.dom().parentNode).map(at.fromDom)
    }

    function we(e) {
        return D.from(e.dom().previousSibling).map(at.fromDom)
    }

    function xe(e) {
        return D.from(e.dom().nextSibling).map(at.fromDom)
    }

    function ze(e) {
        return w(Tt(e, we))
    }

    function Ee(e) {
        return Tt(e, xe)
    }

    function Ne(e) {
        return X(e.dom().childNodes, at.fromDom)
    }

    function Se(e, t) {
        var n = e.dom().childNodes;
        return D.from(n[t]).map(at.fromDom)
    }

    function ke(e) {
        return Se(e, 0)
    }

    function Te(e) {
        return Se(e, e.dom().childNodes.length - 1)
    }

    function Ae(t, n) {
        Ce(t).each(function (e) {
            e.dom().insertBefore(n.dom(), t.dom())
        })
    }

    function Me(e, t) {
        xe(e).fold(function () {
            Ce(e).each(function (e) {
                Bt(e, t)
            })
        }, function (e) {
            Ae(e, t)
        })
    }

    function Re(t, n) {
        ke(t).fold(function () {
            Bt(t, n)
        }, function (e) {
            t.dom().insertBefore(n.dom(), e.dom())
        })
    }

    function De(t, e) {
        U(e, function (e) {
            Bt(t, e)
        })
    }

    function _e(e) {
        e.dom().textContent = "", U(Ne(e), function (e) {
            Pt(e)
        })
    }

    function Oe(e) {
        var t = Ne(e);
        0 < t.length && function (t, e) {
            U(e, function (e) {
                Ae(t, e)
            })
        }(e, t), Pt(e)
    }

    function He(e) {
        return e.dom().nodeName.toLowerCase()
    }

    function Be(t) {
        return function (e) {
            return function (e) {
                return e.dom().nodeType
            }(e) === t
        }
    }

    function Pe(e) {
        var t = Vt(e) ? e.dom().parentNode : e.dom();
        return t !== undefined && null !== t && t.ownerDocument.body.contains(t)
    }

    function Le(e, t) {
        return e !== undefined ? e : t !== undefined ? t : 0
    }

    function Ve(e) {
        var t = e !== undefined ? e.dom() : j.document,
            n = t.body.scrollLeft || t.documentElement.scrollLeft,
            r = t.body.scrollTop || t.documentElement.scrollTop;
        return Ft(n, r)
    }

    function Ie(e, t, n) {
        (n !== undefined ? n.dom() : j.document).defaultView.scrollTo(e, t)
    }

    function Fe(e, t) {
        jt && P(e.dom().scrollIntoViewIfNeeded) ? e.dom().scrollIntoViewIfNeeded(!1) : e.dom().scrollIntoView(t)
    }

    function Ue(e, t, n, r) {
        return {
            x: $(e),
            y: $(t),
            width: $(n),
            height: $(r),
            right: $(e + n),
            bottom: $(t + r)
        }
    }

    function je(t) {
        return function (e) {
            return !!e && e.nodeType === t
        }
    }

    function qe(e) {
        var n = e.map(function (e) {
            return e.toLowerCase()
        });
        return function (e) {
            if (e && e.nodeName) {
                var t = e.nodeName.toLowerCase();
                return h(n, t)
            }
            return !1
        }
    }

    function $e(t) {
        return function (e) {
            if ($t(e)) {
                if (e.contentEditable === t) return !0;
                if (e.getAttribute("data-mce-contenteditable") === t) return !0
            }
            return !1
        }
    }

    function We(e) {
        return e.style !== undefined && P(e.style.getPropertyValue)
    }

    function Ke(e, t, n) {
        if (!(K(n) || B(n) || L(n))) throw j.console.error("Invalid call to Attr.set. Key ", t, ":: Value ", n, ":: Element ", e), new Error("Attribute value was not simple");
        e.setAttribute(t, n + "")
    }

    function Xe(e, t) {
        var n = e.dom();
        N(t, function (e, t) {
            Ke(n, t, e)
        })
    }

    function Ye(e, t) {
        var n = e.dom().getAttribute(t);
        return null === n ? undefined : n
    }

    function Ge(e, t) {
        e.dom().removeAttribute(t)
    }

    function Ze(e, t) {
        var n = e.dom(), r = j.window.getComputedStyle(n).getPropertyValue(t),
            o = "" !== r || Pe(e) ? r : nn(n, t);
        return null === o ? undefined : o
    }

    function Je(e, t) {
        var n = e.dom(), r = nn(n, t);
        return D.from(r).filter(function (e) {
            return 0 < e.length
        })
    }

    function Qe(e) {
        return g(e, Lt)
    }

    function et(e, t) {
        return e.children && h(e.children, t)
    }

    var tt, nt, rt, ot, it = function (e) {
            if (null === e || e === undefined) throw new Error("Node cannot be null or undefined");
            return {dom: $(e)}
        }, at = {
            fromHtml: function (e, t) {
                var n = (t || j.document).createElement("div");
                if (n.innerHTML = e, !n.hasChildNodes() || 1 < n.childNodes.length) throw j.console.error("HTML does not have a single root node", e), new Error("HTML must have a single root node");
                return it(n.childNodes[0])
            }, fromTag: function (e, t) {
                var n = (t || j.document).createElement(e);
                return it(n)
            }, fromText: function (e, t) {
                var n = (t || j.document).createTextNode(e);
                return it(n)
            }, fromDom: it, fromPoint: function (e, t, n) {
                var r = e.dom();
                return D.from(r.elementFromPoint(t, n)).map(it)
            }
        }, ut = function (e) {
            function t() {
                return n
            }

            var n = e;
            return {
                get: t, set: function (e) {
                    n = e
                }, clone: function () {
                    return ut(t())
                }
            }
        }, ct = function () {
            return st(0, 0)
        }, st = function (e, t) {
            return {major: e, minor: t}
        }, lt = {
            nu: st, detect: function (e, t) {
                var n = String(t).toLowerCase();
                return 0 === e.length ? ct() : re(e, n)
            }, unknown: ct
        }, ft = "Firefox", dt = function (e) {
            var t = e.current;
            return {
                current: t,
                version: e.version,
                isEdge: oe("Edge", t),
                isChrome: oe("Chrome", t),
                isIE: oe("IE", t),
                isOpera: oe("Opera", t),
                isFirefox: oe(ft, t),
                isSafari: oe("Safari", t)
            }
        }, ht = {
            unknown: function () {
                return dt({current: undefined, version: lt.unknown()})
            },
            nu: dt,
            edge: $("Edge"),
            chrome: $("Chrome"),
            ie: $("IE"),
            opera: $("Opera"),
            firefox: $(ft),
            safari: $("Safari")
        }, mt = "Windows", gt = "Android", pt = "Solaris", vt = "FreeBSD",
        yt = "ChromeOS", bt = function (e) {
            var t = e.current;
            return {
                current: t,
                version: e.version,
                isWindows: ie(mt, t),
                isiOS: ie("iOS", t),
                isAndroid: ie(gt, t),
                isOSX: ie("OSX", t),
                isLinux: ie("Linux", t),
                isSolaris: ie(pt, t),
                isFreeBSD: ie(vt, t),
                isChromeOS: ie(yt, t)
            }
        }, Ct = {
            unknown: function () {
                return bt({current: undefined, version: lt.unknown()})
            },
            nu: bt,
            windows: $(mt),
            ios: $("iOS"),
            android: $(gt),
            linux: $("Linux"),
            osx: $("OSX"),
            solaris: $(pt),
            freebsd: $(vt),
            chromeos: $(yt)
        }, wt = function (e, n) {
            return ae(e, n).map(function (e) {
                var t = lt.detect(e.versionRegexes, n);
                return {current: e.name, version: t}
            })
        }, xt = function (e, n) {
            return ae(e, n).map(function (e) {
                var t = lt.detect(e.versionRegexes, n);
                return {current: e.name, version: t}
            })
        }, zt = /.*?version\/\ ?([0-9]+)\.([0-9]+).*/, Et = [{
            name: "Edge",
            versionRegexes: [/.*?edge\/ ?([0-9]+)\.([0-9]+)$/],
            search: function (e) {
                return ue(e, "edge/") && ue(e, "chrome") && ue(e, "safari") && ue(e, "applewebkit")
            }
        }, {
            name: "Chrome",
            versionRegexes: [/.*?chrome\/([0-9]+)\.([0-9]+).*/, zt],
            search: function (e) {
                return ue(e, "chrome") && !ue(e, "chromeframe")
            }
        }, {
            name: "IE",
            versionRegexes: [/.*?msie\ ?([0-9]+)\.([0-9]+).*/, /.*?rv:([0-9]+)\.([0-9]+).*/],
            search: function (e) {
                return ue(e, "msie") || ue(e, "trident")
            }
        }, {
            name: "Opera",
            versionRegexes: [zt, /.*?opera\/([0-9]+)\.([0-9]+).*/],
            search: fe("opera")
        }, {
            name: "Firefox",
            versionRegexes: [/.*?firefox\/\ ?([0-9]+)\.([0-9]+).*/],
            search: fe("firefox")
        }, {
            name: "Safari",
            versionRegexes: [zt, /.*?cpu os ([0-9]+)_([0-9]+).*/],
            search: function (e) {
                return (ue(e, "safari") || ue(e, "mobile/")) && ue(e, "applewebkit")
            }
        }], Nt = [{
            name: "Windows",
            search: fe("win"),
            versionRegexes: [/.*?windows\ nt\ ?([0-9]+)\.([0-9]+).*/]
        }, {
            name: "iOS",
            search: function (e) {
                return ue(e, "iphone") || ue(e, "ipad")
            },
            versionRegexes: [/.*?version\/\ ?([0-9]+)\.([0-9]+).*/, /.*cpu os ([0-9]+)_([0-9]+).*/, /.*cpu iphone os ([0-9]+)_([0-9]+).*/]
        }, {
            name: "Android",
            search: fe("android"),
            versionRegexes: [/.*?android\ ?([0-9]+)\.([0-9]+).*/]
        }, {
            name: "OSX",
            search: fe("mac os x"),
            versionRegexes: [/.*?mac\ os\ x\ ?([0-9]+)_([0-9]+).*/]
        }, {
            name: "Linux",
            search: fe("linux"),
            versionRegexes: []
        }, {
            name: "Solaris",
            search: fe("sunos"),
            versionRegexes: []
        }, {
            name: "FreeBSD",
            search: fe("freebsd"),
            versionRegexes: []
        }, {
            name: "ChromeOS",
            search: fe("cros"),
            versionRegexes: [/.*?chrome\/([0-9]+)\.([0-9]+).*/]
        }], St = {browsers: $(Et), oses: $(Nt)}, kt = ut(function (e, t) {
            var n = St.browsers(), r = St.oses(),
                o = wt(n, e).fold(ht.unknown, ht.nu),
                i = xt(r, e).fold(Ct.unknown, Ct.nu);
            return {
                browser: o, os: i, deviceType: function (e, t, n, r) {
                    var o = e.isiOS() && !0 === /ipad/i.test(n),
                        i = e.isiOS() && !o, a = e.isiOS() || e.isAndroid(),
                        u = a || r("(pointer:coarse)"),
                        c = o || !i && a && r("(min-device-width:768px)"),
                        s = i || a && !c,
                        l = t.isSafari() && e.isiOS() && !1 === /safari/i.test(n),
                        f = !s && !c && !l;
                    return {
                        isiPad: $(o),
                        isiPhone: $(i),
                        isTablet: $(c),
                        isPhone: $(s),
                        isTouch: $(u),
                        isAndroid: e.isAndroid,
                        isiOS: e.isiOS,
                        isWebView: $(l),
                        isDesktop: $(f)
                    }
                }(i, o, e, t)
            }
        }(j.navigator.userAgent, function (e) {
            return j.window.matchMedia(e).matches
        })), Tt = function (e, t) {
            for (var n = [], r = function (e) {
                return n.push(e), t(e)
            }, o = t(e); (o = o.bind(r)).isSome();) ;
            return n
        }, At = function (e, t) {
            return me(e, t, j.Node.DOCUMENT_POSITION_CONTAINED_BY)
        },
        Mt = (j.Node.ATTRIBUTE_NODE, j.Node.CDATA_SECTION_NODE, j.Node.COMMENT_NODE, j.Node.DOCUMENT_NODE),
        Rt = (j.Node.DOCUMENT_TYPE_NODE, j.Node.DOCUMENT_FRAGMENT_NODE, j.Node.ELEMENT_NODE),
        Dt = j.Node.TEXT_NODE,
        _t = (j.Node.PROCESSING_INSTRUCTION_NODE, j.Node.ENTITY_REFERENCE_NODE, j.Node.ENTITY_NODE, j.Node.NOTATION_NODE, Rt),
        Ot = Mt, Ht = de().browser.isIE() ? function (e, t) {
            return At(e.dom(), t.dom())
        } : function (e, t) {
            var n = e.dom(), r = t.dom();
            return n !== r && n.contains(r)
        }, Bt = (he("element", "offset"), function (e, t) {
            e.dom().appendChild(t.dom())
        }), Pt = function (e) {
            var t = e.dom();
            null !== t.parentNode && t.parentNode.removeChild(t)
        },
        Lt = ("undefined" != typeof j.window ? j.window : Function("return this;")(), Be(Rt)),
        Vt = Be(Dt), It = function (n, r) {
            return {
                left: $(n), top: $(r), translate: function (e, t) {
                    return It(n + e, r + t)
                }
            }
        }, Ft = It, Ut = function (e) {
            var t = e.dom(), n = t.ownerDocument.body;
            return n === t ? Ft(n.offsetLeft, n.offsetTop) : Pe(e) ? function (e) {
                var t = e.getBoundingClientRect();
                return Ft(t.left, t.top)
            }(t) : Ft(0, 0)
        }, jt = de().browser.isSafari(), qt = function (e) {
            var r = e === undefined ? j.window : e, t = r.document,
                o = Ve(at.fromDom(t));
            return function (e) {
                var t = e === undefined ? j.window : e;
                return D.from(t.visualViewport)
            }(r).fold(function () {
                var e = r.document.documentElement, t = e.clientWidth,
                    n = e.clientHeight;
                return Ue(o.left(), o.top(), t, n)
            }, function (e) {
                return Ue(Math.max(e.pageLeft, o.left()), Math.max(e.pageTop, o.top()), e.width, e.height)
            })
        }, $t = je(1), Wt = qe(["textarea", "input"]), Kt = je(3), Xt = je(8),
        Yt = je(9), Gt = je(11), Zt = qe(["br"]), Jt = $e("true"),
        Qt = $e("false"), en = {
            isText: Kt,
            isElement: $t,
            isComment: Xt,
            isDocument: Yt,
            isDocumentFragment: Gt,
            isBr: Zt,
            isContentEditableTrue: Jt,
            isContentEditableFalse: Qt,
            isRestrictedNode: function (e) {
                return !!e && !Object.getPrototypeOf(e)
            },
            matchNodeNames: qe,
            hasPropValue: function (t, n) {
                return function (e) {
                    return $t(e) && e[t] === n
                }
            },
            hasAttribute: function (t, e) {
                return function (e) {
                    return $t(e) && e.hasAttribute(t)
                }
            },
            hasAttributeValue: function (t, n) {
                return function (e) {
                    return $t(e) && e.getAttribute(t) === n
                }
            },
            matchStyleValues: function (r, e) {
                var o = e.toLowerCase().split(" ");
                return function (e) {
                    var t;
                    if ($t(e)) for (t = 0; t < o.length; t++) {
                        var n = e.ownerDocument.defaultView.getComputedStyle(e, null);
                        if ((n ? n.getPropertyValue(r) : null) === o[t]) return !0
                    }
                    return !1
                }
            },
            isBogus: function (e) {
                return $t(e) && e.hasAttribute("data-mce-bogus")
            },
            isBogusAll: function (e) {
                return $t(e) && "all" === e.getAttribute("data-mce-bogus")
            },
            isTable: function (e) {
                return $t(e) && "TABLE" === e.tagName
            },
            isTextareaOrInput: Wt
        }, tn = function (e, t, n) {
            Ke(e.dom(), t, n)
        }, nn = function (e, t) {
            return We(e) ? e.style.getPropertyValue(t) : ""
        }, rn = de().browser, on = {
            getPos: function (e, t, n) {
                var r, o, i = 0, a = 0, u = e.ownerDocument;
                if (n = n || e, t) {
                    if (n === e && t.getBoundingClientRect && "static" === Ze(at.fromDom(e), "position")) return {
                        x: i = (o = t.getBoundingClientRect()).left + (u.documentElement.scrollLeft || e.scrollLeft) - u.documentElement.clientLeft,
                        y: a = o.top + (u.documentElement.scrollTop || e.scrollTop) - u.documentElement.clientTop
                    };
                    for (r = t; r && r !== n && r.nodeType && !et(r, n);) i += r.offsetLeft || 0, a += r.offsetTop || 0, r = r.offsetParent;
                    for (r = t.parentNode; r && r !== n && r.nodeType && !et(r, n);) i -= r.scrollLeft || 0, a -= r.scrollTop || 0, r = r.parentNode;
                    a += function (e) {
                        return rn.isFirefox() && "table" === He(e) ? Qe(Ne(e)).filter(function (e) {
                            return "caption" === He(e)
                        }).bind(function (o) {
                            return Qe(Ee(o)).map(function (e) {
                                var t = e.dom().offsetTop, n = o.dom().offsetTop,
                                    r = o.dom().offsetHeight;
                                return t <= n ? -r : 0
                            })
                        }).getOr(0) : 0
                    }(at.fromDom(t))
                }
                return {x: i, y: a}
            }
        }, an = {}, un = {exports: an};
    tt = undefined, nt = an, rt = un, ot = undefined, function (e) {
        "object" == typeof nt && void 0 !== rt ? rt.exports = e() : "function" == typeof tt && tt.amd ? tt([], e) : ("undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : this).EphoxContactWrapper = e()
    }(function () {
        return function l(i, a, u) {
            function c(t, e) {
                if (!a[t]) {
                    if (!i[t]) {
                        var n = "function" == typeof ot && ot;
                        if (!e && n) return n(t, !0);
                        if (s) return s(t, !0);
                        var r = new Error("Cannot find module '" + t + "'");
                        throw r.code = "MODULE_NOT_FOUND", r
                    }
                    var o = a[t] = {exports: {}};
                    i[t][0].call(o.exports, function (e) {
                        return c(i[t][1][e] || e)
                    }, o, o.exports, l, i, a, u)
                }
                return a[t].exports
            }

            for (var s = "function" == typeof ot && ot, e = 0; e < u.length; e++) c(u[e]);
            return c
        }({
            1: [function (e, t, n) {
                var r, o, i = t.exports = {};

                function a() {
                    throw new Error("setTimeout has not been defined")
                }

                function u() {
                    throw new Error("clearTimeout has not been defined")
                }

                function c(e) {
                    if (r === setTimeout) return setTimeout(e, 0);
                    if ((r === a || !r) && setTimeout) return r = setTimeout, setTimeout(e, 0);
                    try {
                        return r(e, 0)
                    } catch (t) {
                        try {
                            return r.call(null, e, 0)
                        } catch (t) {
                            return r.call(this, e, 0)
                        }
                    }
                }

                !function () {
                    try {
                        r = "function" == typeof setTimeout ? setTimeout : a
                    } catch (e) {
                        r = a
                    }
                    try {
                        o = "function" == typeof clearTimeout ? clearTimeout : u
                    } catch (e) {
                        o = u
                    }
                }();
                var s, l = [], f = !1, d = -1;

                function h() {
                    f && s && (f = !1, s.length ? l = s.concat(l) : d = -1, l.length && m())
                }

                function m() {
                    if (!f) {
                        var e = c(h);
                        f = !0;
                        for (var t = l.length; t;) {
                            for (s = l, l = []; ++d < t;) s && s[d].run();
                            d = -1, t = l.length
                        }
                        s = null, f = !1, function n(e) {
                            if (o === clearTimeout) return clearTimeout(e);
                            if ((o === u || !o) && clearTimeout) return o = clearTimeout, clearTimeout(e);
                            try {
                                return o(e)
                            } catch (t) {
                                try {
                                    return o.call(null, e)
                                } catch (t) {
                                    return o.call(this, e)
                                }
                            }
                        }(e)
                    }
                }

                function g(e, t) {
                    this.fun = e, this.array = t
                }

                function p() {
                }

                i.nextTick = function (e) {
                    var t = new Array(arguments.length - 1);
                    if (1 < arguments.length) for (var n = 1; n < arguments.length; n++) t[n - 1] = arguments[n];
                    l.push(new g(e, t)), 1 !== l.length || f || c(m)
                }, g.prototype.run = function () {
                    this.fun.apply(null, this.array)
                }, i.title = "browser", i.browser = !0, i.env = {}, i.argv = [], i.version = "", i.versions = {}, i.on = p, i.addListener = p, i.once = p, i.off = p, i.removeListener = p, i.removeAllListeners = p, i.emit = p, i.prependListener = p, i.prependOnceListener = p, i.listeners = function (e) {
                    return []
                }, i.binding = function (e) {
                    throw new Error("process.binding is not supported")
                }, i.cwd = function () {
                    return "/"
                }, i.chdir = function (e) {
                    throw new Error("process.chdir is not supported")
                }, i.umask = function () {
                    return 0
                }
            }, {}], 2: [function (e, f, t) {
                (function (t) {
                    function r() {
                    }

                    function i(e) {
                        if ("object" != typeof this) throw new TypeError("Promises must be constructed via new");
                        if ("function" != typeof e) throw new TypeError("not a function");
                        this._state = 0, this._handled = !1, this._value = undefined, this._deferreds = [], l(e, this)
                    }

                    function o(r, o) {
                        for (; 3 === r._state;) r = r._value;
                        0 !== r._state ? (r._handled = !0, i._immediateFn(function () {
                            var e = 1 === r._state ? o.onFulfilled : o.onRejected;
                            if (null !== e) {
                                var t;
                                try {
                                    t = e(r._value)
                                } catch (n) {
                                    return void u(o.promise, n)
                                }
                                a(o.promise, t)
                            } else (1 === r._state ? a : u)(o.promise, r._value)
                        })) : r._deferreds.push(o)
                    }

                    function a(e, t) {
                        try {
                            if (t === e) throw new TypeError("A promise cannot be resolved with itself.");
                            if (t && ("object" == typeof t || "function" == typeof t)) {
                                var n = t.then;
                                if (t instanceof i) return e._state = 3, e._value = t, void c(e);
                                if ("function" == typeof n) return void l(function r(e, t) {
                                    return function () {
                                        e.apply(t, arguments)
                                    }
                                }(n, t), e)
                            }
                            e._state = 1, e._value = t, c(e)
                        } catch (o) {
                            u(e, o)
                        }
                    }

                    function u(e, t) {
                        e._state = 2, e._value = t, c(e)
                    }

                    function c(e) {
                        2 === e._state && 0 === e._deferreds.length && i._immediateFn(function () {
                            e._handled || i._unhandledRejectionFn(e._value)
                        });
                        for (var t = 0, n = e._deferreds.length; t < n; t++) o(e, e._deferreds[t]);
                        e._deferreds = null
                    }

                    function s(e, t, n) {
                        this.onFulfilled = "function" == typeof e ? e : null, this.onRejected = "function" == typeof t ? t : null, this.promise = n
                    }

                    function l(e, t) {
                        var n = !1;
                        try {
                            e(function (e) {
                                n || (n = !0, a(t, e))
                            }, function (e) {
                                n || (n = !0, u(t, e))
                            })
                        } catch (r) {
                            if (n) return;
                            n = !0, u(t, r)
                        }
                    }

                    var e, n;
                    e = this, n = setTimeout, i.prototype["catch"] = function (e) {
                        return this.then(null, e)
                    }, i.prototype.then = function (e, t) {
                        var n = new this.constructor(r);
                        return o(this, new s(e, t, n)), n
                    }, i.all = function (e) {
                        var c = Array.prototype.slice.call(e);
                        return new i(function (o, i) {
                            if (0 === c.length) return o([]);
                            var a = c.length;

                            function u(t, e) {
                                try {
                                    if (e && ("object" == typeof e || "function" == typeof e)) {
                                        var n = e.then;
                                        if ("function" == typeof n) return void n.call(e, function (e) {
                                            u(t, e)
                                        }, i)
                                    }
                                    c[t] = e, 0 == --a && o(c)
                                } catch (r) {
                                    i(r)
                                }
                            }

                            for (var e = 0; e < c.length; e++) u(e, c[e])
                        })
                    }, i.resolve = function (t) {
                        return t && "object" == typeof t && t.constructor === i ? t : new i(function (e) {
                            e(t)
                        })
                    }, i.reject = function (n) {
                        return new i(function (e, t) {
                            t(n)
                        })
                    }, i.race = function (o) {
                        return new i(function (e, t) {
                            for (var n = 0, r = o.length; n < r; n++) o[n].then(e, t)
                        })
                    }, i._immediateFn = "function" == typeof t ? function (e) {
                        t(e)
                    } : function (e) {
                        n(e, 0)
                    }, i._unhandledRejectionFn = function (e) {
                        "undefined" != typeof console && console && console.warn("Possible Unhandled Promise Rejection:", e)
                    }, i._setImmediateFn = function (e) {
                        i._immediateFn = e
                    }, i._setUnhandledRejectionFn = function (e) {
                        i._unhandledRejectionFn = e
                    }, void 0 !== f && f.exports ? f.exports = i : e.Promise || (e.Promise = i)
                }).call(this, e("timers").setImmediate)
            }, {timers: 3}], 3: [function (c, e, s) {
                (function (e, t) {
                    var r = c("process/browser.js").nextTick,
                        n = Function.prototype.apply, o = Array.prototype.slice,
                        i = {}, a = 0;

                    function u(e, t) {
                        this._id = e, this._clearFn = t
                    }

                    s.setTimeout = function () {
                        return new u(n.call(setTimeout, window, arguments), clearTimeout)
                    }, s.setInterval = function () {
                        return new u(n.call(setInterval, window, arguments), clearInterval)
                    }, s.clearTimeout = s.clearInterval = function (e) {
                        e.close()
                    }, u.prototype.unref = u.prototype.ref = function () {
                    }, u.prototype.close = function () {
                        this._clearFn.call(window, this._id)
                    }, s.enroll = function (e, t) {
                        clearTimeout(e._idleTimeoutId), e._idleTimeout = t
                    }, s.unenroll = function (e) {
                        clearTimeout(e._idleTimeoutId), e._idleTimeout = -1
                    }, s._unrefActive = s.active = function (e) {
                        clearTimeout(e._idleTimeoutId);
                        var t = e._idleTimeout;
                        0 <= t && (e._idleTimeoutId = setTimeout(function () {
                            e._onTimeout && e._onTimeout()
                        }, t))
                    }, s.setImmediate = "function" == typeof e ? e : function (e) {
                        var t = a++,
                            n = !(arguments.length < 2) && o.call(arguments, 1);
                        return i[t] = !0, r(function () {
                            i[t] && (n ? e.apply(null, n) : e.call(null), s.clearImmediate(t))
                        }), t
                    }, s.clearImmediate = "function" == typeof t ? t : function (e) {
                        delete i[e]
                    }
                }).call(this, c("timers").setImmediate, c("timers").clearImmediate)
            }, {"process/browser.js": 1, timers: 3}], 4: [function (e, t, n) {
                var r = e("promise-polyfill"),
                    o = "undefined" != typeof window ? window : Function("return this;")();
                t.exports = {boltExport: o.Promise || r}
            }, {"promise-polyfill": 2}]
        }, {}, [4])(4)
    });

    function cn(e) {
        j.setTimeout(function () {
            throw e
        }, 0)
    }

    function sn(i, e) {
        return e(function (n) {
            var r = [], o = 0;
            0 === i.length ? n([]) : U(i, function (e, t) {
                e.get(function (t) {
                    return function (e) {
                        r[t] = e, ++o >= i.length && n(r)
                    }
                }(t))
            })
        })
    }

    var ln, fn, dn, hn = un.exports.boltExport, mn = function (e) {
            var n = D.none(), t = [], r = function (e) {
                o() ? a(e) : t.push(e)
            }, o = function () {
                return n.isSome()
            }, i = function (e) {
                U(e, a)
            }, a = function (t) {
                n.each(function (e) {
                    j.setTimeout(function () {
                        t(e)
                    }, 0)
                })
            };
            return e(function (e) {
                n = D.some(e), i(t), t = []
            }), {
                get: r, map: function (n) {
                    return mn(function (t) {
                        r(function (e) {
                            t(n(e))
                        })
                    })
                }, isReady: o
            }
        }, gn = {
            nu: mn, pure: function (t) {
                return mn(function (e) {
                    e(t)
                })
            }
        }, pn = function (n) {
            function e(e) {
                n().then(e, cn)
            }

            return {
                map: function (e) {
                    return pn(function () {
                        return n().then(e)
                    })
                }, bind: function (t) {
                    return pn(function () {
                        return n().then(function (e) {
                            return t(e).toPromise()
                        })
                    })
                }, anonBind: function (e) {
                    return pn(function () {
                        return n().then(function () {
                            return e.toPromise()
                        })
                    })
                }, toLazy: function () {
                    return gn.nu(e)
                }, toCached: function () {
                    var e = null;
                    return pn(function () {
                        return null === e && (e = n()), e
                    })
                }, toPromise: n, get: e
            }
        }, vn = {
            nu: function (e) {
                return pn(function () {
                    return new hn(e)
                })
            }, pure: function (e) {
                return pn(function () {
                    return hn.resolve(e)
                })
            }
        }, yn = function (e) {
            return sn(e, vn.nu)
        }, bn = function (n) {
            return {
                is: function (e) {
                    return n === e
                },
                isValue: a,
                isError: s,
                getOr: $(n),
                getOrThunk: $(n),
                getOrDie: $(n),
                or: function (e) {
                    return bn(n)
                },
                orThunk: function (e) {
                    return bn(n)
                },
                fold: function (e, t) {
                    return t(n)
                },
                map: function (e) {
                    return bn(e(n))
                },
                mapError: function (e) {
                    return bn(n)
                },
                each: function (e) {
                    e(n)
                },
                bind: function (e) {
                    return e(n)
                },
                exists: function (e) {
                    return e(n)
                },
                forall: function (e) {
                    return e(n)
                },
                toOption: function () {
                    return D.some(n)
                }
            }
        }, Cn = function (n) {
            return {
                is: s,
                isValue: s,
                isError: a,
                getOr: W,
                getOrThunk: function (e) {
                    return e()
                },
                getOrDie: function () {
                    return function (e) {
                        return function () {
                            throw new Error(e)
                        }
                    }(String(n))()
                },
                or: function (e) {
                    return e
                },
                orThunk: function (e) {
                    return e()
                },
                fold: function (e, t) {
                    return e(n)
                },
                map: function (e) {
                    return Cn(n)
                },
                mapError: function (e) {
                    return Cn(e(n))
                },
                each: u,
                bind: function (e) {
                    return Cn(n)
                },
                exists: s,
                forall: a,
                toOption: D.none
            }
        }, wn = {
            value: bn, error: Cn, fromOption: function (e, t) {
                return e.fold(function () {
                    return Cn(t)
                }, bn)
            }
        },
        xn = window.Promise ? window.Promise : (ln = Array.isArray || function (e) {
            return "[object Array]" === Object.prototype.toString.call(e)
        }, fn = En.immediateFn || "function" == typeof j.setImmediate && j.setImmediate || function (e) {
            j.setTimeout(e, 1)
        }, En.prototype["catch"] = function (e) {
            return this.then(null, e)
        }, En.prototype.then = function (n, r) {
            var o = this;
            return new En(function (e, t) {
                Nn.call(o, new An(n, r, e, t))
            })
        }, En.all = function () {
            var c = Array.prototype.slice.call(1 === arguments.length && ln(arguments[0]) ? arguments[0] : arguments);
            return new En(function (o, i) {
                if (0 === c.length) return o([]);
                var a = c.length;

                function u(t, e) {
                    try {
                        if (e && ("object" == typeof e || "function" == typeof e)) {
                            var n = e.then;
                            if ("function" == typeof n) return void n.call(e, function (e) {
                                u(t, e)
                            }, i)
                        }
                        c[t] = e, 0 == --a && o(c)
                    } catch (r) {
                        i(r)
                    }
                }

                for (var e = 0; e < c.length; e++) u(e, c[e])
            })
        }, En.resolve = function (t) {
            return t && "object" == typeof t && t.constructor === En ? t : new En(function (e) {
                e(t)
            })
        }, En.reject = function (n) {
            return new En(function (e, t) {
                t(n)
            })
        }, En.race = function (o) {
            return new En(function (e, t) {
                for (var n = 0, r = o.length; n < r; n++) o[n].then(e, t)
            })
        }, En);

    function zn(e, t) {
        return function () {
            e.apply(t, arguments)
        }
    }

    function En(e) {
        if ("object" != typeof this) throw new TypeError("Promises must be constructed via new");
        if ("function" != typeof e) throw new TypeError("not a function");
        this._state = null, this._value = null, this._deferreds = [], Mn(e, zn(Sn, this), zn(kn, this))
    }

    function Nn(r) {
        var o = this;
        null !== this._state ? fn(function () {
            var e = o._state ? r.onFulfilled : r.onRejected;
            if (null !== e) {
                var t;
                try {
                    t = e(o._value)
                } catch (n) {
                    return void r.reject(n)
                }
                r.resolve(t)
            } else (o._state ? r.resolve : r.reject)(o._value)
        }) : this._deferreds.push(r)
    }

    function Sn(e) {
        try {
            if (e === this) throw new TypeError("A promise cannot be resolved with itself.");
            if (e && ("object" == typeof e || "function" == typeof e)) {
                var t = e.then;
                if ("function" == typeof t) return void Mn(zn(t, e), zn(Sn, this), zn(kn, this))
            }
            this._state = !0, this._value = e, Tn.call(this)
        } catch (n) {
            kn.call(this, n)
        }
    }

    function kn(e) {
        this._state = !1, this._value = e, Tn.call(this)
    }

    function Tn() {
        for (var e = 0, t = this._deferreds.length; e < t; e++) Nn.call(this, this._deferreds[e]);
        this._deferreds = null
    }

    function An(e, t, n, r) {
        this.onFulfilled = "function" == typeof e ? e : null, this.onRejected = "function" == typeof t ? t : null, this.resolve = n, this.reject = r
    }

    function Mn(e, t, n) {
        var r = !1;
        try {
            e(function (e) {
                r || (r = !0, t(e))
            }, function (e) {
                r || (r = !0, n(e))
            })
        } catch (o) {
            if (r) return;
            r = !0, n(o)
        }
    }

    function Rn(e, t) {
        return "number" != typeof t && (t = 0), j.setTimeout(e, t)
    }

    function Dn(e, t) {
        return "number" != typeof t && (t = 1), j.setInterval(e, t)
    }

    function _n(n, r) {
        var o, e;
        return (e = function () {
            for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
            j.clearTimeout(o), o = Rn(function () {
                n.apply(this, e)
            }, r)
        }).stop = function () {
            j.clearTimeout(o)
        }, e
    }

    function On(e, t, n) {
        var r, o;
        if (!e) return 0;
        if (n = n || e, e.length !== undefined) {
            for (r = 0, o = e.length; r < o; r++) if (!1 === t.call(n, e[r], r, e)) return 0
        } else for (r in e) if (e.hasOwnProperty(r) && !1 === t.call(n, e[r], r, e)) return 0;
        return 1
    }

    function Hn(e, t, n) {
        var r, o;
        for (r = 0, o = e.length; r < o; r++) if (t.call(n, e[r], r, e)) return r;
        return -1
    }

    function Bn(e) {
        return null === e || e === undefined ? "" : ("" + e).replace(Gn, "")
    }

    function Pn(e, t) {
        return t ? !("array" !== t || !Yn.isArray(e)) || typeof e === t : e !== undefined
    }

    var Ln = {
            requestAnimationFrame: function (e, t) {
                dn ? dn.then(e) : dn = new xn(function (e) {
                    !function (e, t) {
                        var n, r = j.window.requestAnimationFrame,
                            o = ["ms", "moz", "webkit"];
                        for (n = 0; n < o.length && !r; n++) r = j.window[o[n] + "RequestAnimationFrame"];
                        (r = r || function (e) {
                            j.window.setTimeout(e, 0)
                        })(e, t)
                    }(e, t = t || j.document.body)
                }).then(e)
            },
            setTimeout: Rn,
            setInterval: Dn,
            setEditorTimeout: function (e, t, n) {
                return Rn(function () {
                    e.removed || t()
                }, n)
            },
            setEditorInterval: function (e, t, n) {
                var r;
                return r = Dn(function () {
                    e.removed ? j.clearInterval(r) : t()
                }, n)
            },
            debounce: _n,
            throttle: _n,
            clearInterval: function (e) {
                return j.clearInterval(e)
            },
            clearTimeout: function (e) {
                return j.clearTimeout(e)
            }
        }, Vn = j.navigator.userAgent, In = de(), Fn = In.browser, Un = In.os,
        jn = In.deviceType, qn = /WebKit/.test(Vn) && !Fn.isEdge(),
        $n = "FormData" in j.window && "FileReader" in j.window && "URL" in j.window && !!j.URL.createObjectURL,
        Wn = -1 !== Vn.indexOf("Windows Phone"), Kn = {
            opera: Fn.isOpera(),
            webkit: qn,
            ie: !(!Fn.isIE() && !Fn.isEdge()) && Fn.version.major,
            gecko: Fn.isFirefox(),
            mac: Un.isOSX() || Un.isiOS(),
            iOS: jn.isiPad() || jn.isiPhone(),
            android: Un.isAndroid(),
            contentEditable: !0,
            transparentSrc: "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7",
            caretAfter: !0,
            range: j.window.getSelection && "Range" in j.window,
            documentMode: Fn.isIE() ? j.document.documentMode || 7 : 10,
            fileApi: $n,
            ceFalse: !0,
            cacheSuffix: null,
            container: null,
            experimentalShadowDom: !1,
            canHaveCSP: !Fn.isIE(),
            desktop: jn.isDesktop(),
            windowsPhone: Wn,
            browser: {
                current: Fn.current,
                version: Fn.version,
                isChrome: Fn.isChrome,
                isEdge: Fn.isEdge,
                isFirefox: Fn.isFirefox,
                isIE: Fn.isIE,
                isOpera: Fn.isOpera,
                isSafari: Fn.isSafari
            },
            os: {
                current: Un.current,
                version: Un.version,
                isAndroid: Un.isAndroid,
                isChromeOS: Un.isChromeOS,
                isFreeBSD: Un.isFreeBSD,
                isiOS: Un.isiOS,
                isLinux: Un.isLinux,
                isOSX: Un.isOSX,
                isSolaris: Un.isSolaris,
                isWindows: Un.isWindows
            },
            deviceType: {
                isDesktop: jn.isDesktop,
                isiPad: jn.isiPad,
                isiPhone: jn.isiPhone,
                isPhone: jn.isPhone,
                isTablet: jn.isTablet,
                isTouch: jn.isTouch,
                isWebView: jn.isWebView
            }
        }, Xn = Array.isArray, Yn = {
            isArray: Xn, toArray: function (e) {
                var t, n, r = e;
                if (!Xn(e)) for (r = [], t = 0, n = e.length; t < n; t++) r[t] = e[t];
                return r
            }, each: On, map: function (n, r) {
                var o = [];
                return On(n, function (e, t) {
                    o.push(r(e, t, n))
                }), o
            }, filter: function (n, r) {
                var o = [];
                return On(n, function (e, t) {
                    r && !r(e, t, n) || o.push(e)
                }), o
            }, indexOf: function (e, t) {
                var n, r;
                if (e) for (n = 0, r = e.length; n < r; n++) if (e[n] === t) return n;
                return -1
            }, reduce: function (e, t, n, r) {
                var o = 0;
                for (arguments.length < 3 && (n = e[0]); o < e.length; o++) n = t.call(r, n, e[o], o);
                return n
            }, findIndex: Hn, find: function (e, t, n) {
                var r = Hn(e, t, n);
                return -1 !== r ? e[r] : undefined
            }, last: function (e) {
                return e[e.length - 1]
            }
        }, Gn = /^\s*|\s*$/g, Zn = function (e, n, r, o) {
            o = o || this, e && (r && (e = e[r]), Yn.each(e, function (e, t) {
                if (!1 === n.call(o, e, t, r)) return !1;
                Zn(e, n, r, o)
            }))
        }, Jn = {
            trim: Bn,
            isArray: Yn.isArray,
            is: Pn,
            toArray: Yn.toArray,
            makeMap: function (e, t, n) {
                var r;
                for (t = t || ",", "string" == typeof (e = e || []) && (e = e.split(t)), n = n || {}, r = e.length; r--;) n[e[r]] = {};
                return n
            },
            each: Yn.each,
            map: Yn.map,
            grep: Yn.filter,
            inArray: Yn.indexOf,
            hasOwn: function (e, t) {
                return Object.prototype.hasOwnProperty.call(e, t)
            },
            extend: function (e, t) {
                for (var n, r, o, i = [], a = 2; a < arguments.length; a++) i[a - 2] = arguments[a];
                var u, c = arguments;
                for (n = 1, r = c.length; n < r; n++) for (o in t = c[n]) t.hasOwnProperty(o) && (u = t[o]) !== undefined && (e[o] = u);
                return e
            },
            create: function (e, t, n) {
                var r, o, i, a, u, c = this, s = 0;
                if (e = /^((static) )?([\w.]+)(:([\w.]+))?/.exec(e), i = e[3].match(/(^|\.)(\w+)$/i)[2], !(o = c.createNS(e[3].replace(/\.\w+$/, ""), n))[i]) {
                    if ("static" === e[2]) return o[i] = t, void (this.onCreate && this.onCreate(e[2], e[3], o[i]));
                    t[i] || (t[i] = function () {
                    }, s = 1), o[i] = t[i], c.extend(o[i].prototype, t), e[5] && (r = c.resolve(e[5]).prototype, a = e[5].match(/\.(\w+)$/i)[1], u = o[i], o[i] = s ? function () {
                        return r[a].apply(this, arguments)
                    } : function () {
                        return this.parent = r[a], u.apply(this, arguments)
                    }, o[i].prototype[i] = o[i], c.each(r, function (e, t) {
                        o[i].prototype[t] = r[t]
                    }), c.each(t, function (e, t) {
                        r[t] ? o[i].prototype[t] = function () {
                            return this.parent = r[t], e.apply(this, arguments)
                        } : t !== i && (o[i].prototype[t] = e)
                    })), c.each(t["static"], function (e, t) {
                        o[i][t] = e
                    })
                }
            },
            walk: Zn,
            createNS: function (e, t) {
                var n, r;
                for (t = t || j.window, e = e.split("."), n = 0; n < e.length; n++) t[r = e[n]] || (t[r] = {}), t = t[r];
                return t
            },
            resolve: function (e, t) {
                var n, r;
                for (t = t || j.window, n = 0, r = (e = e.split(".")).length; n < r && (t = t[e[n]]); n++) ;
                return t
            },
            explode: function (e, t) {
                return !e || Pn(e, "array") ? e : Yn.map(e.split(t || ","), Bn)
            },
            _addCacheSuffix: function (e) {
                var t = Kn.cacheSuffix;
                return t && (e += (-1 === e.indexOf("?") ? "?" : "&") + t), e
            }
        };

    function Qn(t) {
        var n;
        return function (e) {
            return (n = n || function (e, t) {
                for (var n = {}, r = 0, o = e.length; r < o; r++) {
                    var i = e[r];
                    n[String(i)] = t(i, r)
                }
                return n
            }(t, $(!0))).hasOwnProperty(He(e))
        }
    }

    function er(e) {
        return Lt(e) && !ur(e)
    }

    function tr(e) {
        return Lt(e) && "br" === He(e)
    }

    function nr(e) {
        return e && "SPAN" === e.tagName && "bookmark" === e.getAttribute("data-mce-type")
    }

    var rr, or, ir, ar = Qn(["h1", "h2", "h3", "h4", "h5", "h6"]),
        ur = Qn(["article", "aside", "details", "div", "dt", "figcaption", "footer", "form", "fieldset", "header", "hgroup", "html", "main", "nav", "section", "summary", "body", "p", "dl", "multicol", "dd", "figure", "address", "center", "blockquote", "h1", "h2", "h3", "h4", "h5", "h6", "listing", "xmp", "pre", "plaintext", "menu", "dir", "ul", "ol", "li", "hr", "table", "tbody", "thead", "tfoot", "th", "tr", "td", "caption"]),
        cr = Qn(["h1", "h2", "h3", "h4", "h5", "h6", "p", "div", "address", "pre", "form", "blockquote", "center", "dir", "fieldset", "header", "footer", "article", "section", "hgroup", "aside", "nav", "figure"]),
        sr = Qn(["ul", "ol", "dl"]), lr = Qn(["li", "dd", "dt"]),
        fr = Qn(["area", "base", "basefont", "br", "col", "frame", "hr", "img", "input", "isindex", "link", "meta", "param", "embed", "source", "wbr", "track"]),
        dr = Qn(["thead", "tbody", "tfoot"]), hr = Qn(["td", "th"]),
        mr = Qn(["pre", "script", "textarea", "style"]), gr = function (e, t) {
            var n, r = t.childNodes;
            if (!en.isElement(t) || !nr(t)) {
                for (n = r.length - 1; 0 <= n; n--) gr(e, r[n]);
                if (!1 === en.isDocument(t)) {
                    if (en.isText(t) && 0 < t.nodeValue.length) {
                        var o = Jn.trim(t.nodeValue).length;
                        if (e.isBlock(t.parentNode) || 0 < o) return;
                        if (0 === o && function (e) {
                            var t = e.previousSibling && "SPAN" === e.previousSibling.nodeName,
                                n = e.nextSibling && "SPAN" === e.nextSibling.nodeName;
                            return t && n
                        }(t)) return
                    } else if (en.isElement(t) && (1 === (r = t.childNodes).length && nr(r[0]) && t.parentNode.insertBefore(r[0], t), r.length || fr(at.fromDom(t)))) return;
                    e.remove(t)
                }
                return t
            }
        }, pr = {trimNode: gr}, vr = Jn.makeMap,
        yr = /[&<>\"\u0060\u007E-\uD7FF\uE000-\uFFEF]|[\uD800-\uDBFF][\uDC00-\uDFFF]/g,
        br = /[<>&\u007E-\uD7FF\uE000-\uFFEF]|[\uD800-\uDBFF][\uDC00-\uDFFF]/g,
        Cr = /[<>&\"\']/g, wr = /&#([a-z0-9]+);?|&([a-z0-9]+);/gi, xr = {
            128: "\u20ac",
            130: "\u201a",
            131: "\u0192",
            132: "\u201e",
            133: "\u2026",
            134: "\u2020",
            135: "\u2021",
            136: "\u02c6",
            137: "\u2030",
            138: "\u0160",
            139: "\u2039",
            140: "\u0152",
            142: "\u017d",
            145: "\u2018",
            146: "\u2019",
            147: "\u201c",
            148: "\u201d",
            149: "\u2022",
            150: "\u2013",
            151: "\u2014",
            152: "\u02dc",
            153: "\u2122",
            154: "\u0161",
            155: "\u203a",
            156: "\u0153",
            158: "\u017e",
            159: "\u0178"
        };
    or = {
        '"': "&quot;",
        "'": "&#39;",
        "<": "&lt;",
        ">": "&gt;",
        "&": "&amp;",
        "`": "&#96;"
    }, ir = {
        "&lt;": "<",
        "&gt;": ">",
        "&amp;": "&",
        "&quot;": '"',
        "&apos;": "'"
    };

    function zr(e, t) {
        var n, r, o, i = {};
        if (e) {
            for (e = e.split(","), t = t || 10, n = 0; n < e.length; n += 2) r = String.fromCharCode(parseInt(e[n], t)), or[r] || (o = "&" + e[n + 1] + ";", i[r] = o, i[o] = r);
            return i
        }
    }

    rr = zr("50,nbsp,51,iexcl,52,cent,53,pound,54,curren,55,yen,56,brvbar,57,sect,58,uml,59,copy,5a,ordf,5b,laquo,5c,not,5d,shy,5e,reg,5f,macr,5g,deg,5h,plusmn,5i,sup2,5j,sup3,5k,acute,5l,micro,5m,para,5n,middot,5o,cedil,5p,sup1,5q,ordm,5r,raquo,5s,frac14,5t,frac12,5u,frac34,5v,iquest,60,Agrave,61,Aacute,62,Acirc,63,Atilde,64,Auml,65,Aring,66,AElig,67,Ccedil,68,Egrave,69,Eacute,6a,Ecirc,6b,Euml,6c,Igrave,6d,Iacute,6e,Icirc,6f,Iuml,6g,ETH,6h,Ntilde,6i,Ograve,6j,Oacute,6k,Ocirc,6l,Otilde,6m,Ouml,6n,times,6o,Oslash,6p,Ugrave,6q,Uacute,6r,Ucirc,6s,Uuml,6t,Yacute,6u,THORN,6v,szlig,70,agrave,71,aacute,72,acirc,73,atilde,74,auml,75,aring,76,aelig,77,ccedil,78,egrave,79,eacute,7a,ecirc,7b,euml,7c,igrave,7d,iacute,7e,icirc,7f,iuml,7g,eth,7h,ntilde,7i,ograve,7j,oacute,7k,ocirc,7l,otilde,7m,ouml,7n,divide,7o,oslash,7p,ugrave,7q,uacute,7r,ucirc,7s,uuml,7t,yacute,7u,thorn,7v,yuml,ci,fnof,sh,Alpha,si,Beta,sj,Gamma,sk,Delta,sl,Epsilon,sm,Zeta,sn,Eta,so,Theta,sp,Iota,sq,Kappa,sr,Lambda,ss,Mu,st,Nu,su,Xi,sv,Omicron,t0,Pi,t1,Rho,t3,Sigma,t4,Tau,t5,Upsilon,t6,Phi,t7,Chi,t8,Psi,t9,Omega,th,alpha,ti,beta,tj,gamma,tk,delta,tl,epsilon,tm,zeta,tn,eta,to,theta,tp,iota,tq,kappa,tr,lambda,ts,mu,tt,nu,tu,xi,tv,omicron,u0,pi,u1,rho,u2,sigmaf,u3,sigma,u4,tau,u5,upsilon,u6,phi,u7,chi,u8,psi,u9,omega,uh,thetasym,ui,upsih,um,piv,812,bull,816,hellip,81i,prime,81j,Prime,81u,oline,824,frasl,88o,weierp,88h,image,88s,real,892,trade,89l,alefsym,8cg,larr,8ch,uarr,8ci,rarr,8cj,darr,8ck,harr,8dl,crarr,8eg,lArr,8eh,uArr,8ei,rArr,8ej,dArr,8ek,hArr,8g0,forall,8g2,part,8g3,exist,8g5,empty,8g7,nabla,8g8,isin,8g9,notin,8gb,ni,8gf,prod,8gh,sum,8gi,minus,8gn,lowast,8gq,radic,8gt,prop,8gu,infin,8h0,ang,8h7,and,8h8,or,8h9,cap,8ha,cup,8hb,int,8hk,there4,8hs,sim,8i5,cong,8i8,asymp,8j0,ne,8j1,equiv,8j4,le,8j5,ge,8k2,sub,8k3,sup,8k4,nsub,8k6,sube,8k7,supe,8kl,oplus,8kn,otimes,8l5,perp,8m5,sdot,8o8,lceil,8o9,rceil,8oa,lfloor,8ob,rfloor,8p9,lang,8pa,rang,9ea,loz,9j0,spades,9j3,clubs,9j5,hearts,9j6,diams,ai,OElig,aj,oelig,b0,Scaron,b1,scaron,bo,Yuml,m6,circ,ms,tilde,802,ensp,803,emsp,809,thinsp,80c,zwnj,80d,zwj,80e,lrm,80f,rlm,80j,ndash,80k,mdash,80o,lsquo,80p,rsquo,80q,sbquo,80s,ldquo,80t,rdquo,80u,bdquo,810,dagger,811,Dagger,81g,permil,81p,lsaquo,81q,rsaquo,85c,euro", 32);

    function Er(e, t) {
        return e.replace(t ? yr : br, function (e) {
            return or[e] || e
        })
    }

    function Nr(e, t) {
        return e.replace(t ? yr : br, function (e) {
            return 1 < e.length ? "&#" + (1024 * (e.charCodeAt(0) - 55296) + (e.charCodeAt(1) - 56320) + 65536) + ";" : or[e] || "&#" + e.charCodeAt(0) + ";"
        })
    }

    function Sr(e, t, n) {
        return n = n || rr, e.replace(t ? yr : br, function (e) {
            return or[e] || n[e] || e
        })
    }

    var kr = {
            encodeRaw: Er, encodeAllRaw: function (e) {
                return ("" + e).replace(Cr, function (e) {
                    return or[e] || e
                })
            }, encodeNumeric: Nr, encodeNamed: Sr, getEncodeFunc: function (e, t) {
                var n = zr(t) || rr, r = vr(e.replace(/\+/g, ","));
                return r.named && r.numeric ? function (e, t) {
                    return e.replace(t ? yr : br, function (e) {
                        return or[e] !== undefined ? or[e] : n[e] !== undefined ? n[e] : 1 < e.length ? "&#" + (1024 * (e.charCodeAt(0) - 55296) + (e.charCodeAt(1) - 56320) + 65536) + ";" : "&#" + e.charCodeAt(0) + ";"
                    })
                } : r.named ? t ? function (e, t) {
                    return Sr(e, t, n)
                } : Sr : r.numeric ? Nr : Er
            }, decode: function (e) {
                return e.replace(wr, function (e, t) {
                    return t ? 65535 < (t = "x" === t.charAt(0).toLowerCase() ? parseInt(t.substr(1), 16) : parseInt(t, 10)) ? (t -= 65536, String.fromCharCode(55296 + (t >> 10), 56320 + (1023 & t))) : xr[t] || String.fromCharCode(t) : ir[e] || rr[e] || function (e) {
                        var t;
                        return (t = at.fromTag("div").dom()).innerHTML = e, t.textContent || t.innerText || e
                    }(e)
                })
            }
        }, Tr = {}, Ar = {}, Mr = Jn.makeMap, Rr = Jn.each, Dr = Jn.extend,
        _r = Jn.explode, Or = Jn.inArray, Hr = function (e, t) {
            return (e = Jn.trim(e)) ? e.split(t || " ") : []
        }, Br = function (e) {
            function t(e, t, n) {
                function r(e, t) {
                    var n, r, o = {};
                    for (n = 0, r = e.length; n < r; n++) o[e[n]] = t || {};
                    return o
                }

                var o, i, a;
                for (t = t || "", "string" == typeof (n = n || []) && (n = Hr(n)), o = (e = Hr(e)).length; o--;) a = {
                    attributes: r(i = Hr([u, t].join(" "))),
                    attributesOrder: i,
                    children: r(n, Ar)
                }, s[e[o]] = a
            }

            function n(e, t) {
                var n, r, o, i;
                for (n = (e = Hr(e)).length, t = Hr(t); n--;) for (r = s[e[n]], o = 0, i = t.length; o < i; o++) r.attributes[t[o]] = {}, r.attributesOrder.push(t[o])
            }

            var u, r, o, i, a, c, s = {};
            return Tr[e] ? Tr[e] : (u = "id accesskey class dir lang style tabindex title role", r = "address blockquote div dl fieldset form h1 h2 h3 h4 h5 h6 hr menu ol p pre table ul", o = "a abbr b bdo br button cite code del dfn em embed i iframe img input ins kbd label map noscript object q s samp script select small span strong sub sup textarea u var #text #comment", "html4" !== e && (u += " contenteditable contextmenu draggable dropzone hidden spellcheck translate", r += " article aside details dialog figure main header footer hgroup section nav", o += " audio canvas command datalist mark meter output picture progress time wbr video ruby bdi keygen"), "html5-strict" !== e && (u += " xml:lang", o = [o, c = "acronym applet basefont big font strike tt"].join(" "), Rr(Hr(c), function (e) {
                t(e, "", o)
            }), r = [r, a = "center dir isindex noframes"].join(" "), i = [r, o].join(" "), Rr(Hr(a), function (e) {
                t(e, "", i)
            })), i = i || [r, o].join(" "), t("html", "manifest", "head body"), t("head", "", "base command link meta noscript script style title"), t("title hr noscript br"), t("base", "href target"), t("link", "href rel media hreflang type sizes hreflang"), t("meta", "name http-equiv content charset"), t("style", "media type scoped"), t("script", "src async defer type charset"), t("body", "onafterprint onbeforeprint onbeforeunload onblur onerror onfocus onhashchange onload onmessage onoffline ononline onpagehide onpageshow onpopstate onresize onscroll onstorage onunload", i), t("address dt dd div caption", "", i), t("h1 h2 h3 h4 h5 h6 pre p abbr code var samp kbd sub sup i b u bdo span legend em strong small s cite dfn", "", o), t("blockquote", "cite", i), t("ol", "reversed start type", "li"), t("ul", "", "li"), t("li", "value", i), t("dl", "", "dt dd"), t("a", "href target rel media hreflang type", o), t("q", "cite", o), t("ins del", "cite datetime", i), t("img", "src sizes srcset alt usemap ismap width height"), t("iframe", "src name width height", i), t("embed", "src type width height"), t("object", "data type typemustmatch name usemap form width height", [i, "param"].join(" ")), t("param", "name value"), t("map", "name", [i, "area"].join(" ")), t("area", "alt coords shape href target rel media hreflang type"), t("table", "border", "caption colgroup thead tfoot tbody tr" + ("html4" === e ? " col" : "")), t("colgroup", "span", "col"), t("col", "span"), t("tbody thead tfoot", "", "tr"), t("tr", "", "td th"), t("td", "colspan rowspan headers", i), t("th", "colspan rowspan headers scope abbr", i), t("form", "accept-charset action autocomplete enctype method name novalidate target", i), t("fieldset", "disabled form name", [i, "legend"].join(" ")), t("label", "form for", o), t("input", "accept alt autocomplete checked dirname disabled form formaction formenctype formmethod formnovalidate formtarget height list max maxlength min multiple name pattern readonly required size src step type value width"), t("button", "disabled form formaction formenctype formmethod formnovalidate formtarget name type value", "html4" === e ? i : o), t("select", "disabled form multiple name required size", "option optgroup"), t("optgroup", "disabled label", "option"), t("option", "disabled label selected value"), t("textarea", "cols dirname disabled form maxlength name readonly required rows wrap"), t("menu", "type label", [i, "li"].join(" ")), t("noscript", "", i), "html4" !== e && (t("wbr"), t("ruby", "", [o, "rt rp"].join(" ")), t("figcaption", "", i), t("mark rt rp summary bdi", "", o), t("canvas", "width height", i), t("video", "src crossorigin poster preload autoplay mediagroup loop muted controls width height buffered", [i, "track source"].join(" ")), t("audio", "src crossorigin preload autoplay mediagroup loop muted controls buffered volume", [i, "track source"].join(" ")), t("picture", "", "img source"), t("source", "src srcset type media sizes"), t("track", "kind src srclang label default"), t("datalist", "", [o, "option"].join(" ")), t("article section nav aside main header footer", "", i), t("hgroup", "", "h1 h2 h3 h4 h5 h6"), t("figure", "", [i, "figcaption"].join(" ")), t("time", "datetime", o), t("dialog", "open", i), t("command", "type label icon disabled checked radiogroup command"), t("output", "for form name", o), t("progress", "value max", o), t("meter", "value min max low high optimum", o), t("details", "open", [i, "summary"].join(" ")), t("keygen", "autofocus challenge disabled form keytype name")), "html5-strict" !== e && (n("script", "language xml:space"), n("style", "xml:space"), n("object", "declare classid code codebase codetype archive standby align border hspace vspace"), n("embed", "align name hspace vspace"), n("param", "valuetype type"), n("a", "charset name rev shape coords"), n("br", "clear"), n("applet", "codebase archive code object alt name width height align hspace vspace"), n("img", "name longdesc align border hspace vspace"), n("iframe", "longdesc frameborder marginwidth marginheight scrolling align"), n("font basefont", "size color face"), n("input", "usemap align"), n("select"), n("textarea"), n("h1 h2 h3 h4 h5 h6 div p legend caption", "align"), n("ul", "type compact"), n("li", "type"), n("ol dl menu dir", "compact"), n("pre", "width xml:space"), n("hr", "align noshade size width"), n("isindex", "prompt"), n("table", "summary width frame rules cellspacing cellpadding align bgcolor"), n("col", "width align char charoff valign"), n("colgroup", "width align char charoff valign"), n("thead", "align char charoff valign"), n("tr", "align char charoff valign bgcolor"), n("th", "axis align char charoff valign nowrap bgcolor width height"), n("form", "accept"), n("td", "abbr axis scope align char charoff valign nowrap bgcolor width height"), n("tfoot", "align char charoff valign"), n("tbody", "align char charoff valign"), n("area", "nohref"), n("body", "background bgcolor text link vlink alink")), "html4" !== e && (n("input button select textarea", "autofocus"), n("input textarea", "placeholder"), n("a", "download"), n("link script img", "crossorigin"), n("img", "loading"), n("iframe", "sandbox seamless allowfullscreen loading")), Rr(Hr("a form meter progress dfn"), function (e) {
                s[e] && delete s[e].children[e]
            }), delete s.caption.children.table, delete s.script, Tr[e] = s)
        }, Pr = function (e, n) {
            var r;
            return e && (r = {}, "string" == typeof e && (e = {"*": e}), Rr(e, function (e, t) {
                r[t] = r[t.toUpperCase()] = "map" === n ? Mr(e, /[, ]/) : _r(e, /[, ]/)
            })), r
        };

    function Lr(i) {
        function e(e, t, n) {
            var r = i[e];
            return r ? r = Mr(r, /[, ]/, Mr(r.toUpperCase(), /[, ]/)) : (r = Tr[e]) || (r = Mr(t, " ", Mr(t.toUpperCase(), " ")), r = Dr(r, n), Tr[e] = r), r
        }

        var t, n, r, o, a, u, c, s, l, f, d, h, m, z = {}, g = {}, E = [],
            p = {}, v = {};
        r = Br((i = i || {}).schema), !1 === i.verify_html && (i.valid_elements = "*[*]"), t = Pr(i.valid_styles), n = Pr(i.invalid_styles, "map"), s = Pr(i.valid_classes, "map"), o = e("whitespace_elements", "pre script noscript style textarea video audio iframe object code"), a = e("self_closing_elements", "colgroup dd dt li option p td tfoot th thead tr"), u = e("short_ended_elements", "area base basefont br col frame hr img input isindex link meta param embed source wbr track"), c = e("boolean_attributes", "checked compact declare defer disabled ismap multiple nohref noresize noshade nowrap readonly selected autoplay loop controls"), f = e("non_empty_elements", "td th iframe video audio object script pre code", u), d = e("move_caret_before_on_enter_elements", "table", f), h = e("text_block_elements", "h1 h2 h3 h4 h5 h6 p div address pre form blockquote center dir fieldset header footer article section hgroup aside main nav figure"), l = e("block_elements", "hr table tbody thead tfoot th tr td li ol ul caption dl dt dd noscript menu isindex option datalist select optgroup figcaption details summary", h), m = e("text_inline_elements", "span strong b em i font strike u var cite dfn code mark q sup sub samp"), Rr((i.special || "script noscript noframes noembed title style textarea xmp").split(" "), function (e) {
            v[e] = new RegExp("</" + e + "[^>]*>", "gi")
        });

        function N(e) {
            return new RegExp("^" + e.replace(/([?+*])/g, ".$1") + "$")
        }

        function y(e) {
            var t, n, r, o, i, a, u, c, s, l, f, d, h, m, g, p, v, y, b,
                C = /^([#+\-])?([^\[!\/]+)(?:\/([^\[!]+))?(?:(!?)\[([^\]]+)\])?$/,
                w = /^([!\-])?(\w+[\\:]:\w+|[^=:<]+)?(?:([=:<])(.*))?$/,
                x = /[*?+]/;
            if (e) for (e = Hr(e, ","), z["@"] && (p = z["@"].attributes, v = z["@"].attributesOrder), t = 0, n = e.length; t < n; t++) if (i = C.exec(e[t])) {
                if (m = i[1], s = i[2], g = i[3], c = i[5], a = {
                    attributes: d = {},
                    attributesOrder: h = []
                }, "#" === m && (a.paddEmpty = !0), "-" === m && (a.removeEmpty = !0), "!" === i[4] && (a.removeEmptyAttrs = !0), p) {
                    for (y in p) d[y] = p[y];
                    h.push.apply(h, v)
                }
                if (c) for (r = 0, o = (c = Hr(c, "|")).length; r < o; r++) if (i = w.exec(c[r])) {
                    if (u = {}, f = i[1], l = i[2].replace(/[\\:]:/g, ":"), m = i[3], b = i[4], "!" === f && (a.attributesRequired = a.attributesRequired || [], a.attributesRequired.push(l), u.required = !0), "-" === f) {
                        delete d[l], h.splice(Or(h, l), 1);
                        continue
                    }
                    m && ("=" === m && (a.attributesDefault = a.attributesDefault || [], a.attributesDefault.push({
                        name: l,
                        value: b
                    }), u.defaultValue = b), ":" === m && (a.attributesForced = a.attributesForced || [], a.attributesForced.push({
                        name: l,
                        value: b
                    }), u.forcedValue = b), "<" === m && (u.validValues = Mr(b, "?"))), x.test(l) ? (a.attributePatterns = a.attributePatterns || [], u.pattern = N(l), a.attributePatterns.push(u)) : (d[l] || h.push(l), d[l] = u)
                }
                p || "@" !== s || (p = d, v = h), g && (a.outputName = s, z[g] = a), x.test(s) ? (a.pattern = N(s), E.push(a)) : z[s] = a
            }
        }

        function b(e) {
            z = {}, E = [], y(e), Rr(r, function (e, t) {
                g[t] = e.children
            })
        }

        function C(e) {
            var a = /^(~)?(.+)$/;
            e && (Tr.text_block_elements = Tr.block_elements = null, Rr(Hr(e, ","), function (e) {
                var t = a.exec(e), n = "~" === t[1], r = n ? "span" : "div",
                    o = t[2];
                if (g[o] = g[r], p[o] = r, n || (l[o.toUpperCase()] = {}, l[o] = {}), !z[o]) {
                    var i = z[r];
                    delete (i = Dr({}, i)).removeEmptyAttrs, delete i.removeEmpty, z[o] = i
                }
                Rr(g, function (e, t) {
                    e[r] && (g[t] = e = Dr({}, g[t]), e[o] = e[r])
                })
            }))
        }

        function w(e) {
            var o = /^([+\-]?)(\w+)\[([^\]]+)\]$/;
            Tr[i.schema] = null, e && Rr(Hr(e, ","), function (e) {
                var t, n, r = o.exec(e);
                r && (n = r[1], t = n ? g[r[2]] : g[r[2]] = {"#comment": {}}, t = g[r[2]], Rr(Hr(r[3], "|"), function (e) {
                    "-" === n ? delete t[e] : t[e] = {}
                }))
            })
        }

        function x(e) {
            var t, n = z[e];
            if (n) return n;
            for (t = E.length; t--;) if ((n = E[t]).pattern.test(e)) return n
        }

        i.valid_elements ? b(i.valid_elements) : (Rr(r, function (e, t) {
            z[t] = {
                attributes: e.attributes,
                attributesOrder: e.attributesOrder
            }, g[t] = e.children
        }), "html5" !== i.schema && Rr(Hr("strong/b em/i"), function (e) {
            e = Hr(e, "/"), z[e[1]].outputName = e[0]
        }), Rr(Hr("ol ul sub sup blockquote span font a table tbody tr strong em b i"), function (e) {
            z[e] && (z[e].removeEmpty = !0)
        }), Rr(Hr("p h1 h2 h3 h4 h5 h6 th td pre div address caption li"), function (e) {
            z[e].paddEmpty = !0
        }), Rr(Hr("span"), function (e) {
            z[e].removeEmptyAttrs = !0
        })), C(i.custom_elements), w(i.valid_children), y(i.extended_valid_elements), w("+ol[ul|ol],+ul[ul|ol]"), Rr({
            dd: "dl",
            dt: "dl",
            li: "ul ol",
            td: "tr",
            th: "tr",
            tr: "tbody thead tfoot",
            tbody: "table",
            thead: "table",
            tfoot: "table",
            legend: "fieldset",
            area: "map",
            param: "video audio object"
        }, function (e, t) {
            z[t] && (z[t].parentsRequired = Hr(e))
        }), i.invalid_elements && Rr(_r(i.invalid_elements), function (e) {
            z[e] && delete z[e]
        }), x("span") || y("span[!data-mce-type|*]");
        return {
            children: g,
            elements: z,
            getValidStyles: function () {
                return t
            },
            getValidClasses: function () {
                return s
            },
            getBlockElements: function () {
                return l
            },
            getInvalidStyles: function () {
                return n
            },
            getShortEndedElements: function () {
                return u
            },
            getTextBlockElements: function () {
                return h
            },
            getTextInlineElements: function () {
                return m
            },
            getBoolAttrs: function () {
                return c
            },
            getElementRule: x,
            getSelfClosingElements: function () {
                return a
            },
            getNonEmptyElements: function () {
                return f
            },
            getMoveCaretBeforeOnEnterElements: function () {
                return d
            },
            getWhiteSpaceElements: function () {
                return o
            },
            getSpecialElements: function () {
                return v
            },
            isValidChild: function (e, t) {
                var n = g[e.toLowerCase()];
                return !(!n || !n[t.toLowerCase()])
            },
            isValid: function (e, t) {
                var n, r, o = x(e);
                if (o) {
                    if (!t) return !0;
                    if (o.attributes[t]) return !0;
                    if (n = o.attributePatterns) for (r = n.length; r--;) if (n[r].pattern.test(e)) return !0
                }
                return !1
            },
            getCustomElements: function () {
                return p
            },
            addValidElements: y,
            setValidElements: b,
            addCustomElements: C,
            addValidChildren: w
        }
    }

    function Vr(e, t, n, r) {
        function o(e) {
            return 1 < (e = parseInt(e, 10).toString(16)).length ? e : "0" + e
        }

        return "#" + o(t) + o(n) + o(r)
    }

    function Ir(e, t, n, r) {
        e.addEventListener ? e.addEventListener(t, n, r || !1) : e.attachEvent && e.attachEvent("on" + t, n)
    }

    function Fr(e, t, n, r) {
        e.removeEventListener ? e.removeEventListener(t, n, r || !1) : e.detachEvent && e.detachEvent("on" + t, n)
    }

    function Ur(e, t) {
        var n, r = t || {};
        for (n in e) Xr[n] || (r[n] = e[n]);
        if (r.target || (r.target = r.srcElement || j.document), Kn.experimentalShadowDom && (r.target = function (e, t) {
            if (e.composedPath) {
                var n = e.composedPath();
                if (n && 0 < n.length) return n[0]
            }
            return t
        }(e, r.target)), e && Kr.test(e.type) && e.pageX === undefined && e.clientX !== undefined) {
            var o = r.target.ownerDocument || j.document, i = o.documentElement,
                a = o.body;
            r.pageX = e.clientX + (i && i.scrollLeft || a && a.scrollLeft || 0) - (i && i.clientLeft || a && a.clientLeft || 0), r.pageY = e.clientY + (i && i.scrollTop || a && a.scrollTop || 0) - (i && i.clientTop || a && a.clientTop || 0)
        }
        return r.preventDefault = function () {
            r.isDefaultPrevented = Gr, e && (e.preventDefault ? e.preventDefault() : e.returnValue = !1)
        }, r.stopPropagation = function () {
            r.isPropagationStopped = Gr, e && (e.stopPropagation ? e.stopPropagation() : e.cancelBubble = !0)
        }, !(r.stopImmediatePropagation = function () {
            r.isImmediatePropagationStopped = Gr, r.stopPropagation()
        }) === function (e) {
            return e.isDefaultPrevented === Gr || e.isDefaultPrevented === Yr
        }(r) && (r.isDefaultPrevented = Yr, r.isPropagationStopped = Yr, r.isImmediatePropagationStopped = Yr), "undefined" == typeof r.metaKey && (r.metaKey = !1), r
    }

    function jr(e, t, n) {
        var r = e.document, o = {type: "ready"};
        if (n.domLoaded) t(o); else {
            var i = function () {
                Fr(e, "DOMContentLoaded", i), Fr(e, "load", i), n.domLoaded || (n.domLoaded = !0, t(o))
            };
            "complete" === r.readyState || "interactive" === r.readyState && r.body ? i() : Ir(e, "DOMContentLoaded", i), Ir(e, "load", i)
        }
    }

    var qr = "\ufeff", $r = "\xa0", Wr = function (b, e) {
        var C, t, s, l,
            w = /rgb\s*\(\s*([0-9]+)\s*,\s*([0-9]+)\s*,\s*([0-9]+)\s*\)/gi,
            x = /(?:url(?:(?:\(\s*\"([^\"]+)\"\s*\))|(?:\(\s*\'([^\']+)\'\s*\))|(?:\(\s*([^)\s]+)\s*\))))|(?:\'([^\']+)\')|(?:\"([^\"]+)\")/gi,
            z = /\s*([^:]+):\s*([^;]+);?/g, E = /\s+$/, N = {}, S = qr;
        for (b = b || {}, e && (s = e.getValidStyles(), l = e.getInvalidStyles()), t = ("\\\" \\' \\; \\: ; : " + S).split(" "), C = 0; C < t.length; C++) N[t[C]] = S + C, N[S + C] = t[C];
        return {
            toHex: function (e) {
                return e.replace(w, Vr)
            }, parse: function (e) {
                function t(e, t, n) {
                    var r, o, i, a;
                    if ((r = p[e + "-top" + t]) && (o = p[e + "-right" + t]) && (i = p[e + "-bottom" + t]) && (a = p[e + "-left" + t])) {
                        var u = [r, o, i, a];
                        for (C = u.length - 1; C-- && u[C] === u[C + 1];) ;
                        -1 < C && n || (p[e + t] = -1 === C ? u[0] : u.join(" "), delete p[e + "-top" + t], delete p[e + "-right" + t], delete p[e + "-bottom" + t], delete p[e + "-left" + t])
                    }
                }

                function n(e) {
                    var t, n = p[e];
                    if (n) {
                        for (t = (n = n.split(" ")).length; t--;) if (n[t] !== n[0]) return !1;
                        return p[e] = n[0], !0
                    }
                }

                function r(e) {
                    return f = !0, N[e]
                }

                function u(e, t) {
                    return f && (e = e.replace(/\uFEFF[0-9]/g, function (e) {
                        return N[e]
                    })), t || (e = e.replace(/\\([\'\";:])/g, "$1")), e
                }

                function o(e) {
                    return String.fromCharCode(parseInt(e.slice(1), 16))
                }

                function i(e) {
                    return e.replace(/\\[0-9a-f]+/gi, o)
                }

                function a(e, t, n, r, o, i) {
                    if (o = o || i) return "'" + (o = u(o)).replace(/\'/g, "\\'") + "'";
                    if (t = u(t || n || r), !b.allow_script_urls) {
                        var a = t.replace(/[\s\r\n]+/g, "");
                        if (/(java|vb)script:/i.test(a)) return "";
                        if (!b.allow_svg_data_urls && /^data:image\/svg/i.test(a)) return ""
                    }
                    return v && (t = v.call(y, t, "style")), "url('" + t.replace(/\'/g, "\\'") + "')"
                }

                var c, s, l, f, d, h, m, g, p = {}, v = b.url_converter,
                    y = b.url_converter_scope || this;
                if (e) {
                    for (e = (e = e.replace(/[\u0000-\u001F]/g, "")).replace(/\\[\"\';:\uFEFF]/g, r).replace(/\"[^\"]+\"|\'[^\']+\'/g, function (e) {
                        return e.replace(/[;:]/g, r)
                    }); c = z.exec(e);) if (z.lastIndex = c.index + c[0].length, s = c[1].replace(E, "").toLowerCase(), l = c[2].replace(E, ""), s && l) {
                        if (s = i(s), l = i(l), -1 !== s.indexOf(S) || -1 !== s.indexOf('"')) continue;
                        if (!b.allow_script_urls && ("behavior" === s || /expression\s*\(|\/\*|\*\//.test(l))) continue;
                        "font-weight" === s && "700" === l ? l = "bold" : "color" !== s && "background-color" !== s || (l = l.toLowerCase()), l = (l = l.replace(w, Vr)).replace(x, a), p[s] = f ? u(l, !0) : l
                    }
                    t("border", "", !0), t("border", "-width"), t("border", "-color"), t("border", "-style"), t("padding", ""), t("margin", ""), d = "border", m = "border-style", g = "border-color", n(h = "border-width") && n(m) && n(g) && (p[d] = p[h] + " " + p[m] + " " + p[g], delete p[h], delete p[m], delete p[g]), "medium none" === p.border && delete p.border, "none" === p["border-image"] && delete p["border-image"]
                }
                return p
            }, serialize: function (i, e) {
                function t(e) {
                    var t, n, r, o;
                    if (t = s[e]) for (n = 0, r = t.length; n < r; n++) e = t[n], (o = i[e]) && (c += (0 < c.length ? " " : "") + e + ": " + o + ";")
                }

                var n, r, o, a, u, c = "";
                if (e && s) t("*"), t(e); else for (n in i) !(r = i[n]) || l && (o = n, a = e, u = void 0, (u = l["*"]) && u[o] || (u = l[a]) && u[o]) || (c += (0 < c.length ? " " : "") + n + ": " + r + ";");
                return c
            }
        }
    }, Kr = /^(?:mouse|contextmenu)|click/, Xr = {
        keyLocation: 1,
        layerX: 1,
        layerY: 1,
        returnValue: 1,
        webkitMovementX: 1,
        webkitMovementY: 1,
        keyIdentifier: 1,
        mozPressure: 1
    }, Yr = function () {
        return !1
    }, Gr = function () {
        return !0
    }, Zr = (Jr.prototype.bind = function (e, t, n, r) {
        function o(e) {
            d.executeHandlers(Ur(e || h.event), i)
        }

        var i, a, u, c, s, l, f, d = this, h = j.window;
        if (e && 3 !== e.nodeType && 8 !== e.nodeType) {
            e[d.expando] ? i = e[d.expando] : (i = d.count++, e[d.expando] = i, d.events[i] = {}), r = r || e;
            var m = t.split(" ");
            for (u = m.length; u--;) l = o, s = f = !1, "DOMContentLoaded" === (c = m[u]) && (c = "ready"), d.domLoaded && "ready" === c && "complete" === e.readyState ? n.call(r, Ur({type: c})) : (d.hasMouseEnterLeave || (s = d.mouseEnterLeave[c]) && (l = function (e) {
                var t, n;
                if (t = e.currentTarget, (n = e.relatedTarget) && t.contains) n = t.contains(n); else for (; n && n !== t;) n = n.parentNode;
                n || ((e = Ur(e || h.event)).type = "mouseout" === e.type ? "mouseleave" : "mouseenter", e.target = t, d.executeHandlers(e, i))
            }), d.hasFocusIn || "focusin" !== c && "focusout" !== c || (f = !0, s = "focusin" === c ? "focus" : "blur", l = function (e) {
                (e = Ur(e || h.event)).type = "focus" === e.type ? "focusin" : "focusout", d.executeHandlers(e, i)
            }), (a = d.events[i][c]) ? "ready" === c && d.domLoaded ? n(Ur({type: c})) : a.push({
                func: n,
                scope: r
            }) : (d.events[i][c] = a = [{
                func: n,
                scope: r
            }], a.fakeName = s, a.capture = f, a.nativeHandler = l, "ready" === c ? jr(e, l, d) : Ir(e, s || c, l, f)));
            return e = a = 0, n
        }
    }, Jr.prototype.unbind = function (e, t, n) {
        var r, o, i, a, u, c;
        if (!e || 3 === e.nodeType || 8 === e.nodeType) return this;
        if (r = e[this.expando]) {
            if (c = this.events[r], t) {
                var s = t.split(" ");
                for (i = s.length; i--;) if (o = c[u = s[i]]) {
                    if (n) for (a = o.length; a--;) if (o[a].func === n) {
                        var l = o.nativeHandler, f = o.fakeName, d = o.capture;
                        (o = o.slice(0, a).concat(o.slice(a + 1))).nativeHandler = l, o.fakeName = f, o.capture = d, c[u] = o
                    }
                    n && 0 !== o.length || (delete c[u], Fr(e, o.fakeName || u, o.nativeHandler, o.capture))
                }
            } else {
                for (u in c) o = c[u], Fr(e, o.fakeName || u, o.nativeHandler, o.capture);
                c = {}
            }
            for (u in c) return this;
            delete this.events[r];
            try {
                delete e[this.expando]
            } catch (h) {
                e[this.expando] = null
            }
        }
        return this
    }, Jr.prototype.fire = function (e, t, n) {
        var r;
        if (!e || 3 === e.nodeType || 8 === e.nodeType) return this;
        var o = Ur(null, n);
        for (o.type = t, o.target = e; (r = e[this.expando]) && this.executeHandlers(o, r), (e = e.parentNode || e.ownerDocument || e.defaultView || e.parentWindow) && !o.isPropagationStopped();) ;
        return this
    }, Jr.prototype.clean = function (e) {
        var t, n;
        if (!e || 3 === e.nodeType || 8 === e.nodeType) return this;
        if (e[this.expando] && this.unbind(e), e.getElementsByTagName || (e = e.document), e && e.getElementsByTagName) for (this.unbind(e), t = (n = e.getElementsByTagName("*")).length; t--;) (e = n[t])[this.expando] && this.unbind(e);
        return this
    }, Jr.prototype.destroy = function () {
        this.events = {}
    }, Jr.prototype.cancel = function (e) {
        return e && (e.preventDefault(), e.stopImmediatePropagation()), !1
    }, Jr.prototype.executeHandlers = function (e, t) {
        var n, r, o, i, a = this.events[t];
        if (n = a && a[e.type]) for (r = 0, o = n.length; r < o; r++) if ((i = n[r]) && !1 === i.func.call(i.scope, e) && e.preventDefault(), e.isImmediatePropagationStopped()) return
    }, Jr.Event = new Jr, Jr);

    function Jr() {
        this.domLoaded = !1, this.events = {}, this.count = 1, this.expando = "mce-data-" + (+new Date).toString(32), this.hasMouseEnterLeave = "onmouseenter" in j.document.documentElement, this.hasFocusIn = "onfocusin" in j.document.documentElement, this.count = 1
    }

    function Qr(e, t, n) {
        var r = "0x" + t - 65536;
        return r != r || n ? t : r < 0 ? String.fromCharCode(65536 + r) : String.fromCharCode(r >> 10 | 55296, 1023 & r | 56320)
    }

    var eo, to, no, ro, oo, io, ao, uo, co, so, lo, fo, ho, mo, go, po, vo, yo,
        bo = "sizzle" + -new Date, Co = j.window.document, wo = 0, xo = 0,
        zo = ei(), Eo = ei(), No = ei(), So = function (e, t) {
            return e === t && (lo = !0), 0
        }, ko = typeof undefined, To = {}.hasOwnProperty, Ao = [], Mo = Ao.pop,
        Ro = Ao.push, Do = Ao.push, _o = Ao.slice,
        Oo = Ao.indexOf || function (e) {
            for (var t = 0, n = this.length; t < n; t++) if (this[t] === e) return t;
            return -1
        }, Ho = "[\\x20\\t\\r\\n\\f]", Bo = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
        Po = "\\[" + Ho + "*(" + Bo + ")(?:" + Ho + "*([*^$|!~]?=)" + Ho + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + Bo + "))|)" + Ho + "*\\]",
        Lo = ":(" + Bo + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + Po + ")*)|.*)\\)|)",
        Vo = new RegExp("^" + Ho + "+|((?:^|[^\\\\])(?:\\\\.)*)" + Ho + "+$", "g"),
        Io = new RegExp("^" + Ho + "*," + Ho + "*"),
        Fo = new RegExp("^" + Ho + "*([>+~]|" + Ho + ")" + Ho + "*"),
        Uo = new RegExp("=" + Ho + "*([^\\]'\"]*?)" + Ho + "*\\]", "g"),
        jo = new RegExp(Lo), qo = new RegExp("^" + Bo + "$"), $o = {
            ID: new RegExp("^#(" + Bo + ")"),
            CLASS: new RegExp("^\\.(" + Bo + ")"),
            TAG: new RegExp("^(" + Bo + "|[*])"),
            ATTR: new RegExp("^" + Po),
            PSEUDO: new RegExp("^" + Lo),
            CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + Ho + "*(even|odd|(([+-]|)(\\d*)n|)" + Ho + "*(?:([+-]|)" + Ho + "*(\\d+)|))" + Ho + "*\\)|)", "i"),
            bool: new RegExp("^(?:checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped)$", "i"),
            needsContext: new RegExp("^" + Ho + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + Ho + "*((?:-\\d)?\\d*)" + Ho + "*\\)|)(?=[^-]|$)", "i")
        }, Wo = /^(?:input|select|textarea|button)$/i, Ko = /^h\d$/i,
        Xo = /^[^{]+\{\s*\[native \w/, Yo = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
        Go = /[+~]/, Zo = /'|\\/g,
        Jo = new RegExp("\\\\([\\da-f]{1,6}" + Ho + "?|(" + Ho + ")|.)", "ig");
    try {
        Do.apply(Ao = _o.call(Co.childNodes), Co.childNodes), Ao[Co.childNodes.length].nodeType
    } catch (VN) {
        Do = {
            apply: Ao.length ? function (e, t) {
                Ro.apply(e, _o.call(t))
            } : function (e, t) {
                for (var n = e.length, r = 0; e[n++] = t[r++];) ;
                e.length = n - 1
            }
        }
    }
    var Qo = function (e, t, n, r) {
        var o, i, a, u, c, s, l, f, d, h;
        if ((t ? t.ownerDocument || t : Co) !== ho && fo(t), n = n || [], !e || "string" != typeof e) return n;
        if (1 !== (u = (t = t || ho).nodeType) && 9 !== u) return [];
        if (go && !r) {
            if (o = Yo.exec(e)) if (a = o[1]) {
                if (9 === u) {
                    if (!(i = t.getElementById(a)) || !i.parentNode) return n;
                    if (i.id === a) return n.push(i), n
                } else if (t.ownerDocument && (i = t.ownerDocument.getElementById(a)) && yo(t, i) && i.id === a) return n.push(i), n
            } else {
                if (o[2]) return Do.apply(n, t.getElementsByTagName(e)), n;
                if ((a = o[3]) && to.getElementsByClassName) return Do.apply(n, t.getElementsByClassName(a)), n
            }
            if (to.qsa && (!po || !po.test(e))) {
                if (f = l = bo, d = t, h = 9 === u && e, 1 === u && "object" !== t.nodeName.toLowerCase()) {
                    for (s = io(e), (l = t.getAttribute("id")) ? f = l.replace(Zo, "\\$&") : t.setAttribute("id", f), f = "[id='" + f + "'] ", c = s.length; c--;) s[c] = f + ci(s[c]);
                    d = Go.test(e) && ai(t.parentNode) || t, h = s.join(",")
                }
                if (h) try {
                    return Do.apply(n, d.querySelectorAll(h)), n
                } catch (m) {
                } finally {
                    l || t.removeAttribute("id")
                }
            }
        }
        return uo(e.replace(Vo, "$1"), t, n, r)
    };

    function ei() {
        var n = [];
        return function r(e, t) {
            return n.push(e + " ") > no.cacheLength && delete r[n.shift()], r[e + " "] = t
        }
    }

    function ti(e) {
        return e[bo] = !0, e
    }

    function ni(e, t) {
        var n = t && e,
            r = n && 1 === e.nodeType && 1 === t.nodeType && (~t.sourceIndex || 1 << 31) - (~e.sourceIndex || 1 << 31);
        if (r) return r;
        if (n) for (; n = n.nextSibling;) if (n === t) return -1;
        return e ? 1 : -1
    }

    function ri(t) {
        return function (e) {
            return "input" === e.nodeName.toLowerCase() && e.type === t
        }
    }

    function oi(n) {
        return function (e) {
            var t = e.nodeName.toLowerCase();
            return ("input" === t || "button" === t) && e.type === n
        }
    }

    function ii(a) {
        return ti(function (i) {
            return i = +i, ti(function (e, t) {
                for (var n, r = a([], e.length, i), o = r.length; o--;) e[n = r[o]] && (e[n] = !(t[n] = e[n]))
            })
        })
    }

    function ai(e) {
        return e && typeof e.getElementsByTagName != ko && e
    }

    for (eo in to = Qo.support = {}, oo = Qo.isXML = function (e) {
        var t = e && (e.ownerDocument || e).documentElement;
        return !!t && "HTML" !== t.nodeName
    }, fo = Qo.setDocument = function (e) {
        var t, c = e ? e.ownerDocument || e : Co, n = c.defaultView;
        return c !== ho && 9 === c.nodeType && c.documentElement ? (mo = (ho = c).documentElement, go = !oo(c), n && n !== function r(e) {
            try {
                return e.top
            } catch (t) {
            }
            return null
        }(n) && (n.addEventListener ? n.addEventListener("unload", function () {
            fo()
        }, !1) : n.attachEvent && n.attachEvent("onunload", function () {
            fo()
        })), to.attributes = !0, to.getElementsByTagName = !0, to.getElementsByClassName = Xo.test(c.getElementsByClassName), to.getById = !0, no.find.ID = function (e, t) {
            if (typeof t.getElementById != ko && go) {
                var n = t.getElementById(e);
                return n && n.parentNode ? [n] : []
            }
        }, no.filter.ID = function (e) {
            var t = e.replace(Jo, Qr);
            return function (e) {
                return e.getAttribute("id") === t
            }
        }, no.find.TAG = to.getElementsByTagName ? function (e, t) {
            if (typeof t.getElementsByTagName != ko) return t.getElementsByTagName(e)
        } : function (e, t) {
            var n, r = [], o = 0, i = t.getElementsByTagName(e);
            if ("*" !== e) return i;
            for (; n = i[o++];) 1 === n.nodeType && r.push(n);
            return r
        }, no.find.CLASS = to.getElementsByClassName && function (e, t) {
            if (go) return t.getElementsByClassName(e)
        }, vo = [], po = [], to.disconnectedMatch = !0, po = po.length && new RegExp(po.join("|")), vo = vo.length && new RegExp(vo.join("|")), t = Xo.test(mo.compareDocumentPosition), yo = t || Xo.test(mo.contains) ? function (e, t) {
            var n = 9 === e.nodeType ? e.documentElement : e,
                r = t && t.parentNode;
            return e === r || !(!r || 1 !== r.nodeType || !(n.contains ? n.contains(r) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(r)))
        } : function (e, t) {
            if (t) for (; t = t.parentNode;) if (t === e) return !0;
            return !1
        }, So = t ? function (e, t) {
            if (e === t) return lo = !0, 0;
            var n = !e.compareDocumentPosition - !t.compareDocumentPosition;
            return n || (1 & (n = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1) || !to.sortDetached && t.compareDocumentPosition(e) === n ? e === c || e.ownerDocument === Co && yo(Co, e) ? -1 : t === c || t.ownerDocument === Co && yo(Co, t) ? 1 : so ? Oo.call(so, e) - Oo.call(so, t) : 0 : 4 & n ? -1 : 1)
        } : function (e, t) {
            if (e === t) return lo = !0, 0;
            var n, r = 0, o = e.parentNode, i = t.parentNode, a = [e], u = [t];
            if (!o || !i) return e === c ? -1 : t === c ? 1 : o ? -1 : i ? 1 : so ? Oo.call(so, e) - Oo.call(so, t) : 0;
            if (o === i) return ni(e, t);
            for (n = e; n = n.parentNode;) a.unshift(n);
            for (n = t; n = n.parentNode;) u.unshift(n);
            for (; a[r] === u[r];) r++;
            return r ? ni(a[r], u[r]) : a[r] === Co ? -1 : u[r] === Co ? 1 : 0
        }, c) : ho
    }, Qo.matches = function (e, t) {
        return Qo(e, null, null, t)
    }, Qo.matchesSelector = function (e, t) {
        if ((e.ownerDocument || e) !== ho && fo(e), t = t.replace(Uo, "='$1']"), to.matchesSelector && go && (!vo || !vo.test(t)) && (!po || !po.test(t))) try {
            var n = (void 0).call(e, t);
            if (n || to.disconnectedMatch || e.document && 11 !== e.document.nodeType) return n
        } catch (VN) {
        }
        return 0 < Qo(t, ho, null, [e]).length
    }, Qo.contains = function (e, t) {
        return (e.ownerDocument || e) !== ho && fo(e), yo(e, t)
    }, Qo.attr = function (e, t) {
        (e.ownerDocument || e) !== ho && fo(e);
        var n = no.attrHandle[t.toLowerCase()],
            r = n && To.call(no.attrHandle, t.toLowerCase()) ? n(e, t, !go) : undefined;
        return r !== undefined ? r : to.attributes || !go ? e.getAttribute(t) : (r = e.getAttributeNode(t)) && r.specified ? r.value : null
    }, Qo.error = function (e) {
        throw new Error("Syntax error, unrecognized expression: " + e)
    }, Qo.uniqueSort = function (e) {
        var t, n = [], r = 0, o = 0;
        if (lo = !to.detectDuplicates, so = !to.sortStable && e.slice(0), e.sort(So), lo) {
            for (; t = e[o++];) t === e[o] && (r = n.push(o));
            for (; r--;) e.splice(n[r], 1)
        }
        return so = null, e
    }, ro = Qo.getText = function (e) {
        var t, n = "", r = 0, o = e.nodeType;
        if (o) {
            if (1 === o || 9 === o || 11 === o) {
                if ("string" == typeof e.textContent) return e.textContent;
                for (e = e.firstChild; e; e = e.nextSibling) n += ro(e)
            } else if (3 === o || 4 === o) return e.nodeValue
        } else for (; t = e[r++];) n += ro(t);
        return n
    }, (no = Qo.selectors = {
        cacheLength: 50,
        createPseudo: ti,
        match: $o,
        attrHandle: {},
        find: {},
        relative: {
            ">": {dir: "parentNode", first: !0},
            " ": {dir: "parentNode"},
            "+": {dir: "previousSibling", first: !0},
            "~": {dir: "previousSibling"}
        },
        preFilter: {
            ATTR: function (e) {
                return e[1] = e[1].replace(Jo, Qr), e[3] = (e[3] || e[4] || e[5] || "").replace(Jo, Qr), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
            }, CHILD: function (e) {
                return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || Qo.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && Qo.error(e[0]), e
            }, PSEUDO: function (e) {
                var t, n = !e[6] && e[2];
                return $o.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && jo.test(n) && (t = io(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3))
            }
        },
        filter: {
            TAG: function (e) {
                var t = e.replace(Jo, Qr).toLowerCase();
                return "*" === e ? function () {
                    return !0
                } : function (e) {
                    return e.nodeName && e.nodeName.toLowerCase() === t
                }
            }, CLASS: function (e) {
                var t = zo[e + " "];
                return t || (t = new RegExp("(^|" + Ho + ")" + e + "(" + Ho + "|$)")) && zo(e, function (e) {
                    return t.test("string" == typeof e.className && e.className || typeof e.getAttribute != ko && e.getAttribute("class") || "")
                })
            }, ATTR: function (n, r, o) {
                return function (e) {
                    var t = Qo.attr(e, n);
                    return null == t ? "!=" === r : !r || (t += "", "=" === r ? t === o : "!=" === r ? t !== o : "^=" === r ? o && 0 === t.indexOf(o) : "*=" === r ? o && -1 < t.indexOf(o) : "$=" === r ? o && t.slice(-o.length) === o : "~=" === r ? -1 < (" " + t + " ").indexOf(o) : "|=" === r && (t === o || t.slice(0, o.length + 1) === o + "-"))
                }
            }, CHILD: function (h, e, t, m, g) {
                var p = "nth" !== h.slice(0, 3), v = "last" !== h.slice(-4),
                    y = "of-type" === e;
                return 1 === m && 0 === g ? function (e) {
                    return !!e.parentNode
                } : function (e, t, n) {
                    var r, o, i, a, u, c,
                        s = p != v ? "nextSibling" : "previousSibling",
                        l = e.parentNode, f = y && e.nodeName.toLowerCase(),
                        d = !n && !y;
                    if (l) {
                        if (p) {
                            for (; s;) {
                                for (i = e; i = i[s];) if (y ? i.nodeName.toLowerCase() === f : 1 === i.nodeType) return !1;
                                c = s = "only" === h && !c && "nextSibling"
                            }
                            return !0
                        }
                        if (c = [v ? l.firstChild : l.lastChild], v && d) {
                            for (u = (r = (o = l[bo] || (l[bo] = {}))[h] || [])[0] === wo && r[1], a = r[0] === wo && r[2], i = u && l.childNodes[u]; i = ++u && i && i[s] || (a = u = 0) || c.pop();) if (1 === i.nodeType && ++a && i === e) {
                                o[h] = [wo, u, a];
                                break
                            }
                        } else if (d && (r = (e[bo] || (e[bo] = {}))[h]) && r[0] === wo) a = r[1]; else for (; (i = ++u && i && i[s] || (a = u = 0) || c.pop()) && ((y ? i.nodeName.toLowerCase() !== f : 1 !== i.nodeType) || !++a || (d && ((i[bo] || (i[bo] = {}))[h] = [wo, a]), i !== e));) ;
                        return (a -= g) === m || a % m == 0 && 0 <= a / m
                    }
                }
            }, PSEUDO: function (e, i) {
                var t,
                    a = no.pseudos[e] || no.setFilters[e.toLowerCase()] || Qo.error("unsupported pseudo: " + e);
                return a[bo] ? a(i) : 1 < a.length ? (t = [e, e, "", i], no.setFilters.hasOwnProperty(e.toLowerCase()) ? ti(function (e, t) {
                    for (var n, r = a(e, i), o = r.length; o--;) e[n = Oo.call(e, r[o])] = !(t[n] = r[o])
                }) : function (e) {
                    return a(e, 0, t)
                }) : a
            }
        },
        pseudos: {
            not: ti(function (e) {
                var r = [], o = [], u = ao(e.replace(Vo, "$1"));
                return u[bo] ? ti(function (e, t, n, r) {
                    for (var o, i = u(e, null, r, []), a = e.length; a--;) (o = i[a]) && (e[a] = !(t[a] = o))
                }) : function (e, t, n) {
                    return r[0] = e, u(r, null, n, o), !o.pop()
                }
            }), has: ti(function (t) {
                return function (e) {
                    return 0 < Qo(t, e).length
                }
            }), contains: ti(function (t) {
                return t = t.replace(Jo, Qr), function (e) {
                    return -1 < (e.textContent || e.innerText || ro(e)).indexOf(t)
                }
            }), lang: ti(function (n) {
                return qo.test(n || "") || Qo.error("unsupported lang: " + n), n = n.replace(Jo, Qr).toLowerCase(), function (e) {
                    var t;
                    do {
                        if (t = go ? e.lang : e.getAttribute("xml:lang") || e.getAttribute("lang")) return (t = t.toLowerCase()) === n || 0 === t.indexOf(n + "-")
                    } while ((e = e.parentNode) && 1 === e.nodeType);
                    return !1
                }
            }), target: function (e) {
                var t = j.window.location && j.window.location.hash;
                return t && t.slice(1) === e.id
            }, root: function (e) {
                return e === mo
            }, focus: function (e) {
                return e === ho.activeElement && (!ho.hasFocus || ho.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
            }, enabled: function (e) {
                return !1 === e.disabled
            }, disabled: function (e) {
                return !0 === e.disabled
            }, checked: function (e) {
                var t = e.nodeName.toLowerCase();
                return "input" === t && !!e.checked || "option" === t && !!e.selected
            }, selected: function (e) {
                return e.parentNode && e.parentNode.selectedIndex, !0 === e.selected
            }, empty: function (e) {
                for (e = e.firstChild; e; e = e.nextSibling) if (e.nodeType < 6) return !1;
                return !0
            }, parent: function (e) {
                return !no.pseudos.empty(e)
            }, header: function (e) {
                return Ko.test(e.nodeName)
            }, input: function (e) {
                return Wo.test(e.nodeName)
            }, button: function (e) {
                var t = e.nodeName.toLowerCase();
                return "input" === t && "button" === e.type || "button" === t
            }, text: function (e) {
                var t;
                return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
            }, first: ii(function () {
                return [0]
            }), last: ii(function (e, t) {
                return [t - 1]
            }), eq: ii(function (e, t, n) {
                return [n < 0 ? n + t : n]
            }), even: ii(function (e, t) {
                for (var n = 0; n < t; n += 2) e.push(n);
                return e
            }), odd: ii(function (e, t) {
                for (var n = 1; n < t; n += 2) e.push(n);
                return e
            }), lt: ii(function (e, t, n) {
                for (var r = n < 0 ? n + t : n; 0 <= --r;) e.push(r);
                return e
            }), gt: ii(function (e, t, n) {
                for (var r = n < 0 ? n + t : n; ++r < t;) e.push(r);
                return e
            })
        }
    }).pseudos.nth = no.pseudos.eq, {
        radio: !0,
        checkbox: !0,
        file: !0,
        password: !0,
        image: !0
    }) no.pseudos[eo] = ri(eo);
    for (eo in {submit: !0, reset: !0}) no.pseudos[eo] = oi(eo);

    function ui() {
    }

    function ci(e) {
        for (var t = 0, n = e.length, r = ""; t < n; t++) r += e[t].value;
        return r
    }

    function si(a, e, t) {
        var u = e.dir, c = t && "parentNode" === u, s = xo++;
        return e.first ? function (e, t, n) {
            for (; e = e[u];) if (1 === e.nodeType || c) return a(e, t, n)
        } : function (e, t, n) {
            var r, o, i = [wo, s];
            if (n) {
                for (; e = e[u];) if ((1 === e.nodeType || c) && a(e, t, n)) return !0
            } else for (; e = e[u];) if (1 === e.nodeType || c) {
                if ((r = (o = e[bo] || (e[bo] = {}))[u]) && r[0] === wo && r[1] === s) return i[2] = r[2];
                if ((o[u] = i)[2] = a(e, t, n)) return !0
            }
        }
    }

    function li(o) {
        return 1 < o.length ? function (e, t, n) {
            for (var r = o.length; r--;) if (!o[r](e, t, n)) return !1;
            return !0
        } : o[0]
    }

    function fi(e, t, n, r, o) {
        for (var i, a = [], u = 0, c = e.length, s = null != t; u < c; u++) (i = e[u]) && (n && !n(i, r, o) || (a.push(i), s && t.push(u)));
        return a
    }

    function di(m, g, p, v, y, e) {
        return v && !v[bo] && (v = di(v)), y && !y[bo] && (y = di(y, e)), ti(function (e, t, n, r) {
            var o, i, a, u = [], c = [], s = t.length,
                l = e || function h(e, t, n) {
                    for (var r = 0, o = t.length; r < o; r++) Qo(e, t[r], n);
                    return n
                }(g || "*", n.nodeType ? [n] : n, []),
                f = !m || !e && g ? l : fi(l, u, m, n, r),
                d = p ? y || (e ? m : s || v) ? [] : t : f;
            if (p && p(f, d, n, r), v) for (o = fi(d, c), v(o, [], n, r), i = o.length; i--;) (a = o[i]) && (d[c[i]] = !(f[c[i]] = a));
            if (e) {
                if (y || m) {
                    if (y) {
                        for (o = [], i = d.length; i--;) (a = d[i]) && o.push(f[i] = a);
                        y(null, d = [], o, r)
                    }
                    for (i = d.length; i--;) (a = d[i]) && -1 < (o = y ? Oo.call(e, a) : u[i]) && (e[o] = !(t[o] = a))
                }
            } else d = fi(d === t ? d.splice(s, d.length) : d), y ? y(null, t, d, r) : Do.apply(t, d)
        })
    }

    function hi(e) {
        for (var r, t, n, o = e.length, i = no.relative[e[0].type], a = i || no.relative[" "], u = i ? 1 : 0, c = si(function (e) {
            return e === r
        }, a, !0), s = si(function (e) {
            return -1 < Oo.call(r, e)
        }, a, !0), l = [function (e, t, n) {
            return !i && (n || t !== co) || ((r = t).nodeType ? c(e, t, n) : s(e, t, n))
        }]; u < o; u++) if (t = no.relative[e[u].type]) l = [si(li(l), t)]; else {
            if ((t = no.filter[e[u].type].apply(null, e[u].matches))[bo]) {
                for (n = ++u; n < o && !no.relative[e[n].type]; n++) ;
                return di(1 < u && li(l), 1 < u && ci(e.slice(0, u - 1).concat({value: " " === e[u - 2].type ? "*" : ""})).replace(Vo, "$1"), t, u < n && hi(e.slice(u, n)), n < o && hi(e = e.slice(n)), n < o && ci(e))
            }
            l.push(t)
        }
        return li(l)
    }

    ui.prototype = no.filters = no.pseudos, no.setFilters = new ui, io = Qo.tokenize = function (e, t) {
        var n, r, o, i, a, u, c, s = Eo[e + " "];
        if (s) return t ? 0 : s.slice(0);
        for (a = e, u = [], c = no.preFilter; a;) {
            for (i in n && !(r = Io.exec(a)) || (r && (a = a.slice(r[0].length) || a), u.push(o = [])), n = !1, (r = Fo.exec(a)) && (n = r.shift(), o.push({
                value: n,
                type: r[0].replace(Vo, " ")
            }), a = a.slice(n.length)), no.filter) no.filter.hasOwnProperty(i) && (!(r = $o[i].exec(a)) || c[i] && !(r = c[i](r)) || (n = r.shift(), o.push({
                value: n,
                type: i,
                matches: r
            }), a = a.slice(n.length)));
            if (!n) break
        }
        return t ? a.length : a ? Qo.error(e) : Eo(e, u).slice(0)
    }, ao = Qo.compile = function (e, t) {
        var n, r = [], o = [], i = No[e + " "];
        if (!i) {
            for (n = (t = t || io(e)).length; n--;) (i = hi(t[n]))[bo] ? r.push(i) : o.push(i);
            (i = No(e, function a(p, v) {
                function e(e, t, n, r, o) {
                    var i, a, u, c = 0, s = "0", l = e && [], f = [], d = co,
                        h = e || b && no.find.TAG("*", o),
                        m = wo += null == d ? 1 : Math.random() || .1,
                        g = h.length;
                    for (o && (co = t !== ho && t); s !== g && null != (i = h[s]); s++) {
                        if (b && i) {
                            for (a = 0; u = p[a++];) if (u(i, t, n)) {
                                r.push(i);
                                break
                            }
                            o && (wo = m)
                        }
                        y && ((i = !u && i) && c--, e && l.push(i))
                    }
                    if (c += s, y && s !== c) {
                        for (a = 0; u = v[a++];) u(l, f, t, n);
                        if (e) {
                            if (0 < c) for (; s--;) l[s] || f[s] || (f[s] = Mo.call(r));
                            f = fi(f)
                        }
                        Do.apply(r, f), o && !e && 0 < f.length && 1 < c + v.length && Qo.uniqueSort(r)
                    }
                    return o && (wo = m, co = d), l
                }

                var y = 0 < v.length, b = 0 < p.length;
                return y ? ti(e) : e
            }(o, r))).selector = e
        }
        return i
    }, uo = Qo.select = function (e, t, n, r) {
        var o, i, a, u, c, s = "function" == typeof e && e,
            l = !r && io(e = s.selector || e);
        if (n = n || [], 1 === l.length) {
            if (2 < (i = l[0] = l[0].slice(0)).length && "ID" === (a = i[0]).type && to.getById && 9 === t.nodeType && go && no.relative[i[1].type]) {
                if (!(t = (no.find.ID(a.matches[0].replace(Jo, Qr), t) || [])[0])) return n;
                s && (t = t.parentNode), e = e.slice(i.shift().value.length)
            }
            for (o = $o.needsContext.test(e) ? 0 : i.length; o-- && (a = i[o], !no.relative[u = a.type]);) if ((c = no.find[u]) && (r = c(a.matches[0].replace(Jo, Qr), Go.test(i[0].type) && ai(t.parentNode) || t))) {
                if (i.splice(o, 1), !(e = r.length && ci(i))) return Do.apply(n, r), n;
                break
            }
        }
        return (s || ao(e, l))(r, t, !go, n, Go.test(e) && ai(t.parentNode) || t), n
    }, to.sortStable = bo.split("").sort(So).join("") === bo, to.detectDuplicates = !!lo, fo(), to.sortDetached = !0;

    function mi(e) {
        return void 0 !== e
    }

    function gi(e) {
        return "string" == typeof e
    }

    function pi(e, t) {
        var n, r, o;
        for (o = (t = t || zi).createElement("div"), n = t.createDocumentFragment(), o.innerHTML = e; r = o.firstChild;) n.appendChild(r);
        return n
    }

    function vi(e, t) {
        return e && t && -1 !== (" " + e.className + " ").indexOf(" " + t + " ")
    }

    function yi(e, t, n) {
        var r, o;
        return t = Fi(t)[0], e.each(function () {
            n && r === this.parentNode || (r = this.parentNode, o = t.cloneNode(!1), this.parentNode.insertBefore(o, this)), o.appendChild(this)
        }), e
    }

    function bi(e, t) {
        return new Fi.fn.init(e, t)
    }

    function Ci(e) {
        return null === e || e === undefined ? "" : ("" + e).replace(Bi, "")
    }

    function wi(e, t) {
        var n, r, o, i;
        if (e) if ((n = e.length) === undefined) {
            for (r in e) if (e.hasOwnProperty(r) && (i = e[r], !1 === t.call(i, r, i))) break
        } else for (o = 0; o < n && (i = e[o], !1 !== t.call(i, o, i)); o++) ;
        return e
    }

    function xi(e, n) {
        var r = [];
        return wi(e, function (e, t) {
            n(t, e) && r.push(t)
        }), r
    }

    var zi = j.document, Ei = Array.prototype.push, Ni = Array.prototype.slice,
        Si = /^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/, ki = Zr.Event,
        Ti = Jn.makeMap("children,contents,next,prev"),
        Ai = function (e, t, n, r) {
            var o;
            if (gi(t)) t = pi(t, Pi(e[0])); else if (t.length && !t.nodeType) {
                if (t = Fi.makeArray(t), r) for (o = t.length - 1; 0 <= o; o--) Ai(e, t[o], n, r); else for (o = 0; o < t.length; o++) Ai(e, t[o], n, r);
                return e
            }
            if (t.nodeType) for (o = e.length; o--;) n.call(e[o], t);
            return e
        },
        Mi = Jn.makeMap("fillOpacity fontWeight lineHeight opacity orphans widows zIndex zoom", " "),
        Ri = Jn.makeMap("checked compact declare defer disabled ismap multiple nohref noshade nowrap readonly selected", " "),
        Di = {"for": "htmlFor", "class": "className", readonly: "readOnly"},
        _i = {"float": "cssFloat"}, Oi = {}, Hi = {}, Bi = /^\s*|\s*$/g,
        Pi = function (e) {
            return e ? 9 === e.nodeType ? e : e.ownerDocument : zi
        };
    bi.fn = bi.prototype = {
        constructor: bi,
        selector: "",
        context: null,
        length: 0,
        init: function (e, t) {
            var n, r, o = this;
            if (!e) return o;
            if (e.nodeType) return o.context = o[0] = e, o.length = 1, o;
            if (t && t.nodeType) o.context = t; else {
                if (t) return Fi(e).attr(t);
                o.context = t = j.document
            }
            if (gi(e)) {
                if (!(n = "<" === (o.selector = e).charAt(0) && ">" === e.charAt(e.length - 1) && 3 <= e.length ? [null, e, null] : Si.exec(e))) return Fi(t).find(e);
                if (n[1]) for (r = pi(e, Pi(t)).firstChild; r;) Ei.call(o, r), r = r.nextSibling; else {
                    if (!(r = Pi(t).getElementById(n[2]))) return o;
                    if (r.id !== n[2]) return o.find(e);
                    o.length = 1, o[0] = r
                }
            } else this.add(e, !1);
            return o
        },
        toArray: function () {
            return Jn.toArray(this)
        },
        add: function (e, t) {
            var n, r;
            if (gi(e)) return this.add(Fi(e));
            if (!1 !== t) for (n = Fi.unique(this.toArray().concat(Fi.makeArray(e))), this.length = n.length, r = 0; r < n.length; r++) this[r] = n[r]; else Ei.apply(this, Fi.makeArray(e));
            return this
        },
        attr: function (t, n) {
            var e, r = this;
            if ("object" == typeof t) wi(t, function (e, t) {
                r.attr(e, t)
            }); else {
                if (!mi(n)) {
                    if (r[0] && 1 === r[0].nodeType) {
                        if ((e = Oi[t]) && e.get) return e.get(r[0], t);
                        if (Ri[t]) return r.prop(t) ? t : undefined;
                        null === (n = r[0].getAttribute(t, 2)) && (n = undefined)
                    }
                    return n
                }
                this.each(function () {
                    var e;
                    if (1 === this.nodeType) {
                        if ((e = Oi[t]) && e.set) return void e.set(this, n);
                        null === n ? this.removeAttribute(t, 2) : this.setAttribute(t, n, 2)
                    }
                })
            }
            return r
        },
        removeAttr: function (e) {
            return this.attr(e, null)
        },
        prop: function (e, t) {
            var n = this;
            if ("object" == typeof (e = Di[e] || e)) wi(e, function (e, t) {
                n.prop(e, t)
            }); else {
                if (!mi(t)) return n[0] && n[0].nodeType && e in n[0] ? n[0][e] : t;
                this.each(function () {
                    1 === this.nodeType && (this[e] = t)
                })
            }
            return n
        },
        css: function (n, r) {
            function e(e) {
                return e.replace(/-(\D)/g, function (e, t) {
                    return t.toUpperCase()
                })
            }

            function o(e) {
                return e.replace(/[A-Z]/g, function (e) {
                    return "-" + e
                })
            }

            var t, i, a = this;
            if ("object" == typeof n) wi(n, function (e, t) {
                a.css(e, t)
            }); else if (mi(r)) n = e(n), "number" != typeof r || Mi[n] || (r = r.toString() + "px"), a.each(function () {
                var e = this.style;
                if ((i = Hi[n]) && i.set) i.set(this, r); else {
                    try {
                        this.style[_i[n] || n] = r
                    } catch (t) {
                    }
                    null !== r && "" !== r || (e.removeProperty ? e.removeProperty(o(n)) : e.removeAttribute(n))
                }
            }); else {
                if (t = a[0], (i = Hi[n]) && i.get) return i.get(t);
                if (!t.ownerDocument.defaultView) return t.currentStyle ? t.currentStyle[e(n)] : "";
                try {
                    return t.ownerDocument.defaultView.getComputedStyle(t, null).getPropertyValue(o(n))
                } catch (u) {
                    return undefined
                }
            }
            return a
        },
        remove: function () {
            for (var e, t = this.length; t--;) e = this[t], ki.clean(e), e.parentNode && e.parentNode.removeChild(e);
            return this
        },
        empty: function () {
            for (var e, t = this.length; t--;) for (e = this[t]; e.firstChild;) e.removeChild(e.firstChild);
            return this
        },
        html: function (e) {
            var t, n = this;
            if (mi(e)) {
                t = n.length;
                try {
                    for (; t--;) n[t].innerHTML = e
                } catch (r) {
                    Fi(n[t]).empty().append(e)
                }
                return n
            }
            return n[0] ? n[0].innerHTML : ""
        },
        text: function (e) {
            var t;
            if (mi(e)) {
                for (t = this.length; t--;) "innerText" in this[t] ? this[t].innerText = e : this[0].textContent = e;
                return this
            }
            return this[0] ? this[0].innerText || this[0].textContent : ""
        },
        append: function () {
            return Ai(this, arguments, function (e) {
                (1 === this.nodeType || this.host && 1 === this.host.nodeType) && this.appendChild(e)
            })
        },
        prepend: function () {
            return Ai(this, arguments, function (e) {
                (1 === this.nodeType || this.host && 1 === this.host.nodeType) && this.insertBefore(e, this.firstChild)
            }, !0)
        },
        before: function () {
            return this[0] && this[0].parentNode ? Ai(this, arguments, function (e) {
                this.parentNode.insertBefore(e, this)
            }) : this
        },
        after: function () {
            return this[0] && this[0].parentNode ? Ai(this, arguments, function (e) {
                this.parentNode.insertBefore(e, this.nextSibling)
            }, !0) : this
        },
        appendTo: function (e) {
            return Fi(e).append(this), this
        },
        prependTo: function (e) {
            return Fi(e).prepend(this), this
        },
        replaceWith: function (e) {
            return this.before(e).remove()
        },
        wrap: function (e) {
            return yi(this, e)
        },
        wrapAll: function (e) {
            return yi(this, e, !0)
        },
        wrapInner: function (e) {
            return this.each(function () {
                Fi(this).contents().wrapAll(e)
            }), this
        },
        unwrap: function () {
            return this.parent().each(function () {
                Fi(this).replaceWith(this.childNodes)
            })
        },
        clone: function () {
            var e = [];
            return this.each(function () {
                e.push(this.cloneNode(!0))
            }), Fi(e)
        },
        addClass: function (e) {
            return this.toggleClass(e, !0)
        },
        removeClass: function (e) {
            return this.toggleClass(e, !1)
        },
        toggleClass: function (o, i) {
            var e = this;
            return "string" != typeof o || (-1 !== o.indexOf(" ") ? wi(o.split(" "), function () {
                e.toggleClass(this, i)
            }) : e.each(function (e, t) {
                var n, r;
                (r = vi(t, o)) !== i && (n = t.className, r ? t.className = Ci((" " + n + " ").replace(" " + o + " ", " ")) : t.className += n ? " " + o : o)
            })), e
        },
        hasClass: function (e) {
            return vi(this[0], e)
        },
        each: function (e) {
            return wi(this, e)
        },
        on: function (e, t) {
            return this.each(function () {
                ki.bind(this, e, t)
            })
        },
        off: function (e, t) {
            return this.each(function () {
                ki.unbind(this, e, t)
            })
        },
        trigger: function (e) {
            return this.each(function () {
                "object" == typeof e ? ki.fire(this, e.type, e) : ki.fire(this, e)
            })
        },
        show: function () {
            return this.css("display", "")
        },
        hide: function () {
            return this.css("display", "none")
        },
        slice: function () {
            return new Fi(Ni.apply(this, arguments))
        },
        eq: function (e) {
            return -1 === e ? this.slice(e) : this.slice(e, +e + 1)
        },
        first: function () {
            return this.eq(0)
        },
        last: function () {
            return this.eq(-1)
        },
        find: function (e) {
            var t, n, r = [];
            for (t = 0, n = this.length; t < n; t++) Fi.find(e, this[t], r);
            return Fi(r)
        },
        filter: function (n) {
            return Fi("function" == typeof n ? xi(this.toArray(), function (e, t) {
                return n(t, e)
            }) : Fi.filter(n, this.toArray()))
        },
        closest: function (n) {
            var r = [];
            return n instanceof Fi && (n = n[0]), this.each(function (e, t) {
                for (; t;) {
                    if ("string" == typeof n && Fi(t).is(n)) {
                        r.push(t);
                        break
                    }
                    if (t === n) {
                        r.push(t);
                        break
                    }
                    t = t.parentNode
                }
            }), Fi(r)
        },
        offset: function (e) {
            var t, n, r, o, i = 0, a = 0;
            return e ? this.css(e) : ((t = this[0]) && (r = (n = t.ownerDocument).documentElement, t.getBoundingClientRect && (i = (o = t.getBoundingClientRect()).left + (r.scrollLeft || n.body.scrollLeft) - r.clientLeft, a = o.top + (r.scrollTop || n.body.scrollTop) - r.clientTop)), {
                left: i,
                top: a
            })
        },
        push: Ei,
        sort: Array.prototype.sort,
        splice: Array.prototype.splice
    }, Jn.extend(bi, {
        extend: Jn.extend,
        makeArray: function (e) {
            return function (e) {
                return e && e === e.window
            }(e) || e.nodeType ? [e] : Jn.toArray(e)
        },
        inArray: function (e, t) {
            var n;
            if (t.indexOf) return t.indexOf(e);
            for (n = t.length; n--;) if (t[n] === e) return n;
            return -1
        },
        isArray: Jn.isArray,
        each: wi,
        trim: Ci,
        grep: xi,
        find: Qo,
        expr: Qo.selectors,
        unique: Qo.uniqueSort,
        text: Qo.getText,
        contains: Qo.contains,
        filter: function (e, t, n) {
            var r = t.length;
            for (n && (e = ":not(" + e + ")"); r--;) 1 !== t[r].nodeType && t.splice(r, 1);
            return t = 1 === t.length ? Fi.find.matchesSelector(t[0], e) ? [t[0]] : [] : Fi.find.matches(e, t)
        }
    });

    function Li(e, t, n) {
        var r = [], o = e[t];
        for ("string" != typeof n && n instanceof Fi && (n = n[0]); o && 9 !== o.nodeType;) {
            if (n !== undefined) {
                if (o === n) break;
                if ("string" == typeof n && Fi(o).is(n)) break
            }
            1 === o.nodeType && r.push(o), o = o[t]
        }
        return r
    }

    function Vi(e, t, n, r) {
        var o = [];
        for (r instanceof Fi && (r = r[0]); e; e = e[t]) if (!n || e.nodeType === n) {
            if (r !== undefined) {
                if (e === r) break;
                if ("string" == typeof r && Fi(e).is(r)) break
            }
            o.push(e)
        }
        return o
    }

    function Ii(e, t, n) {
        for (e = e[t]; e; e = e[t]) if (e.nodeType === n) return e;
        return null
    }

    wi({
        parent: function (e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null
        }, parents: function (e) {
            return Li(e, "parentNode")
        }, next: function (e) {
            return Ii(e, "nextSibling", 1)
        }, prev: function (e) {
            return Ii(e, "previousSibling", 1)
        }, children: function (e) {
            return Vi(e.firstChild, "nextSibling", 1)
        }, contents: function (e) {
            return Jn.toArray(("iframe" === e.nodeName ? e.contentDocument || e.contentWindow.document : e).childNodes)
        }
    }, function (r, o) {
        bi.fn[r] = function (t) {
            var n = [];
            this.each(function () {
                var e = o.call(n, this, t, n);
                e && (Fi.isArray(e) ? n.push.apply(n, e) : n.push(e))
            }), 1 < this.length && (Ti[r] || (n = Fi.unique(n)), 0 === r.indexOf("parents") && (n = n.reverse()));
            var e = Fi(n);
            return t ? e.filter(t) : e
        }
    }), wi({
        parentsUntil: function (e, t) {
            return Li(e, "parentNode", t)
        }, nextUntil: function (e, t) {
            return Vi(e, "nextSibling", 1, t).slice(1)
        }, prevUntil: function (e, t) {
            return Vi(e, "previousSibling", 1, t).slice(1)
        }
    }, function (o, i) {
        bi.fn[o] = function (t, e) {
            var n = [];
            this.each(function () {
                var e = i.call(n, this, t, n);
                e && (Fi.isArray(e) ? n.push.apply(n, e) : n.push(e))
            }), 1 < this.length && (n = Fi.unique(n), 0 !== o.indexOf("parents") && "prevUntil" !== o || (n = n.reverse()));
            var r = Fi(n);
            return e ? r.filter(e) : r
        }
    }), bi.fn.is = function (e) {
        return !!e && 0 < this.filter(e).length
    }, bi.fn.init.prototype = bi.fn, bi.overrideDefaults = function (n) {
        var r, o = function (e, t) {
            return r = r || n(), 0 === arguments.length && (e = r.element), t = t || r.context, new o.fn.init(e, t)
        };
        return Fi.extend(o, this), o
    }, bi.attrHooks = Oi, bi.cssHooks = Hi;
    var Fi = bi, Ui = (ji.prototype.current = function () {
        return this.node
    }, ji.prototype.next = function (e) {
        return this.node = this.findSibling(this.node, "firstChild", "nextSibling", e), this.node
    }, ji.prototype.prev = function (e) {
        return this.node = this.findSibling(this.node, "lastChild", "previousSibling", e), this.node
    }, ji.prototype.prev2 = function (e) {
        return this.node = this.findPreviousNode(this.node, "lastChild", "previousSibling", e), this.node
    }, ji.prototype.findSibling = function (e, t, n, r) {
        var o, i;
        if (e) {
            if (!r && e[t]) return e[t];
            if (e !== this.rootNode) {
                if (o = e[n]) return o;
                for (i = e.parentNode; i && i !== this.rootNode; i = i.parentNode) if (o = i[n]) return o
            }
        }
    }, ji.prototype.findPreviousNode = function (e, t, n, r) {
        var o, i, a;
        if (e) {
            if (o = e[n], this.rootNode && o === this.rootNode) return;
            if (o) {
                if (!r) for (a = o[t]; a; a = a[t]) if (!a[t]) return a;
                return o
            }
            if ((i = e.parentNode) && i !== this.rootNode) return i
        }
    }, ji);

    function ji(e, t) {
        this.node = e, this.rootNode = t, this.current = this.current.bind(this), this.next = this.next.bind(this), this.prev = this.prev.bind(this), this.prev2 = this.prev2.bind(this)
    }

    var qi, $i = Jn.each, Wi = Jn.grep, Ki = Kn.ie, Xi = /^([a-z0-9],?)+$/i,
        Yi = /^[ \t\r\n]*$/, Gi = function (n, r, o) {
            var i = r.keep_values, e = {
                set: function (e, t, n) {
                    r.url_converter && (t = r.url_converter.call(r.url_converter_scope || o(), t, n, e[0])), e.attr("data-mce-" + n, t).attr(n, t)
                }, get: function (e, t) {
                    return e.attr("data-mce-" + t) || e.attr(t)
                }
            }, t = {
                style: {
                    set: function (e, t) {
                        null === t || "object" != typeof t ? (i && e.attr("data-mce-style", t), null !== t && "string" == typeof t ? (e.removeAttr("style"), e.css(n.parse(t))) : e.attr("style", t)) : e.css(t)
                    }, get: function (e) {
                        var t = e.attr("data-mce-style") || e.attr("style");
                        return t = n.serialize(n.parse(t), e[0].nodeName)
                    }
                }
            };
            return i && (t.href = t.src = e), t
        }, Zi = function (e, t) {
            var n = t.attr("style"), r = e.serialize(e.parse(n), t[0].nodeName);
            r = r || null, t.attr("data-mce-style", r)
        }, Ji = function (e, t) {
            var n, r, o = 0;
            if (e) for (n = e.nodeType, e = e.previousSibling; e; e = e.previousSibling) r = e.nodeType, (!t || 3 !== r || r !== n && e.nodeValue.length) && (o++, n = r);
            return o
        };

    function Qi(a, u) {
        var c, s = this;
        void 0 === u && (u = {});

        function l(e) {
            if (e && a && "string" == typeof e) {
                var t = a.getElementById(e);
                return t && t.id !== e ? a.getElementsByName(e)[1] : t
            }
            return e
        }

        function f(e) {
            return "string" == typeof e && (e = l(e)), B(e)
        }

        function r(e, t, n) {
            var r, o, i = f(e);
            return i.length && (o = (r = c[t]) && r.get ? r.get(i, t) : i.attr(t)), void 0 === o && (o = n || ""), o
        }

        function d(e) {
            var t = l(e);
            return t ? t.attributes : []
        }

        function o(e, t, n) {
            var r, o;
            "" === n && (n = null);
            var i = f(e);
            r = i.attr(t), i.length && ((o = c[t]) && o.set ? o.set(i, n, t) : i.attr(t, n), r !== n && u.onSetAttrib && u.onSetAttrib({
                attrElm: i,
                attrName: t,
                attrValue: n
            }))
        }

        function h() {
            return u.root_element || a.body
        }

        function i(e, t) {
            return on.getPos(a.body, l(e), t)
        }

        function m(e, t, n) {
            var r = f(e);
            return n ? r.css(t) : ("float" === (t = t.replace(/-(\D)/g, function (e, t) {
                return t.toUpperCase()
            })) && (t = Kn.browser.isIE() ? "styleFloat" : "cssFloat"), r[0] && r[0].style ? r[0].style[t] : undefined)
        }

        function g(e) {
            var t, n;
            return e = l(e), t = m(e, "width"), n = m(e, "height"), -1 === t.indexOf("px") && (t = 0), -1 === n.indexOf("px") && (n = 0), {
                w: parseInt(t, 10) || e.offsetWidth || e.clientWidth,
                h: parseInt(n, 10) || e.offsetHeight || e.clientHeight
            }
        }

        function p(e, t) {
            var n;
            if (!e) return !1;
            if (!Array.isArray(e)) {
                if ("*" === t) return 1 === e.nodeType;
                if (Xi.test(t)) {
                    var r = t.toLowerCase().split(/,/),
                        o = e.nodeName.toLowerCase();
                    for (n = r.length - 1; 0 <= n; n--) if (r[n] === o) return !0;
                    return !1
                }
                if (e.nodeType && 1 !== e.nodeType) return !1
            }
            var i = Array.isArray(e) ? e : [e];
            return 0 < Qo(t, i[0].ownerDocument || i[0], null, i).length
        }

        function v(e, t, n, r) {
            var o, i = [], a = l(e);
            for (r = r === undefined, n = n || ("BODY" !== h().nodeName ? h().parentNode : null), Jn.is(t, "string") && (t = "*" === (o = t) ? function (e) {
                return 1 === e.nodeType
            } : function (e) {
                return p(e, o)
            }); a && a !== n && a.nodeType && 9 !== a.nodeType;) {
                if (!t || "function" == typeof t && t(a)) {
                    if (!r) return [a];
                    i.push(a)
                }
                a = a.parentNode
            }
            return r ? i : null
        }

        function n(e, t, n) {
            var r = t;
            if (e) for ("string" == typeof t && (r = function (e) {
                return p(e, t)
            }), e = e[n]; e; e = e[n]) if ("function" == typeof r && r(e)) return e;
            return null
        }

        function y(e, n, r) {
            var o, t = "string" == typeof e ? l(e) : e;
            if (!t) return !1;
            if (Jn.isArray(t) && (t.length || 0 === t.length)) return o = [], $i(t, function (e, t) {
                e && ("string" == typeof e && (e = l(e)), o.push(n.call(r, e, t)))
            }), o;
            var i = r || s;
            return n.call(i, t)
        }

        function b(e, t) {
            f(e).each(function (e, n) {
                $i(t, function (e, t) {
                    o(n, t, e)
                })
            })
        }

        function C(e, r) {
            var t = f(e);
            Ki ? t.each(function (e, t) {
                if (!1 !== t.canHaveHTML) {
                    for (; t.firstChild;) t.removeChild(t.firstChild);
                    try {
                        t.innerHTML = "<br>" + r, t.removeChild(t.firstChild)
                    } catch (n) {
                        Fi("<div></div>").html("<br>" + r).contents().slice(1).appendTo(t)
                    }
                    return r
                }
            }) : t.html(r)
        }

        function w(e, n, r, o, i) {
            return y(e, function (e) {
                var t = "string" == typeof n ? a.createElement(n) : n;
                return b(t, r), o && ("string" != typeof o && o.nodeType ? t.appendChild(o) : "string" == typeof o && C(t, o)), i ? t : e.appendChild(t)
            })
        }

        function x(e, t, n) {
            return w(a.createElement(e), e, t, n, !0)
        }

        function z(e, t) {
            var n = f(e);
            return t ? n.each(function () {
                for (var e; e = this.firstChild;) 3 === e.nodeType && 0 === e.data.length ? this.removeChild(e) : this.parentNode.insertBefore(e, this)
            }).remove() : n.remove(), 1 < n.length ? n.toArray() : n[0]
        }

        function E(e, t, n) {
            f(e).toggleClass(t, n).each(function () {
                "" === this.className && Fi(this).attr("class", null)
            })
        }

        function N(t, e, n) {
            return y(e, function (e) {
                return Jn.is(e, "array") && (t = t.cloneNode(!0)), n && $i(Wi(e.childNodes), function (e) {
                    t.appendChild(e)
                }), e.parentNode.replaceChild(t, e)
            })
        }

        function S() {
            return a.createRange()
        }

        function k(e) {
            if (e && en.isElement(e)) {
                var t = e.getAttribute("data-mce-contenteditable");
                return t && "inherit" !== t ? t : "inherit" !== e.contentEditable ? e.contentEditable : null
            }
            return null
        }

        var T = {}, A = j.window, M = {}, t = 0, e = function U(m, g) {
                void 0 === g && (g = {});
                var p, v = 0, y = {};

                function b(e) {
                    m.getElementsByTagName("head")[0].appendChild(e)
                }

                function n(e, t, n) {
                    function r(e) {
                        l.status = e, l.passed = [], l.failed = [], u && (u.onload = null, u.onerror = null, u = null)
                    }

                    function o() {
                        for (var e = l.passed, t = e.length; t--;) e[t]();
                        r(2)
                    }

                    function i() {
                        for (var e = l.failed, t = e.length; t--;) e[t]();
                        r(3)
                    }

                    function a(e, t) {
                        e() || ((new Date).getTime() - s < p ? Ln.setTimeout(t) : i())
                    }

                    var u, c, s, l, f = function () {
                        a(function () {
                            for (var e, t, n = m.styleSheets, r = n.length; r--;) if ((t = (e = n[r]).ownerNode ? e.ownerNode : e.owningElement) && t.id === u.id) return o(), !0
                        }, f)
                    }, d = function () {
                        a(function () {
                            try {
                                var e = c.sheet.cssRules;
                                return o(), !!e
                            } catch (t) {
                            }
                        }, d)
                    };
                    if (e = Jn._addCacheSuffix(e), y[e] ? l = y[e] : (l = {
                        passed: [],
                        failed: []
                    }, y[e] = l), t && l.passed.push(t), n && l.failed.push(n), 1 !== l.status) if (2 !== l.status) if (3 !== l.status) {
                        if (l.status = 1, (u = m.createElement("link")).rel = "stylesheet", u.type = "text/css", u.id = "u" + v++, u.async = !1, u.defer = !1, s = (new Date).getTime(), g.contentCssCors && (u.crossOrigin = "anonymous"), g.referrerPolicy && tn(at.fromDom(u), "referrerpolicy", g.referrerPolicy), "onload" in u && !((h = j.navigator.userAgent.match(/WebKit\/(\d*)/)) && parseInt(h[1], 10) < 536)) u.onload = f, u.onerror = i; else {
                            if (0 < j.navigator.userAgent.indexOf("Firefox")) return (c = m.createElement("style")).textContent = '@import "' + e + '"', d(), void b(c);
                            f()
                        }
                        var h;
                        b(u), u.href = e
                    } else i(); else o()
                }

                function t(t) {
                    return vn.nu(function (e) {
                        n(t, q(e, $(wn.value(t))), q(e, $(wn.error(t))))
                    })
                }

                function o(e) {
                    return e.fold(W, W)
                }

                return p = g.maxLoadTime || 5e3, {
                    load: n,
                    loadAll: function (e, n, r) {
                        yn(X(e, t)).get(function (e) {
                            var t = Y(e, function (e) {
                                return e.isValue()
                            });
                            0 < t.fail.length ? r(t.fail.map(o)) : n(t.pass.map(o))
                        })
                    },
                    _setReferrerPolicy: function (e) {
                        g.referrerPolicy = e
                    }
                }
            }(a, {
                contentCssCors: u.contentCssCors,
                referrerPolicy: u.referrerPolicy
            }), R = [], D = u.schema ? u.schema : Lr({}), _ = Wr({
                url_converter: u.url_converter,
                url_converter_scope: u.url_converter_scope
            }, u.schema), O = u.ownEvents ? new Zr : Zr.Event,
            H = D.getBlockElements(), B = Fi.overrideDefaults(function () {
                return {context: a, element: F.getRoot()}
            }), P = kr.decode, L = kr.encodeAllRaw, V = function (e, t, n, r) {
                if (Jn.isArray(e)) {
                    for (var o = e.length, i = []; o--;) i[o] = V(e[o], t, n, r);
                    return i
                }
                return !u.collect || e !== a && e !== A || R.push([e, t, n, r]), O.bind(e, t, n, r || F)
            }, I = function (e, t, n) {
                var r;
                if (Jn.isArray(e)) {
                    r = e.length;
                    for (var o = []; r--;) o[r] = I(e[r], t, n);
                    return o
                }
                if (R && (e === a || e === A)) for (r = R.length; r--;) {
                    var i = R[r];
                    e !== i[0] || t && t !== i[1] || n && n !== i[2] || O.unbind(i[0], i[1], i[2])
                }
                return O.unbind(e, t, n)
            }, F = {
                doc: a,
                settings: u,
                win: A,
                files: M,
                stdMode: !0,
                boxModel: !0,
                styleSheetLoader: e,
                boundEvents: R,
                styles: _,
                schema: D,
                events: O,
                isBlock: function (e) {
                    if ("string" == typeof e) return !!H[e];
                    if (e) {
                        var t = e.nodeType;
                        if (t) return !(1 !== t || !H[e.nodeName])
                    }
                    return !1
                },
                $: B,
                $$: f,
                root: null,
                clone: function (t, e) {
                    if (!Ki || 1 !== t.nodeType || e) return t.cloneNode(e);
                    if (e) return null;
                    var n = a.createElement(t.nodeName);
                    return $i(d(t), function (e) {
                        o(n, e.nodeName, r(t, e.nodeName))
                    }), n
                },
                getRoot: h,
                getViewPort: function (e) {
                    var t = qt(e);
                    return {x: t.x(), y: t.y(), w: t.width(), h: t.height()}
                },
                getRect: function (e) {
                    var t, n;
                    return e = l(e), t = i(e), n = g(e), {
                        x: t.x,
                        y: t.y,
                        w: n.w,
                        h: n.h
                    }
                },
                getSize: g,
                getParent: function (e, t, n) {
                    var r = v(e, t, n, !1);
                    return r && 0 < r.length ? r[0] : null
                },
                getParents: v,
                get: l,
                getNext: function (e, t) {
                    return n(e, t, "nextSibling")
                },
                getPrev: function (e, t) {
                    return n(e, t, "previousSibling")
                },
                select: function (e, t) {
                    return Qo(e, l(t) || u.root_element || a, [])
                },
                is: p,
                add: w,
                create: x,
                createHTML: function (e, t, n) {
                    var r, o = "";
                    for (r in o += "<" + e, t) t.hasOwnProperty(r) && null !== t[r] && "undefined" != typeof t[r] && (o += " " + r + '="' + L(t[r]) + '"');
                    return void 0 !== n ? o + ">" + n + "</" + e + ">" : o + " />"
                },
                createFragment: function (e) {
                    var t, n = a.createElement("div"),
                        r = a.createDocumentFragment();
                    for (e && (n.innerHTML = e); t = n.firstChild;) r.appendChild(t);
                    return r
                },
                remove: z,
                setStyle: function (e, t, n) {
                    var r = K(t) ? f(e).css(t, n) : f(e).css(t);
                    u.update_styles && Zi(_, r)
                },
                getStyle: m,
                setStyles: function (e, t) {
                    var n = f(e).css(t);
                    u.update_styles && Zi(_, n)
                },
                removeAllAttribs: function (e) {
                    return y(e, function (e) {
                        var t, n = e.attributes;
                        for (t = n.length - 1; 0 <= t; t--) e.removeAttributeNode(n.item(t))
                    })
                },
                setAttrib: o,
                setAttribs: b,
                getAttrib: r,
                getPos: i,
                parseStyle: function (e) {
                    return _.parse(e)
                },
                serializeStyle: function (e, t) {
                    return _.serialize(e, t)
                },
                addStyle: function (e) {
                    var t, n;
                    if (F !== Qi.DOM && a === j.document) {
                        if (T[e]) return;
                        T[e] = !0
                    }
                    (n = a.getElementById("mceDefaultStyles")) || ((n = a.createElement("style")).id = "mceDefaultStyles", n.type = "text/css", (t = a.getElementsByTagName("head")[0]).firstChild ? t.insertBefore(n, t.firstChild) : t.appendChild(n)), n.styleSheet ? n.styleSheet.cssText += e : n.appendChild(a.createTextNode(e))
                },
                loadCSS: function (e) {
                    var n;
                    F === Qi.DOM || a !== j.document ? (e = e || "", n = a.getElementsByTagName("head")[0], $i(e.split(","), function (e) {
                        var t;
                        e = Jn._addCacheSuffix(e), M[e] || (M[e] = !0, t = x("link", ne(ne({
                            rel: "stylesheet",
                            type: "text/css",
                            href: e
                        }, u.contentCssCors ? {crossOrigin: "anonymous"} : {}), u.referrerPolicy ? {referrerPolicy: u.referrerPolicy} : {})), n.appendChild(t))
                    })) : Qi.DOM.loadCSS(e)
                },
                addClass: function (e, t) {
                    f(e).addClass(t)
                },
                removeClass: function (e, t) {
                    E(e, t, !1)
                },
                hasClass: function (e, t) {
                    return f(e).hasClass(t)
                },
                toggleClass: E,
                show: function (e) {
                    f(e).show()
                },
                hide: function (e) {
                    f(e).hide()
                },
                isHidden: function (e) {
                    return "none" === f(e).css("display")
                },
                uniqueId: function (e) {
                    return (e || "mce_") + t++
                },
                setHTML: C,
                getOuterHTML: function (e) {
                    var t = "string" == typeof e ? l(e) : e;
                    return en.isElement(t) ? t.outerHTML : Fi("<div></div>").append(Fi(t).clone()).html()
                },
                setOuterHTML: function (e, t) {
                    f(e).each(function () {
                        try {
                            if ("outerHTML" in this) return void (this.outerHTML = t)
                        } catch (e) {
                        }
                        z(Fi(this).html(t), !0)
                    })
                },
                decode: P,
                encode: L,
                insertAfter: function (e, t) {
                    var r = l(t);
                    return y(e, function (e) {
                        var t, n;
                        return t = r.parentNode, (n = r.nextSibling) ? t.insertBefore(e, n) : t.appendChild(e), e
                    })
                },
                replace: N,
                rename: function (t, e) {
                    var n;
                    return t.nodeName !== e.toUpperCase() && (n = x(e), $i(d(t), function (e) {
                        o(n, e.nodeName, r(t, e.nodeName))
                    }), N(n, t, !0)), n || t
                },
                findCommonAncestor: function (e, t) {
                    for (var n, r = e; r;) {
                        for (n = t; n && r !== n;) n = n.parentNode;
                        if (r === n) break;
                        r = r.parentNode
                    }
                    return !r && e.ownerDocument ? e.ownerDocument.documentElement : r
                },
                toHex: function (e) {
                    return _.toHex(Jn.trim(e))
                },
                run: y,
                getAttribs: d,
                isEmpty: function (e, t) {
                    var n, r, o, i, a = 0;
                    if (e = e.firstChild) {
                        var u = new Ui(e, e.parentNode),
                            c = D ? D.getWhiteSpaceElements() : {};
                        t = t || (D ? D.getNonEmptyElements() : null);
                        do {
                            if (o = e.nodeType, en.isElement(e)) {
                                var s = e.getAttribute("data-mce-bogus");
                                if (s) {
                                    e = u.next("all" === s);
                                    continue
                                }
                                if (i = e.nodeName.toLowerCase(), t && t[i]) {
                                    if ("br" !== i) return !1;
                                    a++, e = u.next();
                                    continue
                                }
                                for (n = (r = d(e)).length; n--;) if ("name" === (i = r[n].nodeName) || "data-mce-bookmark" === i) return !1
                            }
                            if (8 === o) return !1;
                            if (3 === o && !Yi.test(e.nodeValue)) return !1;
                            if (3 === o && e.parentNode && c[e.parentNode.nodeName] && Yi.test(e.nodeValue)) return !1;
                            e = u.next()
                        } while (e)
                    }
                    return a <= 1
                },
                createRng: S,
                nodeIndex: Ji,
                split: function (e, t, n) {
                    var r, o, i, a = S();
                    if (e && t) return a.setStart(e.parentNode, Ji(e)), a.setEnd(t.parentNode, Ji(t)), r = a.extractContents(), (a = S()).setStart(t.parentNode, Ji(t) + 1), a.setEnd(e.parentNode, Ji(e) + 1), o = a.extractContents(), (i = e.parentNode).insertBefore(pr.trimNode(F, r), e), n ? i.insertBefore(n, e) : i.insertBefore(t, e), i.insertBefore(pr.trimNode(F, o), e), z(e), n || t
                },
                bind: V,
                unbind: I,
                fire: function (e, t, n) {
                    return O.fire(e, t, n)
                },
                getContentEditable: k,
                getContentEditableParent: function (e) {
                    for (var t = h(), n = null; e && e !== t && null === (n = k(e)); e = e.parentNode) ;
                    return n
                },
                destroy: function () {
                    if (R) for (var e = R.length; e--;) {
                        var t = R[e];
                        O.unbind(t[0], t[1], t[2])
                    }
                    Qo.setDocument && Qo.setDocument()
                },
                isChildOf: function (e, t) {
                    for (; e;) {
                        if (t === e) return !0;
                        e = e.parentNode
                    }
                    return !1
                },
                dumpRng: function (e) {
                    return "startContainer: " + e.startContainer.nodeName + ", startOffset: " + e.startOffset + ", endContainer: " + e.endContainer.nodeName + ", endOffset: " + e.endOffset
                }
            };
        return c = Gi(_, u, function () {
            return F
        }), F
    }

    (qi = Qi = Qi || {}).DOM = qi(j.document), qi.nodeIndex = Ji;
    var ea = Qi, ta = ea.DOM, na = Jn.each, ra = Jn.grep,
        oa = (ia.prototype._setReferrerPolicy = function (e) {
            this.settings.referrerPolicy = e
        }, ia.prototype.loadScript = function (e, t, n) {
            var r, o, i = ta;
            o = i.uniqueId(), (r = j.document.createElement("script")).id = o, r.type = "text/javascript", r.src = Jn._addCacheSuffix(e), this.settings.referrerPolicy && i.setAttrib(r, "referrerpolicy", this.settings.referrerPolicy), r.onload = function () {
                i.remove(o), r && (r.onreadystatechange = r.onload = r = null), t()
            }, r.onerror = function () {
                P(n) ? n() : "undefined" != typeof j.console && j.console.log && j.console.log("Failed to load script: " + e)
            }, (j.document.getElementsByTagName("head")[0] || j.document.body).appendChild(r)
        }, ia.prototype.isDone = function (e) {
            return 2 === this.states[e]
        }, ia.prototype.markDone = function (e) {
            this.states[e] = 2
        }, ia.prototype.add = function (e, t, n, r) {
            this.states[e] === undefined && (this.queue.push(e), this.states[e] = 0), t && (this.scriptLoadedCallbacks[e] || (this.scriptLoadedCallbacks[e] = []), this.scriptLoadedCallbacks[e].push({
                success: t,
                failure: r,
                scope: n || this
            }))
        }, ia.prototype.load = function (e, t, n, r) {
            return this.add(e, t, n, r)
        }, ia.prototype.remove = function (e) {
            delete this.states[e], delete this.scriptLoadedCallbacks[e]
        }, ia.prototype.loadQueue = function (e, t, n) {
            this.loadScripts(this.queue, e, t, n)
        }, ia.prototype.loadScripts = function (n, e, t, r) {
            function o(t, e) {
                na(a.scriptLoadedCallbacks[e], function (e) {
                    P(e[t]) && e[t].call(e.scope)
                }), a.scriptLoadedCallbacks[e] = undefined
            }

            var i, a = this, u = [];
            a.queueLoadedCallbacks.push({
                success: e,
                failure: r,
                scope: t || this
            }), (i = function () {
                var e = ra(n);
                if (n.length = 0, na(e, function (e) {
                    2 !== a.states[e] ? 3 !== a.states[e] ? 1 !== a.states[e] && (a.states[e] = 1, a.loading++, a.loadScript(e, function () {
                        a.states[e] = 2, a.loading--, o("success", e), i()
                    }, function () {
                        a.states[e] = 3, a.loading--, u.push(e), o("failure", e), i()
                    })) : o("failure", e) : o("success", e)
                }), !a.loading) {
                    var t = a.queueLoadedCallbacks.slice(0);
                    a.queueLoadedCallbacks.length = 0, na(t, function (e) {
                        0 === u.length ? P(e.success) && e.success.call(e.scope) : P(e.failure) && e.failure.call(e.scope, u)
                    })
                }
            })()
        }, ia.ScriptLoader = new ia, ia);

    function ia(e) {
        void 0 === e && (e = {}), this.states = {}, this.queue = [], this.scriptLoadedCallbacks = {}, this.queueLoadedCallbacks = [], this.loading = 0, this.settings = e
    }

    function aa() {
        return M(ca, sa.get())
    }

    var ua, ca = {}, sa = ut("en"), la = {
        getData: function () {
            return S(ca, function (e) {
                return ne({}, e)
            })
        }, setCode: function (e) {
            e && sa.set(e)
        }, getCode: function () {
            return sa.get()
        }, add: function (e, t) {
            var n = ca[e];
            n || (ca[e] = n = {}), N(t, function (e, t) {
                n[t.toLowerCase()] = e
            })
        }, translate: function (e) {
            function n(e) {
                return P(e) ? Object.prototype.toString.call(e) : a(e) ? "" : "" + e
            }

            function t(e) {
                var t = n(e);
                return M(i, t.toLowerCase()).map(n).getOr(t)
            }

            function r(e) {
                return e.replace(/{context:\w+}$/, "")
            }

            function o(e) {
                return e
            }

            var i = aa().getOr({}), a = function (e) {
                return "" === e || null === e || e === undefined
            };
            if (a(e)) return o("");
            if (function (e) {
                return _(e) && te(e, "raw")
            }(e)) return o(n(e.raw));
            if (function (e) {
                return O(e) && 1 < e.length
            }(e)) {
                var u = e.slice(1);
                return o(r(t(e[0]).replace(/\{([0-9]+)\}/g, function (e, t) {
                    return te(u, t) ? n(u[t]) : e
                })))
            }
            return o(r(t(e)))
        }, isRtl: function () {
            return aa().bind(function (e) {
                return M(e, "_dir")
            }).exists(function (e) {
                return "rtl" === e
            })
        }, hasCode: function (e) {
            return te(ca, e)
        }
    };

    function fa() {
        function u(t, n) {
            var e = G(i, function (e) {
                return e.name === t && e.state === n
            });
            U(e, function (e) {
                return e.callback()
            })
        }

        function c(e) {
            var t;
            return f[e] && (t = f[e].dependencies), t || []
        }

        function s(e, t) {
            return "object" == typeof t ? t : "string" == typeof e ? {
                prefix: "",
                resource: t,
                suffix: ""
            } : {prefix: e.prefix, resource: t, suffix: e.suffix}
        }

        var r = this, o = [], l = {}, f = {}, i = [],
            d = function (e, t, n, r, o) {
                if (!l[e]) {
                    var i = "string" == typeof t ? t : t.prefix + t.resource + t.suffix;
                    0 !== i.indexOf("/") && -1 === i.indexOf("://") && (i = fa.baseURL + "/" + i), l[e] = i.substring(0, i.lastIndexOf("/"));
                    var a = function () {
                        u(e, "loaded"), function (e, n, t, r) {
                            var o = c(e);
                            U(o, function (e) {
                                var t = s(n, e);
                                d(t.resource, t, undefined, undefined)
                            }), t && (r ? t.call(r) : t.call(oa))
                        }(e, t, n, r)
                    };
                    f[e] ? a() : oa.ScriptLoader.add(i, a, r, o)
                }
            }, e = function (e, t, n) {
                void 0 === n && (n = "added"), te(f, e) && "added" === n ? t() : te(l, e) && "loaded" === n ? t() : i.push({
                    name: e,
                    state: n,
                    callback: t
                })
            };
        return {
            items: o, urls: l, lookup: f, _listeners: i, get: function (e) {
                return f[e] ? f[e].instance : undefined
            }, dependencies: c, requireLangPack: function (t, n) {
                !1 !== fa.languageLoad && e(t, function () {
                    var e = la.getCode();
                    !e || n && -1 === ("," + (n || "") + ",").indexOf("," + e + ",") || oa.ScriptLoader.add(l[t] + "/langs/" + e + ".js")
                }, "loaded")
            }, add: function (e, t, n) {
                var r = t;
                return o.push(r), f[e] = {
                    instance: r,
                    dependencies: n
                }, u(e, "added"), r
            }, remove: function (e) {
                delete l[e], delete f[e]
            }, createUrl: s, addComponents: function (e, t) {
                var n = r.urls[e];
                U(t, function (e) {
                    oa.ScriptLoader.add(n + "/" + e)
                })
            }, load: d, waitFor: e
        }
    }

    (ua = fa = fa || {}).PluginManager = ua(), ua.ThemeManager = ua();

    function da(n, r) {
        var o = null;
        return {
            cancel: function () {
                null !== o && (j.clearTimeout(o), o = null)
            }, throttle: function () {
                for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
                null === o && (o = j.setTimeout(function () {
                    n.apply(null, e), o = null
                }, r))
            }
        }
    }

    function ha(n, r) {
        var o = null;
        return {
            cancel: function () {
                null !== o && (j.clearTimeout(o), o = null)
            }, throttle: function () {
                for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
                null !== o && j.clearTimeout(o), o = j.setTimeout(function () {
                    n.apply(null, e), o = null
                }, r)
            }
        }
    }

    function ma(e, t) {
        var n = Ye(e, t);
        return n === undefined || "" === n ? [] : n.split(" ")
    }

    function ga(e) {
        return e.dom().classList !== undefined
    }

    function pa(e, t) {
        return function (e, t, n) {
            var r = ma(e, t).concat([n]);
            return tn(e, t, r.join(" ")), !0
        }(e, "class", t)
    }

    function va(e, t) {
        return function (e, t, n) {
            var r = G(ma(e, t), function (e) {
                return e !== n
            });
            return 0 < r.length ? tn(e, t, r.join(" ")) : Ge(e, t), !1
        }(e, "class", t)
    }

    function ya(e, t) {
        ga(e) ? e.dom().classList.add(t) : pa(e, t)
    }

    function ba(e) {
        0 === (ga(e) ? e.dom().classList : function (e) {
            return ma(e, "class")
        }(e)).length && Ge(e, "class")
    }

    function Ca(e, t) {
        return ga(e) && e.dom().classList.contains(t)
    }

    function wa(e, t) {
        return function (e, t) {
            var n = t === undefined ? j.document : t.dom();
            return pe(n) ? [] : X(n.querySelectorAll(e), at.fromDom)
        }(t, e)
    }

    var xa = fa, za = function (e, t) {
        var n = [];
        return U(Ne(e), function (e) {
            t(e) && (n = n.concat([e])), n = n.concat(za(e, t))
        }), n
    };

    function Ea(e, t, n, r, o) {
        return e(n, r) ? D.some(n) : P(o) && o(n) ? D.none() : t(n, r, o)
    }

    function Na(e, t, n) {
        for (var r = e.dom(), o = P(n) ? n : $(!1); r.parentNode;) {
            r = r.parentNode;
            var i = at.fromDom(r);
            if (t(i)) return D.some(i);
            if (o(i)) break
        }
        return D.none()
    }

    function Sa(e, t, n) {
        return Ea(function (e, t) {
            return t(e)
        }, Na, e, t, n)
    }

    function ka(e, t, n) {
        return Na(e, function (e) {
            return ge(e, t)
        }, n)
    }

    function Ta(e, t) {
        return function (e, t) {
            var n = t === undefined ? j.document : t.dom();
            return pe(n) ? D.none() : D.from(n.querySelector(e)).map(at.fromDom)
        }(t, e)
    }

    function Aa(e, t, n) {
        return Ea(ge, ka, e, t, n)
    }

    function Ma(r, e) {
        function t(e, t) {
            return function (e, t) {
                var n = e.dom();
                return !(!n || !n.hasAttribute) && n.hasAttribute(t)
            }(e, t) ? D.some(Ye(e, t)) : D.none()
        }

        var n = r.selection.getRng(), o = at.fromDom(n.startContainer),
            i = at.fromDom(r.getBody()), a = e.fold(function () {
                return "." + su()
            }, function (e) {
                return "[" + lu() + '="' + e + '"]'
            }), u = Se(o, n.startOffset).getOr(o);
        return Aa(u, a, function (e) {
            return ve(e, i)
        }).bind(function (e) {
            return t(e, "" + fu()).bind(function (n) {
                return t(e, "" + lu()).map(function (e) {
                    var t = du(r, n);
                    return {uid: n, name: e, elements: t}
                })
            })
        })
    }

    function Ra(n, e) {
        function a(e, t) {
            r(e, function (e) {
                return t(e), e
            })
        }

        var o = ut({}), r = function (e, t) {
            var n = o.get(), r = t(n.hasOwnProperty(e) ? n[e] : {
                listeners: [],
                previous: ut(D.none())
            });
            n[e] = r, o.set(n)
        }, t = ha(function () {
            var e = o.get(), t = function (e, t) {
                var n = V.call(e, 0);
                return n.sort(t), n
            }(J(e));
            U(t, function (e) {
                r(e, function (o) {
                    var i = o.previous.get();
                    return Ma(n, D.some(e)).fold(function () {
                        i.isSome() && (function (t) {
                            a(t, function (e) {
                                U(e.listeners, function (e) {
                                    return e(!1, t)
                                })
                            })
                        }(e), o.previous.set(D.none()))
                    }, function (e) {
                        var t = e.uid, n = e.name, r = e.elements;
                        i.is(t) || (function (t, n, r) {
                            a(t, function (e) {
                                U(e.listeners, function (e) {
                                    return e(!0, t, {
                                        uid: n,
                                        nodes: X(r, function (e) {
                                            return e.dom()
                                        })
                                    })
                                })
                            })
                        }(n, t, r), o.previous.set(D.some(t)))
                    }), {previous: o.previous, listeners: o.listeners}
                })
            })
        }, 30);
        return n.on("remove", function () {
            t.cancel()
        }), n.on("NodeChange", function () {
            t.throttle()
        }), {
            addListener: function (e, t) {
                r(e, function (e) {
                    return {
                        previous: e.previous,
                        listeners: e.listeners.concat([t])
                    }
                })
            }
        }
    }

    function Da(e, n) {
        e.on("init", function () {
            e.serializer.addNodeFilter("span", function (e) {
                U(e, function (t) {
                    (function (e) {
                        return D.from(e.attr(lu())).bind(n.lookup)
                    })(t).each(function (e) {
                        !1 === e.persistent && t.unwrap()
                    })
                })
            })
        })
    }

    function _a(e, t) {
        var n = ye(e).dom(), r = at.fromDom(n.createDocumentFragment()),
            o = function (e, t) {
                var n = (t || j.document).createElement("div");
                return n.innerHTML = e, Ne(at.fromDom(n))
            }(t, n);
        De(r, o), _e(e), Bt(e, r)
    }

    function Oa(e, t) {
        return at.fromDom(e.dom().cloneNode(t))
    }

    function Ha(e) {
        return Oa(e, !1)
    }

    function Ba(e) {
        return Oa(e, !0)
    }

    function Pa(e) {
        return vu(e) && (e = e.parentNode), pu(e) && e.hasAttribute("data-mce-caret")
    }

    function La(e) {
        return vu(e) && gu.isZwsp(e.data)
    }

    function Va(e) {
        return Pa(e) || La(e)
    }

    function Ia(e) {
        return e.firstChild !== e.lastChild || !en.isBr(e.firstChild)
    }

    function Fa(e) {
        var t = e.container();
        return !(!e || !en.isText(t)) && (t.data.charAt(e.offset()) === gu.ZWSP || e.isAtStart() && La(t.previousSibling))
    }

    function Ua(e) {
        var t = e.container();
        return !(!e || !en.isText(t)) && (t.data.charAt(e.offset() - 1) === gu.ZWSP || e.isAtEnd() && La(t.nextSibling))
    }

    function ja(e, t, n) {
        var r, o;
        return (r = t.ownerDocument.createElement(e)).setAttribute("data-mce-caret", n ? "before" : "after"), r.setAttribute("data-mce-bogus", "all"), r.appendChild(function () {
            var e = j.document.createElement("br");
            return e.setAttribute("data-mce-bogus", "1"), e
        }()), o = t.parentNode, n ? o.insertBefore(r, t) : t.nextSibling ? o.insertBefore(r, t.nextSibling) : o.appendChild(r), r
    }

    function qa(e) {
        return e && e.hasAttribute("data-mce-caret") ? (function (e) {
            var t = e.getElementsByTagName("br"), n = t[t.length - 1];
            en.isBogus(n) && n.parentNode.removeChild(n)
        }(e), e.removeAttribute("data-mce-caret"), e.removeAttribute("data-mce-bogus"), e.removeAttribute("style"), e.removeAttribute("_moz_abspos"), e) : null
    }

    function $a(e) {
        return !ku(e) && (zu(e) ? !Eu(e.parentNode) : Nu(e) || xu(e) || Su(e) || Tu(e))
    }

    function Wa(e, t) {
        return $a(e) && function (e, t) {
            for (e = e.parentNode; e && e !== t; e = e.parentNode) {
                if (Tu(e)) return !1;
                if (Cu(e)) return !0
            }
            return !0
        }(e, t)
    }

    function Ka(e) {
        return e ? {
            left: Au(e.left),
            top: Au(e.top),
            bottom: Au(e.bottom),
            right: Au(e.right),
            width: Au(e.width),
            height: Au(e.height)
        } : {left: 0, top: 0, bottom: 0, right: 0, width: 0, height: 0}
    }

    function Xa(e, t) {
        return e = Ka(e), t || (e.left = e.left + e.width), e.right = e.left, e.width = 0, e
    }

    function Ya(e, t, n) {
        return 0 <= e && e <= Math.min(t.height, n.height) / 2
    }

    function Ga(e, t) {
        return e.bottom - e.height / 2 < t.top || !(e.top > t.bottom) && Ya(t.top - e.bottom, e, t)
    }

    function Za(e, t) {
        return e.top > t.bottom || !(e.bottom < t.top) && Ya(t.bottom - e.top, e, t)
    }

    function Ja(e, t, n) {
        return t >= e.left && t <= e.right && n >= e.top && n <= e.bottom
    }

    function Qa(e) {
        var t = e.startContainer, n = e.startOffset;
        return t.hasChildNodes() && e.endOffset === n + 1 ? t.childNodes[n] : null
    }

    function eu(e, t) {
        return 1 === e.nodeType && e.hasChildNodes() && (t >= e.childNodes.length && (t = e.childNodes.length - 1), e = e.childNodes[t]), e
    }

    function tu(e) {
        return "string" == typeof e && 768 <= e.charCodeAt(0) && Mu.test(e)
    }

    function nu(e, t, n) {
        return e.isSome() && t.isSome() ? D.some(n(e.getOrDie(), t.getOrDie())) : D.none()
    }

    function ru(e) {
        return e && /[\r\n\t ]/.test(e)
    }

    function ou(e) {
        return !!e.setStart && !!e.setEnd
    }

    function iu(e) {
        var t, n = e.startContainer, r = e.startOffset;
        return !!(ru(e.toString()) && Vu(n.parentNode) && en.isText(n) && (t = n.data, ru(t[r - 1]) || ru(t[r + 1])))
    }

    function au(e) {
        return 0 === e.left && 0 === e.right && 0 === e.top && 0 === e.bottom
    }

    function uu(e, t) {
        var n = Xa(e, t);
        return n.width = 1, n.right = n.left + 1, n
    }

    var cu, su = $("mce-annotation"), lu = $("data-mce-annotation"),
        fu = $("data-mce-annotation-uid"), du = function (e, t) {
            var n = at.fromDom(e.getBody());
            return wa(n, "[" + fu() + '="' + t + '"]')
        }, hu = 0, mu = qr, gu = {
            isZwsp: function (e) {
                return e === mu
            }, ZWSP: mu, trim: function (e) {
                return e.replace(new RegExp(mu, "g"), "")
            }
        }, pu = en.isElement, vu = en.isText, yu = function (e) {
            return vu(e) && e.data[0] === gu.ZWSP
        }, bu = function (e) {
            return vu(e) && e.data[e.data.length - 1] === gu.ZWSP
        }, Cu = en.isContentEditableTrue, wu = en.isContentEditableFalse,
        xu = en.isBr, zu = en.isText,
        Eu = en.matchNodeNames(["script", "style", "textarea"]),
        Nu = en.matchNodeNames(["img", "input", "textarea", "hr", "iframe", "video", "audio", "object"]),
        Su = en.matchNodeNames(["table"]), ku = Va, Tu = function (e) {
            return !1 === function (e) {
                return en.isElement(e) && "true" === e.getAttribute("unselectable")
            }(e) && wu(e)
        }, Au = Math.round,
        Mu = new RegExp("[\u0300-\u036f\u0483-\u0487\u0488-\u0489\u0591-\u05bd\u05bf\u05c1-\u05c2\u05c4-\u05c5\u05c7\u0610-\u061a\u064b-\u065f\u0670\u06d6-\u06dc\u06df-\u06e4\u06e7-\u06e8\u06ea-\u06ed\u0711\u0730-\u074a\u07a6-\u07b0\u07eb-\u07f3\u0816-\u0819\u081b-\u0823\u0825-\u0827\u0829-\u082d\u0859-\u085b\u08e3-\u0902\u093a\u093c\u0941-\u0948\u094d\u0951-\u0957\u0962-\u0963\u0981\u09bc\u09be\u09c1-\u09c4\u09cd\u09d7\u09e2-\u09e3\u0a01-\u0a02\u0a3c\u0a41-\u0a42\u0a47-\u0a48\u0a4b-\u0a4d\u0a51\u0a70-\u0a71\u0a75\u0a81-\u0a82\u0abc\u0ac1-\u0ac5\u0ac7-\u0ac8\u0acd\u0ae2-\u0ae3\u0b01\u0b3c\u0b3e\u0b3f\u0b41-\u0b44\u0b4d\u0b56\u0b57\u0b62-\u0b63\u0b82\u0bbe\u0bc0\u0bcd\u0bd7\u0c00\u0c3e-\u0c40\u0c46-\u0c48\u0c4a-\u0c4d\u0c55-\u0c56\u0c62-\u0c63\u0c81\u0cbc\u0cbf\u0cc2\u0cc6\u0ccc-\u0ccd\u0cd5-\u0cd6\u0ce2-\u0ce3\u0d01\u0d3e\u0d41-\u0d44\u0d4d\u0d57\u0d62-\u0d63\u0dca\u0dcf\u0dd2-\u0dd4\u0dd6\u0ddf\u0e31\u0e34-\u0e3a\u0e47-\u0e4e\u0eb1\u0eb4-\u0eb9\u0ebb-\u0ebc\u0ec8-\u0ecd\u0f18-\u0f19\u0f35\u0f37\u0f39\u0f71-\u0f7e\u0f80-\u0f84\u0f86-\u0f87\u0f8d-\u0f97\u0f99-\u0fbc\u0fc6\u102d-\u1030\u1032-\u1037\u1039-\u103a\u103d-\u103e\u1058-\u1059\u105e-\u1060\u1071-\u1074\u1082\u1085-\u1086\u108d\u109d\u135d-\u135f\u1712-\u1714\u1732-\u1734\u1752-\u1753\u1772-\u1773\u17b4-\u17b5\u17b7-\u17bd\u17c6\u17c9-\u17d3\u17dd\u180b-\u180d\u18a9\u1920-\u1922\u1927-\u1928\u1932\u1939-\u193b\u1a17-\u1a18\u1a1b\u1a56\u1a58-\u1a5e\u1a60\u1a62\u1a65-\u1a6c\u1a73-\u1a7c\u1a7f\u1ab0-\u1abd\u1abe\u1b00-\u1b03\u1b34\u1b36-\u1b3a\u1b3c\u1b42\u1b6b-\u1b73\u1b80-\u1b81\u1ba2-\u1ba5\u1ba8-\u1ba9\u1bab-\u1bad\u1be6\u1be8-\u1be9\u1bed\u1bef-\u1bf1\u1c2c-\u1c33\u1c36-\u1c37\u1cd0-\u1cd2\u1cd4-\u1ce0\u1ce2-\u1ce8\u1ced\u1cf4\u1cf8-\u1cf9\u1dc0-\u1df5\u1dfc-\u1dff\u200c-\u200d\u20d0-\u20dc\u20dd-\u20e0\u20e1\u20e2-\u20e4\u20e5-\u20f0\u2cef-\u2cf1\u2d7f\u2de0-\u2dff\u302a-\u302d\u302e-\u302f\u3099-\u309a\ua66f\ua670-\ua672\ua674-\ua67d\ua69e-\ua69f\ua6f0-\ua6f1\ua802\ua806\ua80b\ua825-\ua826\ua8c4\ua8e0-\ua8f1\ua926-\ua92d\ua947-\ua951\ua980-\ua982\ua9b3\ua9b6-\ua9b9\ua9bc\ua9e5\uaa29-\uaa2e\uaa31-\uaa32\uaa35-\uaa36\uaa43\uaa4c\uaa7c\uaab0\uaab2-\uaab4\uaab7-\uaab8\uaabe-\uaabf\uaac1\uaaec-\uaaed\uaaf6\uabe5\uabe8\uabed\ufb1e\ufe00-\ufe0f\ufe20-\ufe2f\uff9e-\uff9f]"),
        Ru = [].slice, Du = function () {
            for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
            var n = Ru.call(arguments);
            return function (e) {
                for (var t = 0; t < n.length; t++) if (!n[t](e)) return !1;
                return !0
            }
        }, _u = function () {
            for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
            var n = Ru.call(arguments);
            return function (e) {
                for (var t = 0; t < n.length; t++) if (n[t](e)) return !0;
                return !1
            }
        }, Ou = en.isElement, Hu = $a,
        Bu = en.matchStyleValues("display", "block table"),
        Pu = en.matchStyleValues("float", "left right"), Lu = Du(Ou, Hu, c(Pu)),
        Vu = c(en.matchStyleValues("white-space", "pre pre-line pre-wrap")),
        Iu = en.isText, Fu = en.isBr, Uu = ea.nodeIndex, ju = eu,
        qu = function (e) {
            return "createRange" in e ? e.createRange() : ea.DOM.createRng()
        }, $u = function (e) {
            var t, n;
            return t = 0 < (n = e.getClientRects()).length ? Ka(n[0]) : Ka(e.getBoundingClientRect()), !ou(e) && Fu(e) && au(t) ? function (e) {
                var t, n = e.ownerDocument, r = qu(n), o = n.createTextNode($r),
                    i = e.parentNode;
                return i.insertBefore(o, e), r.setStart(o, 0), r.setEnd(o, 1), t = Ka(r.getBoundingClientRect()), i.removeChild(o), t
            }(e) : au(t) && ou(e) ? function (e) {
                var t = e.startContainer, n = e.endContainer, r = e.startOffset,
                    o = e.endOffset;
                if (t === n && en.isText(n) && 0 === r && 1 === o) {
                    var i = e.cloneRange();
                    return i.setEndAfter(n), $u(i)
                }
                return null
            }(e) : t
        }, Wu = function (e) {
            function r(e) {
                0 !== e.height && (0 < i.length && function (e, t) {
                    return e.left === t.left && e.top === t.top && e.bottom === t.bottom && e.right === t.right
                }(e, i[i.length - 1]) || i.push(e))
            }

            function t(e, t) {
                var n = qu(e.ownerDocument);
                if (t < e.data.length) {
                    if (tu(e.data[t])) return i;
                    if (tu(e.data[t - 1]) && (n.setStart(e, t), n.setEnd(e, t + 1), !iu(n))) return r(uu($u(n), !1)), i
                }
                0 < t && (n.setStart(e, t - 1), n.setEnd(e, t), iu(n) || r(uu($u(n), !1))), t < e.data.length && (n.setStart(e, t), n.setEnd(e, t + 1), iu(n) || r(uu($u(n), !0)))
            }

            var n, o, i = [];
            if (Iu(e.container())) return t(e.container(), e.offset()), i;
            if (Ou(e.container())) if (e.isAtEnd()) o = ju(e.container(), e.offset()), Iu(o) && t(o, o.data.length), Lu(o) && !Fu(o) && r(uu($u(o), !1)); else {
                if (o = ju(e.container(), e.offset()), Iu(o) && t(o, 0), Lu(o) && e.isAtEnd()) return r(uu($u(o), !1)), i;
                n = ju(e.container(), e.offset() - 1), Lu(n) && !Fu(n) && (!Bu(n) && !Bu(o) && Lu(o) || r(uu($u(n), !1))), Lu(o) && r(uu($u(o), !0))
            }
            return i
        };

    function Ku(t, n, e) {
        function r() {
            return e = e || Wu(Ku(t, n))
        }

        return {
            container: $(t), offset: $(n), toRange: function () {
                var e;
                return (e = qu(t.ownerDocument)).setStart(t, n), e.setEnd(t, n), e
            }, getClientRects: r, isVisible: function () {
                return 0 < r().length
            }, isAtStart: function () {
                return Iu(t), 0 === n
            }, isAtEnd: function () {
                return Iu(t) ? n >= t.data.length : n >= t.childNodes.length
            }, isEqual: function (e) {
                return e && t === e.container() && n === e.offset()
            }, getNode: function (e) {
                return ju(t, e ? n - 1 : n)
            }
        }
    }

    (cu = Ku = Ku || {}).fromRangeStart = function (e) {
        return cu(e.startContainer, e.startOffset)
    }, cu.fromRangeEnd = function (e) {
        return cu(e.endContainer, e.endOffset)
    }, cu.after = function (e) {
        return cu(e.parentNode, Uu(e) + 1)
    }, cu.before = function (e) {
        return cu(e.parentNode, Uu(e))
    }, cu.isAbove = function (e, t) {
        return nu(z(t.getClientRects()), E(e.getClientRects()), Ga).getOr(!1)
    }, cu.isBelow = function (e, t) {
        return nu(E(t.getClientRects()), z(e.getClientRects()), Za).getOr(!1)
    }, cu.isAtStart = function (e) {
        return !!e && e.isAtStart()
    }, cu.isAtEnd = function (e) {
        return !!e && e.isAtEnd()
    }, cu.isTextPosition = function (e) {
        return !!e && en.isText(e.container())
    }, cu.isElementPosition = function (e) {
        return !1 === cu.isTextPosition(e)
    };

    function Xu(t) {
        return function (e) {
            return t === e
        }
    }

    function Yu(e) {
        return (Fc(e) ? "text()" : e.nodeName.toLowerCase()) + "[" + function (e) {
            var r, t, n;
            return r = $c(qc(e)), t = Yn.findIndex(r, Xu(e), e), r = r.slice(0, t + 1), n = Yn.reduce(r, function (e, t, n) {
                return Fc(t) && Fc(r[n - 1]) && e++, e
            }, 0), r = Yn.filter(r, en.matchNodeNames([e.nodeName])), (t = Yn.findIndex(r, Xu(e), e)) - n
        }(e) + "]"
    }

    function Gu(e, t) {
        var n, r, o, i, a, u = [];
        return n = t.container(), r = t.offset(), Fc(n) ? o = function (e, t) {
            for (; (e = e.previousSibling) && Fc(e);) t += e.data.length;
            return t
        }(n, r) : (r >= (i = n.childNodes).length ? (o = "after", r = i.length - 1) : o = "before", n = i[r]), u.push(Yu(n)), a = function (e, t, n) {
            var r = [];
            for (t = t.parentNode; t !== e && (!n || !n(t)); t = t.parentNode) r.push(t);
            return r
        }(e, n), a = Yn.filter(a, c(en.isBogus)), (u = u.concat(Yn.map(a, function (e) {
            return Yu(e)
        }))).reverse().join("/") + "," + o
    }

    function Zu(e, t) {
        var n, r, o;
        return t ? (t = (n = t.split(","))[0].split("/"), o = 1 < n.length ? n[1] : "before", (r = Yn.reduce(t, function (e, t) {
            return (t = /([\w\-\(\)]+)\[([0-9]+)\]/.exec(t)) ? ("text()" === t[1] && (t[1] = "#text"), function (e, t, n) {
                var r = $c(e);
                return r = Yn.filter(r, function (e, t) {
                    return !Fc(e) || !Fc(r[t - 1])
                }), (r = Yn.filter(r, en.matchNodeNames([t])))[n]
            }(e, t[1], parseInt(t[2], 10))) : null
        }, e)) ? Fc(r) ? function (e, t) {
            for (var n, r = e, o = 0; Fc(r);) {
                if (n = r.data.length, o <= t && t <= o + n) {
                    e = r, t -= o;
                    break
                }
                if (!Fc(r.nextSibling)) {
                    e = r, t = n;
                    break
                }
                o += n, r = r.nextSibling
            }
            return Fc(e) && t > e.data.length && (t = e.data.length), Ic(e, t)
        }(r, parseInt(o, 10)) : (o = "after" === o ? jc(r) + 1 : jc(r), Ic(r.parentNode, o)) : null) : null
    }

    function Ju(e, t) {
        en.isText(t) && 0 === t.data.length && e.remove(t)
    }

    function Qu(e, t, n) {
        en.isDocumentFragment(n) ? function (t, e, n) {
            var r = D.from(n.firstChild), o = D.from(n.lastChild);
            e.insertNode(n), r.each(function (e) {
                return Ju(t, e.previousSibling)
            }), o.each(function (e) {
                return Ju(t, e.nextSibling)
            })
        }(e, t, n) : function (e, t, n) {
            t.insertNode(n), Ju(e, n.previousSibling), Ju(e, n.nextSibling)
        }(e, t, n)
    }

    function ec(e, t, n, r, o) {
        var i, a = r[o ? "startContainer" : "endContainer"],
            u = r[o ? "startOffset" : "endOffset"], c = [], s = 0,
            l = e.getRoot();
        for (en.isText(a) ? c.push(n ? function (e, t, n) {
            var r, o;
            for (o = e(t.data.slice(0, n)).length, r = t.previousSibling; r && en.isText(r); r = r.previousSibling) o += e(r.data).length;
            return o
        }(t, a, u) : u) : (u >= (i = a.childNodes).length && i.length && (s = 1, u = Math.max(0, i.length - 1)), c.push(e.nodeIndex(i[u], n) + s)); a && a !== l; a = a.parentNode) c.push(e.nodeIndex(a, n));
        return c
    }

    function tc(e, t, n) {
        var r = 0;
        return Jn.each(e.select(t), function (e) {
            if ("all" !== e.getAttribute("data-mce-bogus")) return e !== n && void r++
        }), r
    }

    function nc(e, t) {
        var n, r, o, i = t ? "start" : "end";
        n = e[i + "Container"], r = e[i + "Offset"], en.isElement(n) && "TR" === n.nodeName && (n = (o = n.childNodes)[Math.min(t ? r : r - 1, o.length - 1)]) && (r = t ? 0 : n.childNodes.length, e["set" + (t ? "Start" : "End")](n, r))
    }

    function rc(e) {
        return nc(e, !0), nc(e, !1), e
    }

    function oc(e, t) {
        var n;
        if (en.isElement(e) && (e = eu(e, t), Wc(e))) return e;
        if (Va(e)) {
            if (en.isText(e) && Pa(e) && (e = e.parentNode), n = e.previousSibling, Wc(n)) return n;
            if (n = e.nextSibling, Wc(n)) return n
        }
    }

    function ic(e, t, n) {
        var r = n.getNode(), o = r ? r.nodeName : null, i = n.getRng();
        if (Wc(r) || "IMG" === o) return {name: o, index: tc(n.dom, o, r)};
        var a = function (e) {
            return oc(e.startContainer, e.startOffset) || oc(e.endContainer, e.endOffset)
        }(i);
        return a ? {
            name: o = a.tagName,
            index: tc(n.dom, o, a)
        } : function (e, t, n, r) {
            var o = t.dom, i = {};
            return i.start = ec(o, e, n, r, !0), t.isCollapsed() || (i.end = ec(o, e, n, r, !1)), i
        }(e, n, t, i)
    }

    function ac(e, t, n) {
        var r = {
            "data-mce-type": "bookmark",
            id: t,
            style: "overflow:hidden;line-height:0px"
        };
        return n ? e.create("span", r, "&#xFEFF;") : e.create("span", r)
    }

    function uc(e, t) {
        var n = e.dom, r = e.getRng(), o = n.uniqueId(), i = e.isCollapsed(),
            a = e.getNode(), u = a.nodeName;
        if ("IMG" === u) return {name: u, index: tc(n, u, a)};
        var c = rc(r.cloneRange());
        if (!i) {
            c.collapse(!1);
            var s = ac(n, o + "_end", t);
            Qu(n, c, s)
        }
        (r = rc(r)).collapse(!0);
        var l = ac(n, o + "_start", t);
        return Qu(n, r, l), e.moveToBookmark({id: o, keep: 1}), {id: o}
    }

    function cc(e, t, n) {
        function r(e) {
            for (var t; (t = o[e]()) && !en.isText(t) && !n(t);) ;
            return D.from(t).filter(en.isText)
        }

        void 0 === n && (n = s);
        var o = new Ui(e, t);
        return {
            current: function () {
                return D.from(o.current()).filter(en.isText)
            }, next: function () {
                return r("next")
            }, prev: function () {
                return r("prev")
            }, prev2: function () {
                return r("prev2")
            }
        }
    }

    function sc(t, e) {
        var i = e || function (e) {
            return t.isBlock(e) || en.isBr(e) || en.isContentEditableFalse(e)
        }, a = function (e, t, n, r) {
            if (en.isText(e)) {
                var o = r(e, t, e.data);
                if (-1 !== o) return D.some({container: e, offset: o})
            }
            return n().bind(function (e) {
                return a(e.container, e.offset, n, r)
            })
        };
        return {
            backwards: function (e, t, n, r) {
                var o = cc(e, r, i);
                return a(e, t, function () {
                    return o.prev().map(function (e) {
                        return {container: e, offset: e.length}
                    })
                }, n).getOrNull()
            }, forwards: function (e, t, n, r) {
                var o = cc(e, r, i);
                return a(e, t, function () {
                    return o.next().map(function (e) {
                        return {container: e, offset: 0}
                    })
                }, n).getOrNull()
            }
        }
    }

    function lc(e) {
        return en.isElement(e) && e.id === Xc
    }

    function fc(e, t) {
        for (; t && t !== e;) {
            if (t.id === Xc) return t;
            t = t.parentNode
        }
        return null
    }

    function dc(e) {
        var t = e.parentNode;
        t && t.removeChild(e)
    }

    function hc(e, t) {
        0 === t.length ? dc(e) : e.nodeValue = t
    }

    function mc(e) {
        var t = gu.trim(e);
        return {count: e.length - t.length, text: t}
    }

    function gc(e, t) {
        return Zc(e), t
    }

    function pc(e, t) {
        var n = t.container(), r = function (e, t) {
            var n = f(e, t);
            return -1 === n ? D.none() : D.some(n)
        }(Z(n.childNodes), e).map(function (e) {
            return e < t.offset() ? Ic(n, t.offset() - 1) : t
        }).getOr(t);
        return Zc(e), r
    }

    function vc(e, t) {
        return Gc(e) && t.container() === e ? function (e, t) {
            var n = mc(e.data.substr(0, t.offset())),
                r = mc(e.data.substr(t.offset())), o = n.text + r.text;
            return 0 < o.length ? (hc(e, o), Ic(e, t.offset() - n.count)) : t
        }(e, t) : gc(e, t)
    }

    function yc(e, t, n) {
        var r = e.getParam(t, n);
        if (-1 === r.indexOf("=")) return r;
        var o = e.getParam(t, "", "hash");
        return o.hasOwnProperty(e.id) ? o[e.id] : n
    }

    function bc(e, t, n) {
        var r, o, i, a, u, c = Xa(t.getBoundingClientRect(), n);
        return i = "BODY" === e.tagName ? (r = e.ownerDocument.documentElement, o = e.scrollLeft || r.scrollLeft, e.scrollTop || r.scrollTop) : (u = e.getBoundingClientRect(), o = e.scrollLeft - u.left, e.scrollTop - u.top), c.left += o, c.right += o, c.top += i, c.bottom += i, c.width = 1, 0 < (a = t.offsetWidth - t.clientWidth) && (n && (a *= -1), c.left += a, c.right += a), c
    }

    function Cc(e, i, a, t) {
        var n, u, c = ut(D.none()), r = us(e), s = 0 < r.length ? r : "p",
            l = function () {
                !function (e) {
                    var t, n, r, o, i;
                    for (t = Fi("*[contentEditable=false]", e), o = 0; o < t.length; o++) r = (n = t[o]).previousSibling, bu(r) && (1 === (i = r.data).length ? r.parentNode.removeChild(r) : r.deleteData(i.length - 1, 1)), r = n.nextSibling, yu(r) && (1 === (i = r.data).length ? r.parentNode.removeChild(r) : r.deleteData(0, 1))
                }(i), u && (Jc.remove(u), u = null), c.get().each(function (e) {
                    Fi(e.caret).remove(), c.set(D.none())
                }), Ln.clearInterval(n)
            }, f = function () {
                n = Ln.setInterval(function () {
                    t() ? Fi("div.mce-visual-caret", i).toggleClass("mce-visual-caret-hidden") : Fi("div.mce-visual-caret", i).addClass("mce-visual-caret-hidden")
                }, 500)
            };
        return {
            show: function (t, e) {
                var n, r;
                if (l(), function (e) {
                    return en.isElement(e) && /^(TD|TH)$/i.test(e.tagName)
                }(e)) return null;
                if (!a(e)) return u = function (e, t) {
                    var n, r, o;
                    if (r = e.ownerDocument.createTextNode(gu.ZWSP), o = e.parentNode, t) {
                        if (n = e.previousSibling, vu(n)) {
                            if (Va(n)) return n;
                            if (bu(n)) return n.splitText(n.data.length - 1)
                        }
                        o.insertBefore(r, e)
                    } else {
                        if (n = e.nextSibling, vu(n)) {
                            if (Va(n)) return n;
                            if (yu(n)) return n.splitText(1), n
                        }
                        e.nextSibling ? o.insertBefore(r, e.nextSibling) : o.appendChild(r)
                    }
                    return r
                }(e, t), r = e.ownerDocument.createRange(), Ls(u.nextSibling) ? (r.setStart(u, 0), r.setEnd(u, 0)) : (r.setStart(u, 1), r.setEnd(u, 1)), r;
                u = ja(s, e, t), n = bc(i, e, t), Fi(u).css("top", n.top);
                var o = Fi('<div class="mce-visual-caret" data-mce-bogus="all"></div>').css(n).appendTo(i)[0];
                return c.set(D.some({
                    caret: o,
                    element: e,
                    before: t
                })), c.get().each(function (e) {
                    t && Fi(e.caret).addClass("mce-visual-caret-before")
                }), f(), (r = e.ownerDocument.createRange()).setStart(u, 0), r.setEnd(u, 0), r
            }, hide: l, getCss: function () {
                return ".mce-visual-caret {position: absolute;background-color: black;background-color: currentcolor;}.mce-visual-caret-hidden {display: none;}*[data-mce-caret] {position: absolute;left: -1000px;right: auto;top: 0;margin: 0;padding: 0;}"
            }, reposition: function () {
                c.get().each(function (e) {
                    var t = bc(i, e.element, e.before);
                    Fi(e.caret).css(ne({}, t))
                })
            }, destroy: function () {
                return Ln.clearInterval(n)
            }
        }
    }

    function wc() {
        return Ps.isIE() || Ps.isEdge() || Ps.isFirefox()
    }

    function xc(e) {
        return Ls(e) || en.isTable(e) && wc()
    }

    function zc(e) {
        return 0 < e
    }

    function Ec(e) {
        return e < 0
    }

    function Nc(e, t) {
        for (var n; n = e(t);) if (!Us(n)) return n;
        return null
    }

    function Sc(e, t, n, r, o) {
        var i = new Ui(e, r);
        if (Ec(t)) {
            if ((Vs(e) || Us(e)) && n(e = Nc(i.prev, !0))) return e;
            for (; e = Nc(i.prev, o);) if (n(e)) return e
        }
        if (zc(t)) {
            if ((Vs(e) || Us(e)) && n(e = Nc(i.next, !0))) return e;
            for (; e = Nc(i.next, o);) if (n(e)) return e
        }
        return null
    }

    function kc(e, t) {
        for (; e && e !== t;) {
            if (Is(e)) return e;
            e = e.parentNode
        }
        return null
    }

    function Tc(e, t, n) {
        return kc(e.container(), n) === kc(t.container(), n)
    }

    function Ac(e, t) {
        var n, r;
        return t ? (n = t.container(), r = t.offset(), js(n) ? n.childNodes[r + e] : null) : null
    }

    function Mc(e, t) {
        var n = t.ownerDocument.createRange();
        return e ? (n.setStartBefore(t), n.setEndBefore(t)) : (n.setStartAfter(t), n.setEndAfter(t)), n
    }

    function Rc(e, t, n) {
        var r, o, i, a;
        for (o = e ? "previousSibling" : "nextSibling"; n && n !== t;) {
            if (r = n[o], Fs(r) && (r = r[o]), Vs(r)) {
                if (a = n, kc(r, i = t) === kc(a, i)) return r;
                break
            }
            if (qs(r)) break;
            n = n.parentNode
        }
        return null
    }

    function Dc(e, t, n) {
        var r, o, i, a, u = d(Rc, !0, t), c = d(Rc, !1, t);
        if (o = n.startContainer, i = n.startOffset, Pa(o)) {
            if (js(o) || (o = o.parentNode), "before" === (a = o.getAttribute("data-mce-caret")) && (r = o.nextSibling, xc(r))) return $s(r);
            if ("after" === a && (r = o.previousSibling, xc(r))) return Ws(r)
        }
        if (!n.collapsed) return n;
        if (en.isText(o)) {
            if (Fs(o)) {
                if (1 === e) {
                    if (r = c(o)) return $s(r);
                    if (r = u(o)) return Ws(r)
                }
                if (-1 === e) {
                    if (r = u(o)) return Ws(r);
                    if (r = c(o)) return $s(r)
                }
                return n
            }
            if (bu(o) && i >= o.data.length - 1) return 1 === e && (r = c(o)) ? $s(r) : n;
            if (yu(o) && i <= 1) return -1 === e && (r = u(o)) ? Ws(r) : n;
            if (i === o.data.length) return (r = c(o)) ? $s(r) : n;
            if (0 === i) return (r = u(o)) ? Ws(r) : n
        }
        return n
    }

    function _c(e, t) {
        return D.from(Ac(e ? 0 : -1, t)).filter(Vs)
    }

    function Oc(e, t, n) {
        var r = Dc(e, t, n);
        return -1 === e ? Ku.fromRangeStart(r) : Ku.fromRangeEnd(r)
    }

    function Hc(e) {
        return D.from(e.getNode()).map(at.fromDom)
    }

    function Bc(e, t) {
        for (; t = e(t);) if (t.isVisible()) return t;
        return t
    }

    function Pc(e, t) {
        var n = Tc(e, t);
        return !(n || !en.isBr(e.getNode())) || n
    }

    var Lc, Vc, Ic = Ku, Fc = en.isText, Uc = en.isBogus, jc = ea.nodeIndex,
        qc = function (e) {
            var t = e.parentNode;
            return Uc(t) ? qc(t) : t
        }, $c = function (e) {
            return e ? Yn.reduce(e.childNodes, function (e, t) {
                return Uc(t) && "BR" !== t.nodeName ? e = e.concat($c(t)) : e.push(t), e
            }, []) : []
        }, Wc = en.isContentEditableFalse, Kc = {
            getBookmark: function (e, t, n) {
                return 2 === t ? ic(gu.trim, n, e) : 3 === t ? function (e) {
                    var t = e.getRng();
                    return {
                        start: Gu(e.dom.getRoot(), Ic.fromRangeStart(t)),
                        end: Gu(e.dom.getRoot(), Ic.fromRangeEnd(t))
                    }
                }(e) : t ? function (e) {
                    return {rng: e.getRng()}
                }(e) : uc(e, !1)
            }, getUndoBookmark: d(ic, W, !0), getPersistentBookmark: uc
        }, Xc = "_mce_caret", Yc = en.isElement, Gc = en.isText, Zc = function (e) {
            if (Yc(e) && Va(e) && (Ia(e) ? e.removeAttribute("data-mce-caret") : dc(e)), Gc(e)) {
                var t = gu.trim(function (e) {
                    try {
                        return e.nodeValue
                    } catch (t) {
                        return ""
                    }
                }(e));
                hc(e, t)
            }
        }, Jc = {
            removeAndReposition: function (e, t) {
                return Ic.isTextPosition(t) ? vc(e, t) : function (e, t) {
                    return t.container() === e.parentNode ? pc(e, t) : gc(e, t)
                }(e, t)
            }, remove: Zc
        }, Qc = ea.DOM, es = function (e) {
            return e.getParam("iframe_attrs", {})
        }, ts = function (e) {
            return e.getParam("doctype", "<!DOCTYPE html>")
        }, ns = function (e) {
            return e.getParam("document_base_url", "")
        }, rs = function (e) {
            return yc(e, "body_id", "tinymce")
        }, os = function (e) {
            return yc(e, "body_class", "")
        }, is = function (e) {
            return e.getParam("content_security_policy", "")
        }, as = function (e) {
            return e.getParam("br_in_pre", !0)
        }, us = function (e) {
            if (e.getParam("force_p_newlines", !1)) return "p";
            var t = e.getParam("forced_root_block", "p");
            return !1 === t ? "" : !0 === t ? "p" : t
        }, cs = function (e) {
            return e.getParam("forced_root_block_attrs", {})
        }, ss = function (e) {
            return e.getParam("br_newline_selector", ".mce-toc h2,figcaption,caption")
        }, ls = function (e) {
            return e.getParam("no_newline_selector", "")
        }, fs = function (e) {
            return e.getParam("keep_styles", !0)
        }, ds = function (e) {
            return e.getParam("end_container_on_empty_block", !1)
        }, hs = function (e) {
            return Jn.explode(e.getParam("font_size_style_values", "xx-small,x-small,small,medium,large,x-large,xx-large"))
        }, ms = function (e) {
            return Jn.explode(e.getParam("font_size_classes", ""))
        }, gs = function (e) {
            return e.getParam("icons", "", "string")
        }, ps = function (e) {
            return e.getParam("icons_url", "", "string")
        }, vs = function (e) {
            return e.getParam("images_dataimg_filter", $(!0), "function")
        }, ys = function (e) {
            return e.getParam("automatic_uploads", !0, "boolean")
        }, bs = function (e) {
            return e.getParam("images_reuse_filename", !1, "boolean")
        }, Cs = function (e) {
            return e.getParam("images_replace_blob_uris", !0, "boolean")
        }, ws = function (e) {
            return e.getParam("images_upload_url", "", "string")
        }, xs = function (e) {
            return e.getParam("images_upload_base_path", "", "string")
        }, zs = function (e) {
            return e.getParam("images_upload_credentials", !1, "boolean")
        }, Es = function (e) {
            return e.getParam("images_upload_handler", null, "function")
        }, Ns = function (e) {
            return e.getParam("content_css_cors", !1, "boolean")
        }, Ss = function (e) {
            return e.getParam("referrer_policy", "", "string")
        }, ks = function (e) {
            return e.getParam("language", "en", "string")
        }, Ts = function (e) {
            return e.getParam("language_url", "", "string")
        }, As = function (e) {
            return e.getParam("indent_use_margin", !1)
        }, Ms = function (e) {
            return e.getParam("indentation", "40px", "string")
        }, Rs = function (e) {
            var t = e.settings.content_css;
            return K(t) ? X(t.split(","), se) : O(t) ? t : !1 === t || e.inline ? [] : ["default"]
        }, Ds = function (e) {
            return e.getParam("directionality", la.isRtl() ? "rtl" : undefined)
        }, _s = function (e) {
            return e.getParam("inline_boundaries_selector", "a[href],code,.mce-annotation", "string")
        }, Os = function (e) {
            return e.getParam("object_resizing")
        }, Hs = function (e) {
            return e.getParam("resize_img_proportional", !0, "boolean")
        }, Bs = function (e) {
            return e.getParam("placeholder", Qc.getAttrib(e.getElement(), "placeholder"), "string")
        }, Ps = de().browser, Ls = en.isContentEditableFalse,
        Vs = en.isContentEditableFalse,
        Is = en.matchStyleValues("display", "block table table-cell table-caption list-item"),
        Fs = Va, Us = Pa, js = en.isElement, qs = $a, $s = d(Mc, !0),
        Ws = d(Mc, !1);
    (Vc = Lc = Lc || {})[Vc.Backwards = -1] = "Backwards", Vc[Vc.Forwards = 1] = "Forwards";

    function Ks(e, t) {
        return e.hasChildNodes() && t < e.childNodes.length ? e.childNodes[t] : null
    }

    function Xs(e, t) {
        if (zc(e)) {
            if (Bl(t.previousSibling) && !_l(t.previousSibling)) return Ic.before(t);
            if (_l(t)) return Ic(t, 0)
        }
        if (Ec(e)) {
            if (Bl(t.nextSibling) && !_l(t.nextSibling)) return Ic.after(t);
            if (_l(t)) return Ic(t, t.data.length)
        }
        return Ec(e) ? Hl(t) ? Ic.before(t) : Ic.after(t) : Ic.before(t)
    }

    function Ys(t) {
        return {
            next: function (e) {
                return Vl(Lc.Forwards, e, t)
            }, prev: function (e) {
                return Vl(Lc.Backwards, e, t)
            }
        }
    }

    function Gs(e) {
        return Ic.isTextPosition(e) ? 0 === e.offset() : $a(e.getNode())
    }

    function Zs(e) {
        if (Ic.isTextPosition(e)) {
            var t = e.container();
            return e.offset() === t.data.length
        }
        return $a(e.getNode(!0))
    }

    function Js(e, t) {
        return !Ic.isTextPosition(e) && !Ic.isTextPosition(t) && e.getNode() === t.getNode(!0)
    }

    function Qs(e, t, n) {
        return e ? !Js(t, n) && !function (e) {
            return !Ic.isTextPosition(e) && en.isBr(e.getNode())
        }(t) && Zs(t) && Gs(n) : !Js(n, t) && Gs(t) && Zs(n)
    }

    function el(t, n, r) {
        return Il(t, n, r).bind(function (e) {
            return Tc(r, e, n) && Qs(t, r, e) ? Il(t, n, e) : D.some(e)
        })
    }

    function tl(e, t) {
        var n = e ? t.firstChild : t.lastChild;
        return en.isText(n) ? D.some(Ic(n, e ? 0 : n.data.length)) : n ? $a(n) ? D.some(e ? Ic.before(n) : function (e) {
            return en.isBr(e) ? Ic.before(e) : Ic.after(e)
        }(n)) : function (e, t, n) {
            var r = e ? Ic.before(n) : Ic.after(n);
            return Il(e, t, r)
        }(e, t, n) : D.none()
    }

    function nl(e, t) {
        return en.isElement(t) && e.isBlock(t) && !t.innerHTML && !Kn.ie && (t.innerHTML = '<br data-mce-bogus="1" />'), t
    }

    function rl(e, t) {
        return ql.lastPositionIn(e).fold(function () {
            return !1
        }, function (e) {
            return t.setStart(e.container(), e.offset()), t.setEnd(e.container(), e.offset()), !0
        })
    }

    function ol(e, t, n) {
        return !(!function (e) {
            return !1 === e.hasChildNodes()
        }(t) || !fc(e, t)) && (function (e, t) {
            var n = e.ownerDocument.createTextNode(gu.ZWSP);
            e.appendChild(n), t.setStart(n, 0), t.setEnd(n, 0)
        }(t, n), !0)
    }

    function il(e, t, n, r) {
        var o, i, a, u, c = n[t ? "start" : "end"], s = e.getRoot();
        if (c) {
            for (a = c[0], i = s, o = c.length - 1; 1 <= o; o--) {
                if (u = i.childNodes, ol(s, i, r)) return !0;
                if (c[o] > u.length - 1) return !!ol(s, i, r) || rl(i, r);
                i = u[c[o]]
            }
            3 === i.nodeType && (a = Math.min(c[0], i.nodeValue.length)), 1 === i.nodeType && (a = Math.min(c[0], i.childNodes.length)), t ? r.setStart(i, a) : r.setEnd(i, a)
        }
        return !0
    }

    function al(e) {
        return en.isText(e) && 0 < e.data.length
    }

    function ul(e, t, n) {
        var r, o, i, a, u, c, s = e.get(n.id + "_" + t), l = n.keep;
        if (s) {
            if (r = s.parentNode, c = (u = (o = "start" === t ? l ? s.hasChildNodes() ? (r = s.firstChild, 1) : al(s.nextSibling) ? (r = s.nextSibling, 0) : al(s.previousSibling) ? (r = s.previousSibling, s.previousSibling.data.length) : (r = s.parentNode, e.nodeIndex(s) + 1) : e.nodeIndex(s) : l ? s.hasChildNodes() ? (r = s.firstChild, 1) : al(s.previousSibling) ? (r = s.previousSibling, s.previousSibling.data.length) : (r = s.parentNode, e.nodeIndex(s)) : e.nodeIndex(s), r), o), !l) {
                for (a = s.previousSibling, i = s.nextSibling, Jn.each(Jn.grep(s.childNodes), function (e) {
                    en.isText(e) && (e.nodeValue = e.nodeValue.replace(/\uFEFF/g, ""))
                }); s = e.get(n.id + "_" + t);) e.remove(s, !0);
                a && i && a.nodeType === i.nodeType && en.isText(a) && !Kn.opera && (o = a.nodeValue.length, a.appendData(i.nodeValue), e.remove(i), c = (u = a, o))
            }
            return D.some(Ic(u, c))
        }
        return D.none()
    }

    function cl(e) {
        return "" !== e && -1 !== " \f\n\r\t\x0B".indexOf(e)
    }

    function sl(e) {
        return !cl(e) && !Yl(e)
    }

    function ll(e) {
        return !!e.nodeType
    }

    function fl(e, t, n) {
        var r, o, i, a = n.startOffset, u = n.startContainer;
        if ((n.startContainer !== n.endContainer || !function (e) {
            return e && /^(IMG)$/.test(e.nodeName)
        }(n.startContainer.childNodes[n.startOffset])) && 1 === u.nodeType) for (a < (i = u.childNodes).length ? (u = i[a], r = new Ui(u, e.getParent(u, e.isBlock))) : (u = i[i.length - 1], (r = new Ui(u, e.getParent(u, e.isBlock))).next(!0)), o = r.current(); o; o = r.next()) if (3 === o.nodeType && !Gl(o)) return n.setStart(o, 0), void t.setRng(n)
    }

    function dl(e, t, n) {
        if (e) {
            var r = t ? "nextSibling" : "previousSibling";
            for (e = n ? e : e[r]; e; e = e[r]) if (1 === e.nodeType || !Gl(e)) return e
        }
    }

    function hl(e, t) {
        return ll(t) && (t = t.nodeName), !!e.schema.getTextBlockElements()[t.toLowerCase()]
    }

    function ml(e, t, n) {
        return e.schema.isValidChild(t, n)
    }

    function gl(e, n) {
        return "string" != typeof e ? e = e(n) : n && (e = e.replace(/%(\w+)/g, function (e, t) {
            return n[t] || e
        })), e
    }

    function pl(e, t) {
        return e = "" + ((e = e || "").nodeName || e), t = "" + ((t = t || "").nodeName || t), e.toLowerCase() === t.toLowerCase()
    }

    function vl(e, t, n) {
        return "color" !== n && "backgroundColor" !== n || (t = e.toHex(t)), "fontWeight" === n && 700 === t && (t = "bold"), "fontFamily" === n && (t = t.replace(/[\'\"]/g, "").replace(/,\s+/g, ",")), "" + t
    }

    function yl(e, t, n) {
        return vl(e, e.getStyle(t, n), n)
    }

    function bl(t, e) {
        var n;
        return t.getParent(e, function (e) {
            return (n = t.getStyle(e, "text-decoration")) && "none" !== n
        }), n
    }

    function Cl(e, t, n) {
        return e.getParents(t, n, e.getRoot())
    }

    function wl(e, t) {
        for (var n = t; n;) {
            if (en.isElement(n) && e.getContentEditable(n)) return "false" === e.getContentEditable(n) ? n : t;
            n = n.parentNode
        }
        return t
    }

    function xl(e, t, n, r) {
        for (var o = t.data, i = n; e ? 0 <= i : i < o.length; e ? i-- : i++) if (r(o.charAt(i))) return e ? i + 1 : i;
        return -1
    }

    function zl(e, t, n) {
        return xl(e, t, n, function (e) {
            return Yl(e) || cl(e)
        })
    }

    function El(e, t, n) {
        return xl(e, t, n, sl)
    }

    function Nl(i, e, t, n, a, r) {
        function o(e, t, n) {
            var r = sc(i), o = a ? r.backwards : r.forwards;
            return D.from(o(e, t, function (e, t) {
                return Zl(e.parentNode) ? -1 : n(a, u = e, t)
            }, c))
        }

        var u, c = i.getParent(t, i.isBlock) || e;
        return o(t, n, zl).bind(function (e) {
            return r ? o(e.container, e.offset + (a ? -1 : 0), El) : D.some(e)
        }).orThunk(function () {
            return u ? D.some({
                container: u,
                offset: a ? 0 : u.length
            }) : D.none()
        })
    }

    function Sl(e, t, n, r, o) {
        en.isText(r) && 0 === r.nodeValue.length && r[o] && (r = r[o]);
        for (var i = Jl(e, r), a = 0; a < i.length; a++) for (var u = 0; u < t.length; u++) {
            var c = t[u];
            if (!("collapsed" in c && c.collapsed !== n.collapsed) && e.is(i[a], c.selector)) return i[a]
        }
        return r
    }

    function kl(t, e, n, r) {
        var o, i = t.dom, a = i.getRoot();
        if (e[0].wrapper || (o = i.getParent(n, e[0].block, a)), !o) {
            var u = i.getParent(n, "LI,TD,TH");
            o = i.getParent(en.isText(n) ? n.parentNode : n, function (e) {
                return e !== a && ef(t, e)
            }, u)
        }
        if (o && e[0].wrapper && (o = Jl(i, o, "ul,ol").reverse()[0] || o), !o) for (o = n; o[r] && !i.isBlock(o[r]) && (o = o[r], !pl(o, "br"));) ;
        return o || n
    }

    function Tl(e, t, n, r, o, i, a) {
        var u, c, s, l, f, d;
        if (u = c = a ? n : o, l = a ? "previousSibling" : "nextSibling", f = e.getRoot(), en.isText(u) && !Ql(u) && (a ? 0 < r : i < u.nodeValue.length)) return u;
        for (; ;) {
            if (!t[0].block_expand && e.isBlock(c)) return c;
            for (s = c[l]; s; s = s[l]) if (!Zl(s) && !Ql(s) && ("BR" !== (d = s).nodeName || !d.getAttribute("data-mce-bogus") || d.nextSibling)) return c;
            if (c === f || c.parentNode === f) {
                u = c;
                break
            }
            c = c.parentNode
        }
        return u
    }

    function Al(e, t, n, r) {
        void 0 === r && (r = !1);
        var o = t.startContainer, i = t.startOffset, a = t.endContainer,
            u = t.endOffset, c = e.dom;
        return en.isElement(o) && o.hasChildNodes() && (o = eu(o, i), en.isText(o) && (i = 0)), en.isElement(a) && a.hasChildNodes() && (a = eu(a, t.collapsed ? u : u - 1), en.isText(a) && (u = a.nodeValue.length)), o = wl(c, o), a = wl(c, a), (Zl(o.parentNode) || Zl(o)) && (o = Zl(o) ? o : o.parentNode, o = t.collapsed ? o.previousSibling || o : o.nextSibling || o, en.isText(o) && (i = t.collapsed ? o.length : 0)), (Zl(a.parentNode) || Zl(a)) && (a = Zl(a) ? a : a.parentNode, a = t.collapsed ? a.nextSibling || a : a.previousSibling || a, en.isText(a) && (u = t.collapsed ? 0 : a.length)), t.collapsed && (Nl(c, e.getBody(), o, i, !0, r).each(function (e) {
            var t = e.container, n = e.offset;
            o = t, i = n
        }), Nl(c, e.getBody(), a, u, !1, r).each(function (e) {
            var t = e.container, n = e.offset;
            a = t, u = n
        })), (n[0].inline || n[0].block_expand) && (n[0].inline && en.isText(o) && 0 !== i || (o = Tl(c, n, o, i, a, u, !0)), n[0].inline && en.isText(a) && u !== a.nodeValue.length || (a = Tl(c, n, o, i, a, u, !1))), n[0].selector && !1 !== n[0].expand && !n[0].inline && (o = Sl(c, n, t, o, "previousSibling"), a = Sl(c, n, t, a, "nextSibling")), (n[0].block || n[0].selector) && (o = kl(e, n, o, "previousSibling"), a = kl(e, n, a, "nextSibling"), n[0].block && (c.isBlock(o) || (o = Tl(c, n, o, i, a, u, !0)), c.isBlock(a) || (a = Tl(c, n, o, i, a, u, !1)))), en.isElement(o) && (i = c.nodeIndex(o), o = o.parentNode), en.isElement(a) && (u = c.nodeIndex(a) + 1, a = a.parentNode), {
            startContainer: o,
            startOffset: i,
            endContainer: a,
            endOffset: u
        }
    }

    function Ml(e, t) {
        var n = e.childNodes;
        return t >= n.length ? t = n.length - 1 : t < 0 && (t = 0), n[t] || e
    }

    var Rl, Dl = en.isContentEditableFalse, _l = en.isText, Ol = en.isElement,
        Hl = en.isBr, Bl = $a, Pl = function (e) {
            return Nu(e) || function (e) {
                return !!Tu(e) && !0 !== y(Z(e.getElementsByTagName("*")), function (e, t) {
                    return e || Cu(t)
                }, !1)
            }(e)
        }, Ll = Wa, Vl = function (e, t, n) {
            var r, o, i, a, u;
            if (!Ol(n) || !t) return null;
            if (t.isEqual(Ic.after(n)) && n.lastChild) {
                if (u = Ic.after(n.lastChild), Ec(e) && Bl(n.lastChild) && Ol(n.lastChild)) return Hl(n.lastChild) ? Ic.before(n.lastChild) : u
            } else u = t;
            var c = u.container(), s = u.offset();
            if (_l(c)) {
                if (Ec(e) && 0 < s) return Ic(c, --s);
                if (zc(e) && s < c.length) return Ic(c, ++s);
                r = c
            } else {
                if (Ec(e) && 0 < s && (o = Ks(c, s - 1), Bl(o))) return !Pl(o) && (i = Sc(o, e, Ll, o)) ? _l(i) ? Ic(i, i.data.length) : Ic.after(i) : _l(o) ? Ic(o, o.data.length) : Ic.before(o);
                if (zc(e) && s < c.childNodes.length && (o = Ks(c, s), Bl(o))) return Hl(o) ? function (e, t) {
                    var n = t.nextSibling;
                    return n && Bl(n) ? _l(n) ? Ic(n, 0) : Ic.before(n) : Vl(Lc.Forwards, Ic.after(t), e)
                }(n, o) : !Pl(o) && (i = Sc(o, e, Ll, o)) ? _l(i) ? Ic(i, 0) : Ic.before(i) : _l(o) ? Ic(o, 0) : Ic.after(o);
                r = o || u.getNode()
            }
            return (zc(e) && u.isAtEnd() || Ec(e) && u.isAtStart()) && (r = Sc(r, e, $(!0), n, !0), Ll(r, n)) ? Xs(e, r) : (o = Sc(r, e, Ll, n), !(a = Yn.last(G(function (e, t) {
                for (var n = []; e && e !== t;) n.push(e), e = e.parentNode;
                return n
            }(c, n), Dl))) || o && a.contains(o) ? o ? Xs(e, o) : null : u = zc(e) ? Ic.after(a) : Ic.before(a))
        }, Il = function (e, t, n) {
            var r = Ys(t);
            return D.from(e ? r.next(n) : r.prev(n))
        }, Fl = function (t, n, e, r) {
            return el(t, n, e).bind(function (e) {
                return r(e) ? Fl(t, n, e, r) : D.some(e)
            })
        }, Ul = d(Il, !0), jl = d(Il, !1), ql = {
            fromPosition: Il,
            nextPosition: Ul,
            prevPosition: jl,
            navigate: el,
            navigateIgnore: Fl,
            positionIn: tl,
            firstPositionIn: d(tl, !0),
            lastPositionIn: d(tl, !1)
        }, $l = function (e, t) {
            var n = e.dom;
            if (t) {
                if (function (e) {
                    return Jn.isArray(e.start)
                }(t)) return function (e, t) {
                    var n = e.createRng();
                    return il(e, !0, t, n) && il(e, !1, t, n) ? D.some(n) : D.none()
                }(n, t);
                if (function (e) {
                    return "string" == typeof e.start
                }(t)) return D.some(function (e, t) {
                    var n, r;
                    return n = e.createRng(), r = Zu(e.getRoot(), t.start), n.setStart(r.container(), r.offset()), r = Zu(e.getRoot(), t.end), n.setEnd(r.container(), r.offset()), n
                }(n, t));
                if (function (e) {
                    return e.hasOwnProperty("id")
                }(t)) return function (r, e) {
                    var t = ul(r, "start", e), n = ul(r, "end", e);
                    return nu(t, n.or(t), function (e, t) {
                        var n = r.createRng();
                        return n.setStart(nl(r, e.container()), e.offset()), n.setEnd(nl(r, t.container()), t.offset()), n
                    })
                }(n, t);
                if (function (e) {
                    return e.hasOwnProperty("name")
                }(t)) return function (n, e) {
                    return D.from(n.select(e.name)[e.index]).map(function (e) {
                        var t = n.createRng();
                        return t.selectNode(e), t
                    })
                }(n, t);
                if (function (e) {
                    return e.hasOwnProperty("rng")
                }(t)) return D.some(t.rng)
            }
            return D.none()
        }, Wl = function (e, t, n) {
            return Kc.getBookmark(e, t, n)
        }, Kl = function (t, e) {
            $l(t, e).each(function (e) {
                t.setRng(e)
            })
        }, Xl = function (e) {
            return en.isElement(e) && "SPAN" === e.tagName && "bookmark" === e.getAttribute("data-mce-type")
        }, Yl = (Rl = $r, function (e) {
            return Rl === e
        }), Gl = function (e) {
            return e && en.isText(e) && /^([\t \r\n]+|)$/.test(e.nodeValue)
        }, Zl = Xl, Jl = Cl, Ql = Gl, ef = hl, tf = Jn.each,
        nf = function (e, t, u) {
            var n = t.startContainer, r = t.startOffset, o = t.endContainer,
                i = t.endOffset,
                a = e.select("td[data-mce-selected],th[data-mce-selected]");
            if (0 < a.length) tf(a, function (e) {
                u([e])
            }); else {
                var c = function (e) {
                    var t;
                    return 3 === (t = e[0]).nodeType && t === n && r >= t.nodeValue.length && e.splice(0, 1), t = e[e.length - 1], 0 === i && 0 < e.length && t === o && 3 === t.nodeType && e.splice(e.length - 1, 1), e
                }, s = function (e, t, n) {
                    for (var r = []; e && e !== n; e = e[t]) r.push(e);
                    return r
                }, l = function (e, t) {
                    do {
                        if (e.parentNode === t) return e;
                        e = e.parentNode
                    } while (e)
                }, f = function (e, t, n) {
                    for (var r = n ? "nextSibling" : "previousSibling", o = e, i = o.parentNode; o && o !== t; o = i) {
                        i = o.parentNode;
                        var a = s(o === e ? o : o[r], r);
                        a.length && (n || a.reverse(), u(c(a)))
                    }
                };
                if (1 === n.nodeType && n.hasChildNodes() && (n = Ml(n, r)), 1 === o.nodeType && o.hasChildNodes() && (o = function (e, t) {
                    return Ml(e, t - 1)
                }(o, i)), n === o) return u(c([n]));
                for (var d = e.findCommonAncestor(n, o), h = n; h; h = h.parentNode) {
                    if (h === o) return f(n, d, !0);
                    if (h === d) break
                }
                for (h = o; h; h = h.parentNode) {
                    if (h === n) return f(o, d);
                    if (h === d) break
                }
                var m = l(n, d) || n, g = l(o, d) || o;
                f(n, m, !0);
                var p = s(m === n ? m : m.nextSibling, "nextSibling", g === o ? g.nextSibling : g);
                p.length && u(c(p)), f(o, g)
            }
        };

    function rf(e) {
        return df.get(e)
    }

    function of(t, n, r, o) {
        return Ce(n).fold(function () {
            return "skipping"
        }, function (e) {
            return "br" === o || function (e) {
                return Vt(e) && rf(e) === qr
            }(n) ? "valid" : function (e) {
                return Lt(e) && Ca(e, su())
            }(n) ? "existing" : lc(n) ? "caret" : ml(t, r, o) && ml(t, He(e), r) ? "valid" : "invalid-child"
        })
    }

    function af(e, t, n, r) {
        var o = t.uid, i = void 0 === o ? function (e) {
            var t = (new Date).getTime();
            return e + "_" + Math.floor(1e9 * Math.random()) + ++hu + String(t)
        }("mce-annotation") : o, a = function h(e, t) {
            var n = {};
            for (var r in e) Object.prototype.hasOwnProperty.call(e, r) && t.indexOf(r) < 0 && (n[r] = e[r]);
            if (null != e && "function" == typeof Object.getOwnPropertySymbols) {
                var o = 0;
                for (r = Object.getOwnPropertySymbols(e); o < r.length; o++) t.indexOf(r[o]) < 0 && Object.prototype.propertyIsEnumerable.call(e, r[o]) && (n[r[o]] = e[r[o]])
            }
            return n
        }(t, ["uid"]), u = at.fromTag("span", e);
        ya(u, su()), tn(u, "" + fu(), i), tn(u, "" + lu(), n);
        var c = r(i, a), s = c.attributes, l = void 0 === s ? {} : s,
            f = c.classes, d = void 0 === f ? [] : f;
        return Xe(u, l), function (t, e) {
            U(e, function (e) {
                ya(t, e)
            })
        }(u, d), u
    }

    function uf(n, e, t, r, o) {
        function i() {
            s.set(D.none())
        }

        function a(e) {
            U(e, l)
        }

        var u = [], c = af(n.getDoc(), o, t, r), s = ut(D.none()),
            l = function (e) {
                switch (of(n, e, "span", He(e))) {
                    case"invalid-child":
                        i();
                        var t = Ne(e);
                        a(t), i();
                        break;
                    case"valid":
                        !function (e, t) {
                            Ae(e, t), Bt(t, e)
                        }(e, s.get().getOrThunk(function () {
                            var e = Ha(c);
                            return u.push(e), s.set(D.some(e)), e
                        }))
                }
            };
        return nf(n.dom, e, function (e) {
            i(), function (e) {
                var t = X(e, at.fromDom);
                a(t)
            }(e)
        }), u
    }

    function cf(o, i, a, u) {
        o.undoManager.transact(function () {
            var e = o.selection.getRng();
            if (e.collapsed && function (e, t) {
                var n = Al(e, t, [{inline: !0}]);
                t.setStart(n.startContainer, n.startOffset), t.setEnd(n.endContainer, n.endOffset), e.selection.setRng(t)
            }(o, e), o.selection.getRng().collapsed) {
                var t = af(o.getDoc(), u, i, a.decorate);
                _a(t, $r), o.selection.getRng().insertNode(t.dom()), o.selection.select(t.dom())
            } else {
                var n = Kc.getPersistentBookmark(o.selection, !1),
                    r = o.selection.getRng();
                uf(o, r, i, a.decorate, u), o.selection.moveToBookmark(n)
            }
        })
    }

    function sf(r) {
        var o = function () {
            var n = {};
            return {
                register: function (e, t) {
                    n[e] = {name: e, settings: t}
                }, lookup: function (e) {
                    return n.hasOwnProperty(e) ? D.from(n[e]).map(function (e) {
                        return e.settings
                    }) : D.none()
                }
            }
        }();
        Da(r, o);
        var n = Ra(r);
        return {
            register: function (e, t) {
                o.register(e, t)
            }, annotate: function (t, n) {
                o.lookup(t).each(function (e) {
                    cf(r, t, e, n)
                })
            }, annotationChanged: function (e, t) {
                n.addListener(e, t)
            }, remove: function (e) {
                Ma(r, D.some(e)).each(function (e) {
                    var t = e.elements;
                    U(t, Oe)
                })
            }, getAll: function (e) {
                var t = function (e, t) {
                    var n = at.fromDom(e.getBody()),
                        r = wa(n, "[" + lu() + '="' + t + '"]'), o = {};
                    return U(r, function (e) {
                        var t = Ye(e, fu()),
                            n = o.hasOwnProperty(t) ? o[t] : [];
                        o[t] = n.concat([e])
                    }), o
                }(r, e);
                return S(t, function (e) {
                    return X(e, function (e) {
                        return e.dom()
                    })
                })
            }
        }
    }

    function lf(e, t, n) {
        var r = n ? "lastChild" : "firstChild", o = n ? "prev" : "next";
        if (e[r]) return e[r];
        if (e !== t) {
            var i = e[o];
            if (i) return i;
            for (var a = e.parent; a && a !== t; a = a.parent) if (i = a[o]) return i
        }
    }

    function ff(e) {
        if (!hf.test(e.value)) return !1;
        var t = e.parent;
        return !t || "span" === t.name && !t.attr("style") || !/^[ ]+$/.test(e.value)
    }

    var df = function IN(n, r) {
        var t = function (e) {
            return n(e) ? D.from(e.dom().nodeValue) : D.none()
        };
        return {
            get: function (e) {
                if (!n(e)) throw new Error("Can only get " + r + " value of a " + r + " node");
                return t(e).getOr("")
            }, getOption: t, set: function (e, t) {
                if (!n(e)) throw new Error("Can only set raw " + r + " value of a " + r + " node");
                e.dom().nodeValue = t
            }
        }
    }(Vt, "text"), hf = /^[ \t\r\n]*$/, mf = {
        "#text": 3,
        "#comment": 8,
        "#cdata": 4,
        "#pi": 7,
        "#doctype": 10,
        "#document-fragment": 11
    }, gf = (pf.create = function (e, t) {
        var n = new pf(e, mf[e] || 1);
        if (t) for (var r in t) n.attr(r, t[r]);
        return n
    }, pf.prototype.replace = function (e) {
        return e.parent && e.remove(), this.insert(e, this), this.remove(), this
    }, pf.prototype.attr = function (e, t) {
        var n;
        if ("string" != typeof e) {
            for (var r in e) this.attr(r, e[r]);
            return this
        }
        if (n = this.attributes) {
            if (t === undefined) return n.map[e];
            if (null === t) {
                if (e in n.map) {
                    delete n.map[e];
                    for (var o = n.length; o--;) if (n[o].name === e) return n.splice(o, 1), this
                }
                return this
            }
            if (e in n.map) {
                for (o = n.length; o--;) if (n[o].name === e) {
                    n[o].value = t;
                    break
                }
            } else n.push({name: e, value: t});
            return n.map[e] = t, this
        }
    }, pf.prototype.clone = function () {
        var e, t = new pf(this.name, this.type);
        if (e = this.attributes) {
            var n = [];
            n.map = {};
            for (var r = 0, o = e.length; r < o; r++) {
                var i = e[r];
                "id" !== i.name && (n[n.length] = {
                    name: i.name,
                    value: i.value
                }, n.map[i.name] = i.value)
            }
            t.attributes = n
        }
        return t.value = this.value, t.shortEnded = this.shortEnded, t
    }, pf.prototype.wrap = function (e) {
        return this.parent.insert(e, this), e.append(this), this
    }, pf.prototype.unwrap = function () {
        for (var e = this.firstChild; e;) {
            var t = e.next;
            this.insert(e, this, !0), e = t
        }
        this.remove()
    }, pf.prototype.remove = function () {
        var e = this.parent, t = this.next, n = this.prev;
        return e && (e.firstChild === this ? (e.firstChild = t) && (t.prev = null) : n.next = t, e.lastChild === this ? (e.lastChild = n) && (n.next = null) : t.prev = n, this.parent = this.next = this.prev = null), this
    }, pf.prototype.append = function (e) {
        e.parent && e.remove();
        var t = this.lastChild;
        return t ? ((t.next = e).prev = t, this.lastChild = e) : this.lastChild = this.firstChild = e, e.parent = this, e
    }, pf.prototype.insert = function (e, t, n) {
        e.parent && e.remove();
        var r = t.parent || this;
        return n ? (t === r.firstChild ? r.firstChild = e : t.prev.next = e, e.prev = t.prev, (e.next = t).prev = e) : (t === r.lastChild ? r.lastChild = e : t.next.prev = e, e.next = t.next, (e.prev = t).next = e), e.parent = r, e
    }, pf.prototype.getAll = function (e) {
        for (var t = [], n = this.firstChild; n; n = lf(n, this)) n.name === e && t.push(n);
        return t
    }, pf.prototype.empty = function () {
        if (this.firstChild) {
            for (var e = [], t = this.firstChild; t; t = lf(t, this)) e.push(t);
            for (var n = e.length; n--;) (t = e[n]).parent = t.firstChild = t.lastChild = t.next = t.prev = null
        }
        return this.firstChild = this.lastChild = null, this
    }, pf.prototype.isEmpty = function (e, t, n) {
        void 0 === t && (t = {});
        var r = this.firstChild;
        if (r) do {
            if (1 === r.type) {
                if (r.attr("data-mce-bogus")) continue;
                if (e[r.name]) return !1;
                for (var o = r.attributes.length; o--;) {
                    var i = r.attributes[o].name;
                    if ("name" === i || 0 === i.indexOf("data-mce-bookmark")) return !1
                }
            }
            if (8 === r.type) return !1;
            if (3 === r.type && !ff(r)) return !1;
            if (3 === r.type && r.parent && t[r.parent.name] && hf.test(r.value)) return !1;
            if (n && n(r)) return !1
        } while (r = lf(r, this));
        return !0
    }, pf.prototype.walk = function (e) {
        return lf(this, null, e)
    }, pf);

    function pf(e, t) {
        this.name = e, 1 === (this.type = t) && (this.attributes = [], this.attributes.map = {})
    }

    function vf(e, t, n) {
        var r, o, i, a, u = 1;
        for (a = e.getShortEndedElements(), (i = /<([!?\/])?([A-Za-z0-9\-_\:\.]+)((?:\s+[^"\'>]+(?:(?:"[^"]*")|(?:\'[^\']*\')|[^>]*))*|\/|\s+)>/g).lastIndex = r = n; o = i.exec(t);) {
            if (r = i.lastIndex, "/" === o[1]) u--; else if (!o[1]) {
                if (o[2] in a) continue;
                u++
            }
            if (0 === u) break
        }
        return r
    }

    function yf(e, t) {
        var n = e.exec(t);
        if (n) {
            var r = n[1], o = n[2];
            return "string" == typeof r && "data-mce-bogus" === r.toLowerCase() ? o : null
        }
        return null
    }

    function bf(q, $) {
        void 0 === $ && ($ = Lr());

        function e() {
        }

        !1 !== (q = q || {}).fix_self_closing && (q.fix_self_closing = !0);
        var W = q.comment ? q.comment : e, K = q.cdata ? q.cdata : e,
            X = q.text ? q.text : e, Y = q.start ? q.start : e,
            G = q.end ? q.end : e, Z = q.pi ? q.pi : e,
            J = q.doctype ? q.doctype : e;
        return {
            parse: function (i, e) {
                void 0 === e && (e = "html");

                function t(e) {
                    var t, n;
                    for (t = B.length; t-- && B[t].name !== e;) ;
                    if (0 <= t) {
                        for (n = B.length - 1; t <= n; n--) (e = B[n]).valid && G(e.name);
                        B.length = t
                    }
                }

                function a(e) {
                    "" !== e && (">" === e.charAt(0) && (e = " " + e), q.allow_conditional_comments || "[if" !== e.substr(0, 3).toLowerCase() || (e = " " + e), W(e))
                }

                function n(e, t) {
                    var n = e || "", r = !ce(n, "--"), o = function (e, t, n) {
                        void 0 === n && (n = 0);
                        var r = e.toLowerCase();
                        if (-1 !== r.indexOf("[if ", n) && function (e, t) {
                            return /^\s*\[if [\w\W]+\]>.*<!\[endif\](--!?)?>/.test(e.substr(t))
                        }(r, n)) {
                            var o = r.indexOf("[endif]", n);
                            return r.indexOf(">", o)
                        }
                        if (t) {
                            var i = r.indexOf(">", n);
                            return -1 !== i ? i : r.length
                        }
                        var a = /--!?>/;
                        a.lastIndex = n;
                        var u = a.exec(e);
                        return u ? u.index + u[0].length : r.length
                    }(i, r, t);
                    return e = i.substr(t, o - t), a(r ? n + e : e), o + 1
                }

                function r(e, t, n, r, o) {
                    var i, a;
                    if (n = (t = t.toLowerCase()) in p ? t : L(n || r || o || ""), y && !h && !1 === function (e) {
                        return 0 === e.indexOf("data-") || 0 === e.indexOf("aria-")
                    }(t)) {
                        if (!(i = z[t]) && E) {
                            for (a = E.length; a-- && !(i = E[a]).pattern.test(t);) ;
                            -1 === a && (i = null)
                        }
                        if (!i) return;
                        if (i.validValues && !(n in i.validValues)) return
                    }
                    if (V[t] && !q.allow_script_urls) {
                        var u = n.replace(/[\s\u0000-\u001F]+/g, "");
                        try {
                            u = decodeURIComponent(u)
                        } catch (c) {
                            u = unescape(u)
                        }
                        if (I.test(u)) return;
                        if (function (e, t) {
                            return !e.allow_html_data_urls && (/^data:image\//i.test(t) ? !1 === e.allow_svg_data_urls && /^data:image\/svg\+xml/i.test(t) : /^data:/i.test(t))
                        }(q, u)) return
                    }
                    h && (t in V || 0 === t.indexOf("on")) || (s.map[t] = n, s.push({
                        name: t,
                        value: n
                    }))
                }

                var o, u, c, s, l, f, d, h, m, g, p, v, y, b, C, w, x, z, E, N,
                    S, k, T, A, M, R, D, _, O, H = 0, B = [], P = 0,
                    L = kr.decode,
                    V = Jn.makeMap("src,href,data,background,formaction,poster,xlink:href"),
                    I = /((java|vb)script|mhtml):/i, F = "html" === e ? 0 : 1;
                for (M = new RegExp("<(?:(?:!--([\\w\\W]*?)--!?>)|(?:!\\[CDATA\\[([\\w\\W]*?)\\]\\]>)|(?:![Dd][Oo][Cc][Tt][Yy][Pp][Ee]([\\w\\W]*?)>)|(?:!(--)?)|(?:\\?([^\\s\\/<>]+) ?([\\w\\W]*?)[?/]>)|(?:\\/([A-Za-z][A-Za-z0-9\\-_\\:\\.]*)>)|(?:([A-Za-z][A-Za-z0-9\\-_\\:\\.]*)((?:\\s+[^\"'>]+(?:(?:\"[^\"]*\")|(?:'[^']*')|[^>]*))*|\\/|\\s+)>))", "g"), R = /([\w:\-]+)(?:\s*=\s*(?:(?:\"((?:[^\"])*)\")|(?:\'((?:[^\'])*)\')|([^>\s]+)))?/g, g = $.getShortEndedElements(), A = q.self_closing_elements || $.getSelfClosingElements(), p = $.getBoolAttrs(), y = q.validate, m = q.remove_internals, O = q.fix_self_closing, D = $.getSpecialElements(), T = i + ">"; o = M.exec(T);) {
                    var U = o[0];
                    if (H < o.index && X(L(i.substr(H, o.index - H))), u = o[7]) ":" === (u = u.toLowerCase()).charAt(0) && (u = u.substr(1)), t(u); else if (u = o[8]) {
                        if (o.index + U.length > i.length) {
                            X(L(i.substr(o.index))), H = o.index + U.length;
                            continue
                        }
                        ":" === (u = u.toLowerCase()).charAt(0) && (u = u.substr(1)), v = u in g, O && A[u] && 0 < B.length && B[B.length - 1].name === u && t(u);
                        var j = yf(R, o[9]);
                        if (null !== j) {
                            if ("all" === j) {
                                H = vf($, i, M.lastIndex), M.lastIndex = H;
                                continue
                            }
                            C = !1
                        }
                        if (!y || (b = $.getElementRule(u))) {
                            if (C = !0, y && (z = b.attributes, E = b.attributePatterns), (x = o[9]) ? ((h = -1 !== x.indexOf("data-mce-type")) && m && (C = !1), (s = []).map = {}, x.replace(R, r)) : (s = []).map = {}, y && !h) {
                                if (N = b.attributesRequired, S = b.attributesDefault, k = b.attributesForced, b.removeEmptyAttrs && !s.length && (C = !1), k) for (l = k.length; l--;) d = (w = k[l]).name, "{$uid}" === (_ = w.value) && (_ = "mce_" + P++), s.map[d] = _, s.push({
                                    name: d,
                                    value: _
                                });
                                if (S) for (l = S.length; l--;) (d = (w = S[l]).name) in s.map || ("{$uid}" === (_ = w.value) && (_ = "mce_" + P++), s.map[d] = _, s.push({
                                    name: d,
                                    value: _
                                }));
                                if (N) {
                                    for (l = N.length; l-- && !(N[l] in s.map);) ;
                                    -1 === l && (C = !1)
                                }
                                if (w = s.map["data-mce-bogus"]) {
                                    if ("all" === w) {
                                        H = vf($, i, M.lastIndex), M.lastIndex = H;
                                        continue
                                    }
                                    C = !1
                                }
                            }
                            C && Y(u, s, v)
                        } else C = !1;
                        if (c = D[u]) {
                            c.lastIndex = H = o.index + U.length, H = (o = c.exec(i)) ? (C && (f = i.substr(H, o.index - H)), o.index + o[0].length) : (f = i.substr(H), i.length), C && (0 < f.length && X(f, !0), G(u)), M.lastIndex = H;
                            continue
                        }
                        v || (x && x.indexOf("/") === x.length - 1 ? C && G(u) : B.push({
                            name: u,
                            valid: C
                        }))
                    } else if (u = o[1]) a(u); else if (u = o[2]) {
                        if (!(1 == F || q.preserve_cdata || 0 < B.length && $.isValidChild(B[B.length - 1].name, "#cdata"))) {
                            H = n("", o.index + 2), M.lastIndex = H;
                            continue
                        }
                        K(u)
                    } else if (u = o[3]) J(u); else {
                        if ((u = o[4]) || "<!" === U) {
                            H = n(u, o.index + U.length), M.lastIndex = H;
                            continue
                        }
                        if (u = o[5]) {
                            if (1 != F) {
                                H = n("?", o.index + 2), M.lastIndex = H;
                                continue
                            }
                            Z(u, o[6])
                        }
                    }
                    H = o.index + U.length
                }
                for (H < i.length && X(L(i.substr(H))), l = B.length - 1; 0 <= l; l--) (u = B[l]).valid && G(u.name)
            }
        }
    }

    (bf = bf || {}).findEndTag = vf;

    function Cf(e, t) {
        var n, r, o, i, a, u = t, c = /<(\w+) [^>]*data-mce-bogus="all"[^>]*>/g,
            s = e.schema;
        for (u = function (e, t) {
            var n = new RegExp(["\\s?(" + e.join("|") + ')="[^"]+"'].join("|"), "gi");
            return t.replace(n, "")
        }(e.getTempAttrs(), u), a = s.getShortEndedElements(); i = c.exec(u);) r = c.lastIndex, o = i[0].length, n = a[i[1]] ? r : hd.findEndTag(s, u, r), u = u.substring(0, r - o) + u.substring(n), c.lastIndex = r - o;
        return gu.trim(u)
    }

    function wf(e, t, n) {
        var r;
        if (t.format = t.format ? t.format : "html", t.get = !0, t.getInner = !0, t.no_events || e.fire("BeforeGetContent", t), "raw" === t.format) r = Jn.trim(md.trimExternal(e.serializer, n.innerHTML)); else if ("text" === t.format) r = gu.trim(n.innerText || n.textContent); else {
            if ("tree" === t.format) return e.serializer.serialize(n, t);
            r = function (e, t) {
                var n = us(e),
                    r = new RegExp("^(<" + n + "[^>]*>(&nbsp;|&#160;|\\s|\xa0|<br \\/>|)<\\/" + n + ">[\r\n]*|<br \\/>[\r\n]*)$");
                return t.replace(r, "")
            }(e, e.serializer.serialize(n, t))
        }
        return "text" === t.format || mr(at.fromDom(n)) ? t.content = r : t.content = Jn.trim(r), t.no_events || e.fire("GetContent", t), t.content
    }

    function xf(e) {
        var u, c, s, l, f, d = [];
        return u = (e = e || {}).indent, c = gd(e.indent_before || ""), s = gd(e.indent_after || ""), l = kr.getEncodeFunc(e.entity_encoding || "raw", e.entities), f = "html" === e.element_format, {
            start: function (e, t, n) {
                var r, o, i, a;
                if (u && c[e] && 0 < d.length && 0 < (a = d[d.length - 1]).length && "\n" !== a && d.push("\n"), d.push("<", e), t) for (r = 0, o = t.length; r < o; r++) i = t[r], d.push(" ", i.name, '="', l(i.value, !0), '"');
                d[d.length] = !n || f ? ">" : " />", n && u && s[e] && 0 < d.length && 0 < (a = d[d.length - 1]).length && "\n" !== a && d.push("\n")
            }, end: function (e) {
                var t;
                d.push("</", e, ">"), u && s[e] && 0 < d.length && 0 < (t = d[d.length - 1]).length && "\n" !== t && d.push("\n")
            }, text: function (e, t) {
                0 < e.length && (d[d.length] = t ? e : l(e))
            }, cdata: function (e) {
                d.push("<![CDATA[", e, "]]>")
            }, comment: function (e) {
                d.push("\x3c!--", e, "--\x3e")
            }, pi: function (e, t) {
                t ? d.push("<?", e, " ", l(t), "?>") : d.push("<?", e, "?>"), u && d.push("\n")
            }, doctype: function (e) {
                d.push("<!DOCTYPE", e, ">", u ? "\n" : "")
            }, reset: function () {
                d.length = 0
            }, getContent: function () {
                return d.join("").replace(/\n$/, "")
            }
        }
    }

    function zf(t, m) {
        void 0 === m && (m = Lr());
        var g = xf(t);
        return (t = t || {}).validate = !("validate" in t) || t.validate, {
            serialize: function (e) {
                var f, d;
                d = t.validate, f = {
                    3: function (e) {
                        g.text(e.value, e.raw)
                    }, 8: function (e) {
                        g.comment(e.value)
                    }, 7: function (e) {
                        g.pi(e.name, e.value)
                    }, 10: function (e) {
                        g.doctype(e.value)
                    }, 4: function (e) {
                        g.cdata(e.value)
                    }, 11: function (e) {
                        if (e = e.firstChild) for (; h(e), e = e.next;) ;
                    }
                }, g.reset();
                var h = function (e) {
                    var t, n, r, o, i, a, u, c, s, l = f[e.type];
                    if (l) l(e); else {
                        if (t = e.name, n = e.shortEnded, r = e.attributes, d && r && 1 < r.length && ((a = []).map = {}, s = m.getElementRule(e.name))) {
                            for (u = 0, c = s.attributesOrder.length; u < c; u++) (o = s.attributesOrder[u]) in r.map && (i = r.map[o], a.map[o] = i, a.push({
                                name: o,
                                value: i
                            }));
                            for (u = 0, c = r.length; u < c; u++) (o = r[u].name) in a.map || (i = r.map[o], a.map[o] = i, a.push({
                                name: o,
                                value: i
                            }));
                            r = a
                        }
                        if (g.start(e.name, r, n), !n) {
                            if (e = e.firstChild) for (; h(e), e = e.next;) ;
                            g.end(t)
                        }
                    }
                };
                return 1 !== e.type || t.inner ? f[11](e) : h(e), g.getContent()
            }
        }
    }

    function Ef(e, t, n) {
        var r = function (e, n, t) {
            var r = {}, o = {}, i = [];
            for (var a in t.firstChild && pd(t.firstChild, function (t) {
                U(e, function (e) {
                    e.name === t.name && (r[e.name] ? r[e.name].nodes.push(t) : r[e.name] = {
                        filter: e,
                        nodes: [t]
                    })
                }), U(n, function (e) {
                    "string" == typeof t.attr(e.name) && (o[e.name] ? o[e.name].nodes.push(t) : o[e.name] = {
                        filter: e,
                        nodes: [t]
                    })
                })
            }), r) r.hasOwnProperty(a) && i.push(r[a]);
            for (var u in o) o.hasOwnProperty(u) && i.push(o[u]);
            return i
        }(e, t, n);
        U(r, function (t) {
            U(t.filter.callbacks, function (e) {
                e(t.nodes, t.filter.name, {})
            })
        })
    }

    function Nf(e) {
        var t = ye(e).dom();
        return e.dom() === t.activeElement
    }

    function Sf(e) {
        var t = e !== undefined ? e.dom() : j.document;
        return D.from(t.activeElement).map(at.fromDom)
    }

    function kf(e, t) {
        var n = Vt(t) ? rf(t).length : Ne(t).length + 1;
        return n < e ? n : e < 0 ? 0 : e
    }

    function Tf(e) {
        return xd.range(e.start(), kf(e.soffset(), e.start()), e.finish(), kf(e.foffset(), e.finish()))
    }

    function Af(e, t) {
        return !en.isRestrictedNode(t.dom()) && (Ht(e, t) || ve(e, t))
    }

    function Mf(t) {
        return function (e) {
            return Af(t, e.start()) && Af(t, e.finish())
        }
    }

    function Rf(e) {
        return !0 === e.inline || zd.isIE()
    }

    function Df(e) {
        return xd.range(at.fromDom(e.startContainer), e.startOffset, at.fromDom(e.endContainer), e.endOffset)
    }

    function _f(e) {
        var t = e.getSelection();
        return (t && 0 !== t.rangeCount ? D.from(t.getRangeAt(0)) : D.none()).map(Df)
    }

    function Of(e) {
        var t = be(e);
        return _f(t.dom()).filter(Mf(e))
    }

    function Hf(e, t) {
        return D.from(t).filter(Mf(e)).map(Tf)
    }

    function Bf(e) {
        var t = j.document.createRange();
        try {
            return t.setStart(e.start().dom(), e.soffset()), t.setEnd(e.finish().dom(), e.foffset()), D.some(t)
        } catch (n) {
            return D.none()
        }
    }

    function Pf(t) {
        return (t.bookmark ? t.bookmark : D.none()).bind(function (e) {
            return Hf(at.fromDom(t.getBody()), e)
        }).bind(Bf)
    }

    function Lf(t, e) {
        de().browser.isIE() ? function (e) {
            e.on("focusout", function () {
                Ed(e)
            })
        }(t) : function (e, t) {
            e.on("mouseup touchend", function (e) {
                t.throttle()
            })
        }(t, e), t.on("keyup NodeChange", function (e) {
            !function (e) {
                return "nodechange" === e.type && e.selectionChange
            }(e) && Ed(t)
        })
    }

    function Vf(e) {
        return Td.isEditorUIElement(e)
    }

    function If(t, e) {
        var n = t ? t.settings.custom_ui_selector : "";
        return null !== Md.getParent(e, function (e) {
            return Vf(e) || !!n && t.dom.is(e, n)
        })
    }

    function Ff(r, e) {
        var t = e.editor;
        Ad(t), t.on("focusin", function () {
            var e = r.focusedEditor;
            e !== this && (e && e.fire("blur", {focusedEditor: this}), r.setActive(this), (r.focusedEditor = this).fire("focus", {blurredEditor: e}), this.focus(!0))
        }), t.on("focusout", function () {
            var t = this;
            Ln.setEditorTimeout(t, function () {
                var e = r.focusedEditor;
                If(t, function () {
                    try {
                        return j.document.activeElement
                    } catch (e) {
                        return j.document.body
                    }
                }()) || e !== t || (t.fire("blur", {focusedEditor: null}), r.focusedEditor = null)
            })
        }), ld || (ld = function (e) {
            var t, n = r.activeEditor;
            t = e.target, n && t.ownerDocument === j.document && (t === j.document.body || If(n, t) || r.focusedEditor !== n || (n.fire("blur", {focusedEditor: null}), r.focusedEditor = null))
        }, Md.bind(j.document, "focusin", ld))
    }

    function Uf(e, t) {
        e.focusedEditor === t.editor && (e.focusedEditor = null), e.activeEditor || (Md.unbind(j.document, "focusin", ld), ld = null)
    }

    function jf(t, e) {
        return function (e) {
            return e.collapsed ? D.from(eu(e.startContainer, e.startOffset)).map(at.fromDom) : D.none()
        }(e).bind(function (e) {
            return dr(e) ? D.some(e) : !1 === Ht(t, e) ? D.some(t) : D.none()
        })
    }

    function qf(t, e) {
        jf(at.fromDom(t.getBody()), e).bind(function (e) {
            return ql.firstPositionIn(e.dom())
        }).fold(function () {
            t.selection.normalize()
        }, function (e) {
            return t.selection.setRng(e.toRange())
        })
    }

    function $f(e) {
        if (e.setActive) try {
            e.setActive()
        } catch (t) {
            e.focus()
        } else e.focus()
    }

    function Wf(e) {
        return Nf(e) || function (t) {
            return Sf(ye(t)).filter(function (e) {
                return t.dom().contains(e.dom())
            })
        }(e).isSome()
    }

    function Kf(e) {
        return e.inline ? function (e) {
            var t = e.getBody();
            return t && Wf(at.fromDom(t))
        }(e) : function (e) {
            return e.iframeElement && Nf(at.fromDom(e.iframeElement))
        }(e)
    }

    function Xf(e) {
        return e instanceof gf
    }

    function Yf(e, t) {
        e.dom.setHTML(e.getBody(), t), function (r) {
            Bd(r) && ql.firstPositionIn(r.getBody()).each(function (e) {
                var t = e.getNode(),
                    n = en.isTable(t) ? ql.firstPositionIn(t).getOr(e) : e;
                r.selection.setRng(n.toRange())
            })
        }(e)
    }

    function Gf(t, n, r) {
        return void 0 === r && (r = {}), r.format = r.format ? r.format : "html", r.set = !0, r.content = Xf(n) ? "" : n, Xf(n) || r.no_events || (t.fire("BeforeSetContent", r), n = r.content), D.from(t.getBody()).fold($(n), function (e) {
            return Xf(n) ? function (e, t, n, r) {
                Ef(e.parser.getNodeFilters(), e.parser.getAttributeFilters(), n);
                var o = zf({validate: e.validate}, e.schema).serialize(n);
                return r.content = mr(at.fromDom(t)) ? o : Jn.trim(o), Yf(e, r.content), r.no_events || e.fire("SetContent", r), n
            }(t, e, n, r) : function (e, t, n, r) {
                var o, i;
                return 0 === n.length || /^\s+$/.test(n) ? (i = '<br data-mce-bogus="1">', "TABLE" === t.nodeName ? n = "<tr><td>" + i + "</td></tr>" : /^(UL|OL)$/.test(t.nodeName) && (n = "<li>" + i + "</li>"), n = (o = us(e)) && e.schema.isValidChild(t.nodeName.toLowerCase(), o.toLowerCase()) ? (n = i, e.dom.createHTML(o, e.settings.forced_root_block_attrs, n)) : n || '<br data-mce-bogus="1">', Yf(e, n), e.fire("SetContent", r)) : ("raw" !== r.format && (n = zf({validate: e.validate}, e.schema).serialize(e.parser.parse(n, {
                    isRootContent: !0,
                    insert: !0
                }))), r.content = mr(at.fromDom(t)) ? n : Jn.trim(n), Yf(e, r.content), r.no_events || e.fire("SetContent", r)), r.content
            }(t, e, n, r)
        })
    }

    function Zf(e) {
        return D.from(e).each(function (e) {
            return e.destroy()
        })
    }

    function Jf(e) {
        if (!e.removed) {
            var t = e._selectionOverrides, n = e.editorUpload, r = e.getBody(),
                o = e.getElement();
            r && e.save({is_removing: !0}), e.removed = !0, e.unbindAllNativeEvents(), e.hasHiddenInput && o && Ld.remove(o.nextSibling), function (e) {
                e.fire("remove")
            }(e), e.editorManager.remove(e), !e.inline && r && function (e) {
                Ld.setStyle(e.id, "display", e.orgDisplay)
            }(e), function (e) {
                e.fire("detach")
            }(e), Ld.remove(e.getContainer()), Zf(t), Zf(n), e.destroy()
        }
    }

    function Qf(e, t) {
        var n = e.selection, r = e.dom;
        e.destroyed || (t || e.removed ? (t || (e.editorManager.off("beforeunload", e._beforeUnload), e.theme && e.theme.destroy && e.theme.destroy(), Zf(n), Zf(r)), function (e) {
            var t = e.formElement;
            t && (t._mceOldSubmit && (t.submit = t._mceOldSubmit, t._mceOldSubmit = null), Ld.unbind(t, "submit reset", e.formEventDelegate))
        }(e), function (e) {
            e.contentAreaContainer = e.formElement = e.container = e.editorContainer = null, e.bodyElement = e.contentDocument = e.contentWindow = null, e.iframeElement = e.targetElm = null, e.selection && (e.selection = e.selection.win = e.selection.dom = e.selection.dom.doc = null)
        }(e), e.destroyed = !0) : e.remove())
    }

    function ed(e) {
        var t = O(e) ? e.join(" ") : e, n = X(K(t) ? t.split(" ") : [], se);
        return G(n, function (e) {
            return 0 < e.length
        })
    }

    function td(e, t) {
        return e.sections().hasOwnProperty(t)
    }

    function nd(e, t) {
        return M(e, "toolbar_mode").orThunk(function () {
            return M(e, "toolbar_drawer").map(function (e) {
                return !1 === e ? "wrap" : e
            })
        }).getOr(t)
    }

    function rd(e, t, n, r) {
        var o = ed(n.forced_plugins), i = ed(r.plugins), a = function (e, t) {
            return td(e, t) ? e.sections()[t] : {}
        }(t, "mobile"), u = a.plugins ? ed(a.plugins) : i, c = function (e, t) {
            return [].concat(ed(e)).concat(ed(t))
        }(o, e && function (e, t, n) {
            var r = e.sections();
            return td(e, t) && r[t].theme === n
        }(t, "mobile", "mobile") ? function (e) {
            return G(e, d(h, Wd))
        }(u) : e && td(t, "mobile") ? u : i);
        return Jn.extend(r, {plugins: c.join(" ")})
    }

    function od(e, t, n, r, o) {
        var i = e ? {
                mobile: function (e, t) {
                    var n = {
                        resize: !1,
                        toolbar_mode: nd(e, "scrolling"),
                        toolbar_sticky: !1
                    };
                    return ne(ne(ne({}, Kd), n), t ? {menubar: !1} : {})
                }(o, t)
            } : {}, a = function (n, e) {
                var t = A(e, function (e, t) {
                    return h(n, t)
                });
                return Fd(t.t, t.f)
            }(["mobile"], Id(i, o)),
            u = Jn.extend(n, r, a.settings(), function (e, t) {
                return e && td(t, "mobile")
            }(e, a) ? function (e, t, n) {
                void 0 === n && (n = {});
                var r = e.sections(), o = r.hasOwnProperty(t) ? r[t] : {};
                return Jn.extend({}, n, o)
            }(a, "mobile") : {}, {
                validate: !0,
                external_plugins: function (e, t) {
                    var n = t.external_plugins ? t.external_plugins : {};
                    return e && e.external_plugins ? Jn.extend({}, e.external_plugins, n) : n
                }(r, a.settings())
            });
        return rd(e, a, r, u)
    }

    function id(e, t, n, r, o) {
        var i = function (e, t, n, r, o) {
            var i = {
                id: t,
                theme: "silver",
                toolbar_mode: nd(e, "floating"),
                plugins: "",
                document_base_url: n,
                add_form_submit_trigger: !0,
                submit_patch: !0,
                add_unload_trigger: !0,
                convert_urls: !0,
                relative_urls: !0,
                remove_script_host: !0,
                object_resizing: !0,
                doctype: "<!DOCTYPE html>",
                visual: !0,
                font_size_legacy_values: "xx-small,small,medium,large,x-large,xx-large,300%",
                forced_root_block: "p",
                hidden_input: !0,
                inline_styles: !0,
                convert_fonts_to_spans: !0,
                indent: !0,
                indent_before: "p,h1,h2,h3,h4,h5,h6,blockquote,div,title,style,pre,script,td,th,ul,ol,li,dl,dt,dd,area,table,thead,tfoot,tbody,tr,section,summary,article,hgroup,aside,figure,figcaption,option,optgroup,datalist",
                indent_after: "p,h1,h2,h3,h4,h5,h6,blockquote,div,title,style,pre,script,td,th,ul,ol,li,dl,dt,dd,area,table,thead,tfoot,tbody,tr,section,summary,article,hgroup,aside,figure,figcaption,option,optgroup,datalist",
                entity_encoding: "named",
                url_converter: o.convertURL,
                url_converter_scope: o
            };
            return ne(ne({}, i), r ? Kd : {})
        }(o, t, n, jd, e);
        return od(qd || $d, qd, i, r, o)
    }

    function ad(e, t, n) {
        return D.from(t.settings[n]).filter(e)
    }

    function ud(e, t, n, r) {
        var o = t in e.settings ? e.settings[t] : n;
        return "hash" === r ? function (e) {
            var n = {};
            return "string" == typeof e ? U(0 < e.indexOf("=") ? e.split(/[;,](?![^=;,]*(?:[;,]|$))/) : e.split(","), function (e) {
                var t = e.split("=");
                1 < t.length ? n[Jn.trim(t[0])] = Jn.trim(t[1]) : n[Jn.trim(t[0])] = Jn.trim(t[0])
            }) : n = e, n
        }(o) : "string" === r ? ad(K, e, t).getOr(n) : "number" === r ? ad(L, e, t).getOr(n) : "boolean" === r ? ad(B, e, t).getOr(n) : "object" === r ? ad(_, e, t).getOr(n) : "array" === r ? ad(O, e, t).getOr(n) : "string[]" === r ? ad(function (t) {
            return function (e) {
                return O(e) && b(e, t)
            }
        }(K), e, t).getOr(n) : "function" === r ? ad(P, e, t).getOr(n) : o
    }

    function cd(e, t) {
        return t.dom()[e]
    }

    function sd(e, t) {
        return parseInt(Ze(t, e), 10)
    }

    var ld, fd, dd, hd = bf, md = {trimExternal: Cf, trimInternal: Cf},
        gd = Jn.makeMap, pd = function (e, t) {
            t(e), e.firstChild && pd(e.firstChild, t), e.next && pd(e.next, t)
        }, vd = function (a) {
            if (!O(a)) throw new Error("cases must be an array");
            if (0 === a.length) throw new Error("there must be at least one case");
            var u = [], n = {};
            return U(a, function (e, r) {
                var t = J(e);
                if (1 !== t.length) throw new Error("one and only one name per case");
                var o = t[0], i = e[o];
                if (n[o] !== undefined) throw new Error("duplicate key detected:" + o);
                if ("cata" === o) throw new Error("cannot have a case named cata (sorry)");
                if (!O(i)) throw new Error("case arguments must be an array");
                u.push(o), n[o] = function () {
                    var e = arguments.length;
                    if (e !== i.length) throw new Error("Wrong number of arguments to case " + o + ". Expected " + i.length + " (" + i + "), got " + e);
                    for (var n = new Array(e), t = 0; t < n.length; t++) n[t] = arguments[t];
                    return {
                        fold: function () {
                            if (arguments.length !== a.length) throw new Error("Wrong number of arguments to fold. Expected " + a.length + ", got " + arguments.length);
                            return arguments[r].apply(null, n)
                        }, match: function (e) {
                            var t = J(e);
                            if (u.length !== t.length) throw new Error("Wrong number of arguments to match. Expected: " + u.join(",") + "\nActual: " + t.join(","));
                            if (!b(u, function (e) {
                                return h(t, e)
                            })) throw new Error("Not all branches were specified when using match. Specified: " + t.join(", ") + "\nRequired: " + u.join(", "));
                            return e[o].apply(null, n)
                        }, log: function (e) {
                            j.console.log(e, {
                                constructors: u,
                                constructor: o,
                                params: n
                            })
                        }
                    }
                }
            }), n
        }, yd = {create: he("start", "soffset", "finish", "foffset")},
        bd = vd([{before: ["element"]}, {on: ["element", "offset"]}, {after: ["element"]}]),
        Cd = (bd.before, bd.on, bd.after, function (e) {
            return e.fold(W, W, W)
        }),
        wd = vd([{domRange: ["rng"]}, {relative: ["startSitu", "finishSitu"]}, {exact: ["start", "soffset", "finish", "foffset"]}]),
        xd = {
            domRange: wd.domRange,
            relative: wd.relative,
            exact: wd.exact,
            exactFromRange: function (e) {
                return wd.exact(e.start(), e.soffset(), e.finish(), e.foffset())
            },
            getWin: function (e) {
                var t = function (e) {
                    return e.match({
                        domRange: function (e) {
                            return at.fromDom(e.startContainer)
                        }, relative: function (e, t) {
                            return Cd(e)
                        }, exact: function (e, t, n, r) {
                            return e
                        }
                    })
                }(e);
                return be(t)
            },
            range: yd.create
        }, zd = de().browser, Ed = function (e) {
            var t = Rf(e) ? Of(at.fromDom(e.getBody())) : D.none();
            e.bookmark = t.isSome() ? t : e.bookmark
        }, Nd = function (e, t) {
            var n = at.fromDom(e.getBody()),
                r = (Rf(e) ? D.from(t) : D.none()).map(Df).filter(Mf(n));
            e.bookmark = r.isSome() ? r : e.bookmark
        }, Sd = function (t) {
            Pf(t).each(function (e) {
                t.selection.setRng(e)
            })
        }, kd = Pf, Td = {
            isEditorUIElement: function (e) {
                var t = e.className.toString();
                return -1 !== t.indexOf("tox-") || -1 !== t.indexOf("mce-")
            }
        }, Ad = function (e) {
            var t = da(function () {
                Ed(e)
            }, 0);
            e.on("init", function () {
                e.inline && function (e, t) {
                    function n() {
                        t.throttle()
                    }

                    ea.DOM.bind(j.document, "mouseup", n), e.on("remove", function () {
                        ea.DOM.unbind(j.document, "mouseup", n)
                    })
                }(e, t), Lf(e, t)
            }), e.on("remove", function () {
                t.cancel()
            })
        }, Md = ea.DOM, Rd = function (e) {
            e.on("AddEditor", d(Ff, e)), e.on("RemoveEditor", d(Uf, e))
        }, Dd = function (e) {
            var t = e.classList;
            return t !== undefined && (t.contains("tox-edit-area") || t.contains("tox-edit-area__iframe") || t.contains("mce-content-body"))
        }, _d = If, Od = function (e) {
            return e.editorManager.setActive(e)
        }, Hd = function (e, t) {
            e.removed || (t ? Od(e) : function (t) {
                var e = t.selection, n = t.getBody(), r = e.getRng();
                t.quirks.refreshContentEditable(), t.bookmark !== undefined && !1 === Kf(t) && kd(t).each(function (e) {
                    t.selection.setRng(e), r = e
                });
                var o = function (t, e) {
                    return t.dom.getParent(e, function (e) {
                        return "true" === t.dom.getContentEditable(e)
                    })
                }(t, e.getNode());
                if (t.$.contains(n, o)) return $f(o), qf(t, r), Od(t);
                t.inline || (Kn.opera || $f(n), t.getWin().focus()), (Kn.gecko || t.inline) && ($f(n), qf(t, r)), Od(t)
            }(e))
        }, Bd = Kf, Pd = function (e) {
            return Kf(e) || function (t) {
                return Sf().filter(function (e) {
                    return !Dd(e.dom()) && _d(t, e.dom())
                }).isSome()
            }(e)
        }, Ld = ea.DOM, Vd = Object.prototype.hasOwnProperty,
        Id = (fd = function (e, t) {
            return _(e) && _(t) ? Id(e, t) : t
        }, function () {
            for (var e = new Array(arguments.length), t = 0; t < e.length; t++) e[t] = arguments[t];
            if (0 === e.length) throw new Error("Can't merge zero objects");
            for (var n = {}, r = 0; r < e.length; r++) {
                var o = e[r];
                for (var i in o) Vd.call(o, i) && (n[i] = fd(n[i], o[i]))
            }
            return n
        }), Fd = he("sections", "settings"), Ud = de().deviceType,
        jd = Ud.isTouch(), qd = Ud.isPhone(), $d = Ud.isTablet(),
        Wd = ["lists", "autolink", "autosave"],
        Kd = {table_grid: !1, object_resizing: !1, resize: !1}, Xd = (dd = {}, {
            add: function (e, t) {
                dd[e] = t
            }, get: function (e) {
                return dd[e] ? dd[e] : {icons: {}}
            }, has: function (e) {
                return te(dd, e)
            }
        }), Yd = d(cd, "clientWidth"), Gd = d(cd, "clientHeight"),
        Zd = d(sd, "margin-top"), Jd = d(sd, "margin-left"),
        Qd = function (e, t, n) {
            var r = at.fromDom(e.getBody()), o = e.inline ? r : function (e) {
                return at.fromDom(e.dom().ownerDocument.documentElement)
            }(r), i = function (e, t, n, r) {
                var o = function (e) {
                    return e.dom().getBoundingClientRect()
                }(t);
                return {
                    x: n - (e ? o.left + t.dom().clientLeft + Jd(t) : 0),
                    y: r - (e ? o.top + t.dom().clientTop + Zd(t) : 0)
                }
            }(e.inline, o, t, n);
            return function (e, t, n) {
                var r = Yd(e), o = Gd(e);
                return 0 <= t && 0 <= n && t <= r && n <= o
            }(o, i.x, i.y)
        }, eh = function (e) {
            return function (e) {
                return D.from(e).map(at.fromDom)
            }(e.inline ? e.getBody() : e.getContentAreaContainer()).map(function (e) {
                return Ht(ye(e), e)
            }).getOr(!1)
        };

    function th(n) {
        function r() {
            var e = n.theme;
            return e && e.getNotificationManagerImpl ? e.getNotificationManagerImpl() : function t() {
                function e() {
                    throw new Error("Theme did not provide a NotificationManager implementation.")
                }

                return {open: e, close: e, reposition: e, getArgs: e}
            }()
        }

        function o() {
            0 < u.length && r().reposition(u)
        }

        function i(t) {
            p(u, function (e) {
                return e === t
            }).each(function (e) {
                u.splice(e, 1)
            })
        }

        function t(t) {
            if (!n.removed && eh(n)) return g(u, function (e) {
                return function (e, t) {
                    return !(e.type !== t.type || e.text !== t.text || e.progressBar || e.timeout || t.progressBar || t.timeout)
                }(r().getArgs(e), t)
            }).getOrThunk(function () {
                n.editorManager.setActive(n);
                var e = r().open(t, function () {
                    i(e), o()
                });
                return function (e) {
                    u.push(e)
                }(e), o(), e
            })
        }

        var a, u = [];
        return (a = n).on("SkinLoaded", function () {
            var e = a.settings.service_message;
            e && t({text: e, type: "warning", timeout: 0})
        }), a.on("ResizeEditor ResizeWindow NodeChange", function () {
            Ln.requestAnimationFrame(o)
        }), a.on("remove", function () {
            U(u.slice(), function (e) {
                r().close(e)
            })
        }), {
            open: t, close: function () {
                D.from(u[0]).each(function (e) {
                    r().close(e), i(e), o()
                })
            }, getNotifications: function () {
                return u
            }
        }
    }

    var nh = xa.PluginManager, rh = xa.ThemeManager;

    function oh(n) {
        function r() {
            var e = n.theme;
            return e && e.getWindowManagerImpl ? e.getWindowManagerImpl() : function t() {
                function e() {
                    throw new Error("Theme did not provide a WindowManager implementation.")
                }

                return {
                    open: e,
                    openUrl: e,
                    alert: e,
                    confirm: e,
                    close: e,
                    getParams: e,
                    setParams: e
                }
            }()
        }

        function o(e, t) {
            return function () {
                return t ? t.apply(e, arguments) : undefined
            }
        }

        function i(e) {
            c.push(e), function (e) {
                n.fire("OpenWindow", {dialog: e})
            }(e)
        }

        function a(t) {
            !function (e) {
                n.fire("CloseWindow", {dialog: e})
            }(t), 0 === (c = G(c, function (e) {
                return e !== t
            })).length && n.focus()
        }

        function u(e) {
            n.editorManager.setActive(n), Ed(n);
            var t = e();
            return i(t), t
        }

        var c = [];
        return n.on("remove", function () {
            U(c, function (e) {
                r().close(e)
            })
        }), {
            open: function (e, t) {
                return u(function () {
                    return r().open(e, t, a)
                })
            }, openUrl: function (e) {
                return u(function () {
                    return r().openUrl(e, a)
                })
            }, alert: function (e, t, n) {
                r().alert(e, o(n || this, t))
            }, confirm: function (e, t, n) {
                r().confirm(e, o(n || this, t))
            }, close: function () {
                D.from(c[c.length - 1]).each(function (e) {
                    r().close(e), a(e)
                })
            }
        }
    }

    function ih(e, t) {
        e.notificationManager.open({type: "error", text: t})
    }

    function ah(e, t) {
        e._skinLoaded ? ih(e, t) : e.on("SkinLoaded", function () {
            ih(e, t)
        })
    }

    function uh(e, t, n) {
        !function (e, t, n) {
            e.fire(t, n)
        }(e, t, {message: n}), j.console.error(n)
    }

    function ch(e, t, n) {
        return n ? "Failed to load " + e + ": " + n + " from url " + t : "Failed to load " + e + " url: " + t
    }

    function sh(e) {
        e.contentCSS = e.contentCSS.concat(function (t) {
            var e = Rs(t), n = t.editorManager.baseURL + "/skins/content",
                r = "content" + t.editorManager.suffix + ".css",
                o = !0 === t.inline;
            return X(e, function (e) {
                return function (e) {
                    return /^[a-z0-9\-]+$/i.test(e)
                }(e) && !o ? n + "/" + e + "/" + r : t.documentBaseURI.toAbsolute(e)
            })
        }(e))
    }

    var lh = function (e) {
        for (var t = [], n = 1; n < arguments.length; n++) t[n - 1] = arguments[n];
        var r = j.window.console;
        r && (r.error ? r.error.apply(r, arguments) : r.log.apply(r, arguments))
    }, fh = {
        pluginLoadError: function (e, t, n) {
            uh(e, "PluginLoadError", ch("plugin", t, n))
        }, iconsLoadError: function (e, t, n) {
            uh(e, "IconsLoadError", ch("icons", t, n))
        }, languageLoadError: function (e, t, n) {
            uh(e, "LanguageLoadError", ch("language", t, n))
        }, pluginInitError: function (e, t, n) {
            var r = la.translate(["Failed to initialize plugin: {0}", t]);
            lh(r, n), ah(e, r)
        }, uploadError: function (e, t) {
            ah(e, la.translate(["Failed to upload image: {0}", t]))
        }, displayError: ah, initError: lh
    };

    function dh(e) {
        return {getBookmark: d(Wl, e), moveToBookmark: d(Kl, e)}
    }

    (dh = dh || {}).isBookmarkNode = Xl;

    function hh(r, a) {
        var u, c, s, l, f, d, h, m, g, p, v, y, i, b, C, w, x, z = a.dom,
            E = Jn.each, N = a.getDoc(), S = j.document, k = Math.abs,
            T = Math.round, A = a.getBody();

        function M(e) {
            return e && ("IMG" === e.nodeName || a.dom.is(e, "figure.image"))
        }

        function n(e) {
            var t = e.target;
            !function (e, t) {
                if ("longpress" !== e.type && 0 !== e.type.indexOf("touch")) return M(e.target) && !gh(e.clientX, e.clientY, t);
                var n = e.touches[0];
                return M(e.target) && !gh(n.clientX, n.clientY, t)
            }(e, a.selection.getRng()) || e.isDefaultPrevented() || a.selection.select(t)
        }

        function R(e) {
            return a.dom.is(e, "figure.image") ? e.querySelector("img") : e
        }

        function D(e) {
            var t = Os(a);
            return !1 !== t && !Kn.iOS && ("string" != typeof t && (t = "table,img,figure.image,div"), "false" !== e.getAttribute("data-mce-resize") && (e !== a.getBody() && ge(at.fromDom(e), t)))
        }

        function _(e) {
            var t, n, r, o;
            t = e.screenX - d, n = e.screenY - h, b = t * f[2] + p, C = n * f[3] + v, b = b < 5 ? 5 : b, C = C < 5 ? 5 : C, (M(u) && !1 !== Hs(a) ? !ph.modifierPressed(e) : ph.modifierPressed(e)) && (k(t) > k(n) ? (C = T(b * y), b = T(C / y)) : (b = T(C / y), C = T(b * y))), z.setStyles(R(c), {
                width: b,
                height: C
            }), r = 0 < (r = f.startPos.x + t) ? r : 0, o = 0 < (o = f.startPos.y + n) ? o : 0, z.setStyles(s, {
                left: r,
                top: o,
                display: "block"
            }), s.innerHTML = b + " &times; " + C, f[2] < 0 && c.clientWidth <= b && z.setStyle(c, "left", m + (p - b)), f[3] < 0 && c.clientHeight <= C && z.setStyle(c, "top", g + (v - C)), (t = A.scrollWidth - w) + (n = A.scrollHeight - x) !== 0 && z.setStyles(s, {
                left: r - t,
                top: o - n
            }), i || (function (e, t, n, r) {
                e.fire("ObjectResizeStart", {target: t, width: n, height: r})
            }(a, u, p, v), i = !0)
        }

        function o(e) {
            function t(e, t) {
                if (e) do {
                    if (e === t) return !0
                } while (e = e.parentNode)
            }

            var n;
            i || a.removed || (E(z.select("img[data-mce-selected],hr[data-mce-selected]"), function (e) {
                e.removeAttribute("data-mce-selected")
            }), n = "mousedown" === e.type ? e.target : r.getNode(), t(n = z.$(n).closest("table,img,figure.image,hr")[0], A) && (V(), t(r.getStart(!0), n) && t(r.getEnd(!0), n)) ? B(n) : P())
        }

        function O(e) {
            return vh(function (e, t) {
                for (; t && t !== e;) {
                    if (yh(t) || vh(t)) return t;
                    t = t.parentNode
                }
                return null
            }(a.getBody(), e))
        }

        l = {
            nw: [0, 0, -1, -1],
            ne: [1, 0, 1, -1],
            se: [1, 1, 1, 1],
            sw: [0, 1, -1, 1]
        };
        var H = function () {
            i = !1;

            function e(e, t) {
                t && (u.style[e] || !a.schema.isValid(u.nodeName.toLowerCase(), e) ? z.setStyle(R(u), e, t) : z.setAttrib(R(u), e, t))
            }

            e("width", b), e("height", C), z.unbind(N, "mousemove", _), z.unbind(N, "mouseup", H), S !== N && (z.unbind(S, "mousemove", _), z.unbind(S, "mouseup", H)), z.remove(c), z.remove(s), B(u), function (e, t, n, r) {
                e.fire("ObjectResized", {target: t, width: n, height: r})
            }(a, u, b, C), z.setAttrib(u, "style", z.getAttrib(u, "style")), a.nodeChanged()
        }, B = function (e) {
            var t, r, o, n, i;
            P(), L(), t = z.getPos(e, A), m = t.x, g = t.y, i = e.getBoundingClientRect(), r = i.width || i.right - i.left, o = i.height || i.bottom - i.top, u !== e && (u = e, b = C = 0), n = a.fire("ObjectSelected", {target: e}), D(e) && !n.isDefaultPrevented() ? E(l, function (t, e) {
                var n;
                (n = z.get("mceResizeHandle" + e)) && z.remove(n), n = z.add(A, "div", {
                    id: "mceResizeHandle" + e,
                    "data-mce-bogus": "all",
                    "class": "mce-resizehandle",
                    unselectable: !0,
                    style: "cursor:" + e + "-resize; margin:0; padding:0"
                }), 11 === Kn.ie && (n.contentEditable = !1), z.bind(n, "mousedown", function (e) {
                    e.stopImmediatePropagation(), e.preventDefault(), function (e) {
                        d = e.screenX, h = e.screenY, p = R(u).clientWidth, v = R(u).clientHeight, y = v / p, (f = t).startPos = {
                            x: r * t[0] + m,
                            y: o * t[1] + g
                        }, w = A.scrollWidth, x = A.scrollHeight, c = u.cloneNode(!0), z.addClass(c, "mce-clonedresizable"), z.setAttrib(c, "data-mce-bogus", "all"), c.contentEditable = !1, c.unSelectabe = !0, z.setStyles(c, {
                            left: m,
                            top: g,
                            margin: 0
                        }), c.removeAttribute("data-mce-selected"), A.appendChild(c), z.bind(N, "mousemove", _), z.bind(N, "mouseup", H), S !== N && (z.bind(S, "mousemove", _), z.bind(S, "mouseup", H)), s = z.add(A, "div", {
                            "class": "mce-resize-helper",
                            "data-mce-bogus": "all"
                        }, p + " &times; " + v)
                    }(e)
                }), t.elm = n, z.setStyles(n, {
                    left: r * t[0] + m - n.offsetWidth / 2,
                    top: o * t[1] + g - n.offsetHeight / 2
                })
            }) : P(), u.setAttribute("data-mce-selected", "1")
        }, P = function () {
            var e, t;
            for (e in L(), u && u.removeAttribute("data-mce-selected"), l) (t = z.get("mceResizeHandle" + e)) && (z.unbind(t), z.remove(t))
        }, L = function () {
            for (var e in l) {
                var t = l[e];
                t.elm && (z.unbind(t.elm), delete t.elm)
            }
        }, V = function () {
            try {
                a.getDoc().execCommand("enableObjectResizing", !1, !1)
            } catch (e) {
            }
        };
        return a.on("init", function () {
            if (V(), Kn.browser.isIE() || Kn.browser.isEdge()) {
                a.on("mousedown click", function (e) {
                    var t = e.target, n = t.nodeName;
                    i || !/^(TABLE|IMG|HR)$/.test(n) || O(t) || (2 !== e.button && a.selection.select(t, "TABLE" === n), "mousedown" === e.type && a.nodeChanged())
                });
                var e = function (e) {
                    function t(e) {
                        Ln.setEditorTimeout(a, function () {
                            return a.selection.select(e)
                        })
                    }

                    if (O(e.target)) return e.preventDefault(), void t(e.target);
                    /^(TABLE|IMG|HR)$/.test(e.target.nodeName) && (e.preventDefault(), "IMG" === e.target.tagName && t(e.target))
                };
                z.bind(A, "mscontrolselect", e), a.on("remove", function () {
                    return z.unbind(A, "mscontrolselect", e)
                })
            }
            var t = Ln.throttle(function (e) {
                a.composing || o(e)
            });
            a.on("nodechange ResizeEditor ResizeWindow drop FullscreenStateChanged", t), a.on("keyup compositionend", function (e) {
                u && "TABLE" === u.nodeName && t(e)
            }), a.on("hide blur", P), a.on("contextmenu longpress", n, !0)
        }), a.on("remove", L), {
            isResizable: D,
            showResizeRect: B,
            hideResizeRect: P,
            updateResizeRect: o,
            destroy: function () {
                u = c = null
            }
        }
    }

    var mh = dh, gh = function (t, n, e) {
        if (e.collapsed) return !1;
        if (Kn.browser.isIE() && e.startOffset === e.endOffset - 1 && e.startContainer === e.endContainer) {
            var r = e.startContainer.childNodes[e.startOffset];
            if (en.isElement(r)) return C(r.getClientRects(), function (e) {
                return Ja(e, t, n)
            })
        }
        return C(e.getClientRects(), function (e) {
            return Ja(e, t, n)
        })
    }, ph = {
        BACKSPACE: 8,
        DELETE: 46,
        DOWN: 40,
        ENTER: 13,
        LEFT: 37,
        RIGHT: 39,
        SPACEBAR: 32,
        TAB: 9,
        UP: 38,
        END: 35,
        HOME: 36,
        modifierPressed: function (e) {
            return e.shiftKey || e.ctrlKey || e.altKey || this.metaKeyPressed(e)
        },
        metaKeyPressed: function (e) {
            return Kn.mac ? e.metaKey : e.ctrlKey && !e.altKey
        }
    }, vh = en.isContentEditableFalse, yh = en.isContentEditableTrue;

    function bh(e) {
        var t = at.fromDom(j.document), n = Ve(t), r = function (e, t) {
            var n = t.owner(e);
            return hm(t, n)
        }(e, mm), o = Ut(e), i = m(r, function (e, t) {
            var n = Ut(t);
            return {left: e.left + n.left(), top: e.top + n.top()}
        }, {left: 0, top: 0});
        return Ft(i.left + o.left() + n.left(), i.top + o.top() + n.top())
    }

    function Ch(e) {
        return "textarea" === He(e)
    }

    function wh(e, t) {
        var n = function (e) {
            var t = e.dom().ownerDocument, n = t.body, r = t.defaultView,
                o = t.documentElement;
            if (n === e.dom()) return Ft(n.offsetLeft, n.offsetTop);
            var i = Le(r.pageYOffset, o.scrollTop),
                a = Le(r.pageXOffset, o.scrollLeft),
                u = Le(o.clientTop, n.clientTop),
                c = Le(o.clientLeft, n.clientLeft);
            return Ut(e).translate(a - c, i - u)
        }(e), r = function (e) {
            return dm.get(e)
        }(e);
        return {element: e, bottom: n.top() + r, height: r, pos: n, cleanup: t}
    }

    function xh(e, t) {
        var n = function (e, t) {
                var n = Ne(e);
                if (0 === n.length || Ch(e)) return {element: e, offset: t};
                if (t < n.length && !Ch(n[t])) return {element: n[t], offset: 0};
                var r = n[n.length - 1];
                return Ch(r) ? {
                    element: e,
                    offset: t
                } : "img" === He(r) ? {element: r, offset: 1} : Vt(r) ? {
                    element: r,
                    offset: rf(r).length
                } : {element: r, offset: Ne(r).length}
            }(e, t),
            r = at.fromHtml('<span data-mce-bogus="all">' + gu.ZWSP + "</span>");
        return Ae(n.element, r), wh(r, function () {
            return Pt(r)
        })
    }

    function zh(n, r, o, i) {
        pm(n, function (e, t) {
            return gm(n, r, o, i)
        }, o)
    }

    function Eh(e, t, n, r, o) {
        var i = {elm: r.element.dom(), alignToTop: o};
        !function (e, t) {
            return e.fire("ScrollIntoView", t).isDefaultPrevented()
        }(e, i) && (n(t, Ve(t).top(), r, o), function (e, t) {
            e.fire("AfterScrollIntoView", t)
        }(e, i))
    }

    function Nh(e, t, n, r) {
        var o = at.fromDom(e.getDoc());
        Eh(e, o, n, function (e) {
            return wh(at.fromDom(e), u)
        }(t), r)
    }

    function Sh(e, t, n, r) {
        var o = e.pos;
        if (n) Ie(o.left(), o.top(), r); else {
            var i = o.top() - t + e.height;
            Ie(o.left(), i, r)
        }
    }

    function kh(e, t, n, r, o) {
        var i = n + t, a = r.pos.top(), u = r.bottom, c = n <= u - a;
        if (a < t) Sh(r, n, !1 !== o, e); else if (i < a) {
            Sh(r, n, c ? !1 !== o : !0 === o, e)
        } else i < u && !c && Sh(r, n, !0 === o, e)
    }

    function Th(e, t, n, r) {
        var o = e.dom().defaultView.innerHeight;
        kh(e, t, o, n, r)
    }

    function Ah(e, t, n, r) {
        var o = e.dom().defaultView.innerHeight;
        kh(e, t, o, n, r);
        var i = bh(n.element), a = qt(j.window);
        i.top() < a.y() ? Fe(n.element, !1 !== r) : i.top() > a.bottom() && Fe(n.element, !0 === r)
    }

    function Mh(e, t, n) {
        return zh(e, Th, t, n)
    }

    function Rh(e, t, n) {
        return Nh(e, t, Th, n)
    }

    function Dh(e, t, n) {
        return zh(e, Ah, t, n)
    }

    function _h(e, t, n) {
        return Nh(e, t, Ah, n)
    }

    function Oh(e) {
        return en.isContentEditableTrue(e) || en.isContentEditableFalse(e)
    }

    function Hh(e, t) {
        var n = (t || j.document).createDocumentFragment();
        return U(e, function (e) {
            n.appendChild(e.dom())
        }), at.fromDom(n)
    }

    function Bh(e, t, n) {
        return Ht(t, e) ? function (e) {
            return e.slice(0, -1)
        }(function (e, t) {
            for (var n = P(t) ? t : s, r = e.dom(), o = []; null !== r.parentNode && r.parentNode !== undefined;) {
                var i = r.parentNode, a = at.fromDom(i);
                if (o.push(a), !0 === n(a)) break;
                r = i
            }
            return o
        }(e, function (e) {
            return n(e) || ve(e, t)
        })) : []
    }

    function Ph(e, t) {
        return Bh(e, t, $(!1))
    }

    function Lh(o, e) {
        return nu(function (e) {
            var t = e.startContainer, n = e.startOffset;
            return en.isText(t) ? 0 === n ? D.some(at.fromDom(t)) : D.none() : D.from(t.childNodes[n]).map(at.fromDom)
        }(e), function (e) {
            var t = e.endContainer, n = e.endOffset;
            return en.isText(t) ? n === t.data.length ? D.some(at.fromDom(t)) : D.none() : D.from(t.childNodes[n - 1]).map(at.fromDom)
        }(e), function (e, t) {
            var n = g(zm(o), d(ve, e)), r = g(Em(o), d(ve, t));
            return n.isSome() && r.isSome()
        }).getOr(!1)
    }

    function Vh(e, t, n, r) {
        var o = n, i = new Ui(n, o), a = e.schema.getNonEmptyElements();
        do {
            if (3 === n.nodeType && 0 !== Jn.trim(n.nodeValue).length) return void (r ? t.setStart(n, 0) : t.setEnd(n, n.nodeValue.length));
            if (a[n.nodeName] && !/^(TD|TH)$/.test(n.nodeName)) return void (r ? t.setStartBefore(n) : "BR" === n.nodeName ? t.setEndBefore(n) : t.setEndAfter(n))
        } while (n = r ? i.next() : i.prev());
        "BODY" === o.nodeName && (r ? t.setStart(o, 0) : t.setEnd(o, o.childNodes.length))
    }

    function Ih(e) {
        var t = e.selection.getSel();
        return t && 0 < t.rangeCount
    }

    function Fh(e, t) {
        var n = parseInt(Ye(e, t), 10);
        return isNaN(n) ? 1 : n
    }

    function Uh(e) {
        return y(e, function (e, t) {
            return t.cells().length > e ? t.cells().length : e
        }, 0)
    }

    function jh(e, t) {
        for (var n = e.rows(), r = 0; r < n.length; r++) for (var o = n[r].cells(), i = 0; i < o.length; i++) if (ve(o[i], t)) return D.some(km(i, r));
        return D.none()
    }

    function qh(e, t, n, r, o) {
        for (var i = [], a = e.rows(), u = n; u <= o; u++) {
            var c = a[u].cells(),
                s = t < r ? c.slice(t, r + 1) : c.slice(r, t + 1);
            i.push(Sm(a[u].element(), s))
        }
        return i
    }

    function $h(e) {
        var t = [];
        if (e) for (var n = 0; n < e.rangeCount; n++) t.push(e.getRangeAt(n));
        return t
    }

    function Wh(e) {
        return G(Dm(e), hr)
    }

    function Kh(e) {
        return wa(e, "td[data-mce-selected],th[data-mce-selected]")
    }

    function Xh(e, t) {
        var n = Kh(t), r = Wh(e);
        return 0 < n.length ? n : r
    }

    function Yh(t, n) {
        return g(t, function (e) {
            return "li" === He(e) && Lh(e, n)
        }).fold($([]), function (e) {
            return function (e) {
                return g(e, function (e) {
                    return "ul" === He(e) || "ol" === He(e)
                })
            }(t).map(function (e) {
                return [at.fromTag("li"), at.fromTag(He(e))]
            }).getOr([])
        })
    }

    function Gh(e, t) {
        var n = at.fromDom(t.commonAncestorContainer), r = xm(n, e),
            o = G(r, function (e) {
                return er(e) || ar(e)
            }), i = Yh(r, t), a = o.concat(i.length ? i : function (t) {
                return lr(t) ? Ce(t).filter(sr).fold($([]), function (e) {
                    return [t, e]
                }) : sr(t) ? [t] : []
            }(n));
        return X(a, Ha)
    }

    function Zh() {
        return Hh([])
    }

    function Jh(e, t) {
        return function (e, t) {
            var n = y(t, function (e, t) {
                return Bt(t, e), t
            }, e);
            return 0 < t.length ? Hh([n]) : n
        }(at.fromDom(t.cloneContents()), Gh(e, t))
    }

    function Qh(e, o) {
        return function (e, t) {
            return ka(t, "table", d(ve, e))
        }(e, o[0]).bind(function (e) {
            var t = o[0], n = o[o.length - 1], r = Tm(e);
            return Mm(r, t, n).map(function (e) {
                return Hh([Am(e)])
            })
        }).getOrThunk(Zh)
    }

    function em(e, t, n) {
        return null !== function (e, t, n) {
            for (; e && e !== t;) {
                if (n(e)) return e;
                e = e.parentNode
            }
            return null
        }(e, t, n)
    }

    function tm(e, t, n) {
        return em(e, t, function (e) {
            return e.nodeName === n
        })
    }

    function nm(e) {
        return e && "TABLE" === e.nodeName
    }

    function rm(e, t, n) {
        for (var r = new Ui(t, e.getParent(t.parentNode, e.isBlock) || e.getRoot()); t = r[n ? "prev" : "next"]();) if (en.isBr(t)) return !0
    }

    function om(e, t, n, r, o) {
        var i, a, u = e.getRoot(), c = e.schema.getNonEmptyElements(),
            s = e.getParent(o.parentNode, e.isBlock) || u;
        if (r && en.isBr(o) && t && e.isEmpty(s)) return D.some(Ku(o.parentNode, e.nodeIndex(o)));
        for (var l, f, d = new Ui(o, s); a = d[r ? "prev" : "next"]();) {
            if ("false" === e.getContentEditableParent(a) || (f = u, Va(l = a) && !1 === em(l, f, lc))) return D.none();
            if (en.isText(a) && 0 < a.nodeValue.length) return !1 === tm(a, u, "A") ? D.some(Ku(a, r ? a.nodeValue.length : 0)) : D.none();
            if (e.isBlock(a) || c[a.nodeName.toLowerCase()]) return D.none();
            i = a
        }
        return n && i ? D.some(Ku(i, 0)) : D.none()
    }

    function im(e, t, n, r) {
        var o, i, a, u, c, s, l, f = e.getRoot(), d = !1;
        if (o = r[(n ? "start" : "end") + "Container"], i = r[(n ? "start" : "end") + "Offset"], s = en.isElement(o) && i === o.childNodes.length, u = e.schema.getNonEmptyElements(), c = n, Va(o)) return D.none();
        if (en.isElement(o) && i > o.childNodes.length - 1 && (c = !1), en.isDocument(o) && (o = f, i = 0), o === f) {
            if (c && (a = o.childNodes[0 < i ? i - 1 : 0])) {
                if (Va(a)) return D.none();
                if (u[a.nodeName] || nm(a)) return D.none()
            }
            if (o.hasChildNodes()) {
                if (i = Math.min(!c && 0 < i ? i - 1 : i, o.childNodes.length - 1), o = o.childNodes[i], i = en.isText(o) && s ? o.data.length : 0, !t && o === f.lastChild && nm(o)) return D.none();
                if (function (e, t) {
                    for (; t && t !== e;) {
                        if (en.isContentEditableFalse(t)) return !0;
                        t = t.parentNode
                    }
                    return !1
                }(f, o) || Va(o)) return D.none();
                if (o.hasChildNodes() && !1 === nm(o)) {
                    var h = new Ui(a = o, f);
                    do {
                        if (en.isContentEditableFalse(a) || Va(a)) {
                            d = !1;
                            break
                        }
                        if (en.isText(a) && 0 < a.nodeValue.length) {
                            i = c ? 0 : a.nodeValue.length, o = a, d = !0;
                            break
                        }
                        if (u[a.nodeName.toLowerCase()] && (!(l = a) || !/^(TD|TH|CAPTION)$/.test(l.nodeName))) {
                            i = e.nodeIndex(a), o = a.parentNode, c || i++, d = !0;
                            break
                        }
                    } while (a = c ? h.next() : h.prev())
                }
            }
        }
        return t && (en.isText(o) && 0 === i && om(e, s, t, !0, o).each(function (e) {
            o = e.container(), i = e.offset(), d = !0
        }), en.isElement(o) && (!(a = (a = o.childNodes[i]) || o.childNodes[i - 1]) || !en.isBr(a) || function (e, t) {
            return e.previousSibling && e.previousSibling.nodeName === t
        }(a, "A") || rm(e, a, !1) || rm(e, a, !0) || om(e, s, t, !0, a).each(function (e) {
            o = e.container(), i = e.offset(), d = !0
        }))), c && !t && en.isText(o) && i === o.nodeValue.length && om(e, s, t, !1, o).each(function (e) {
            o = e.container(), i = e.offset(), d = !0
        }), d ? D.some(Ku(o, i)) : D.none()
    }

    function am(e) {
        return 0 === e.dom().length ? (Pt(e), D.none()) : D.some(e)
    }

    function um(e, t, n, r, o) {
        var i = n ? t.startContainer : t.endContainer,
            a = n ? t.startOffset : t.endOffset;
        return D.from(i).map(at.fromDom).map(function (e) {
            return r && t.collapsed ? e : Se(e, o(e, a)).getOr(e)
        }).bind(function (e) {
            return Lt(e) ? D.some(e) : Ce(e)
        }).map(function (e) {
            return e.dom()
        }).getOr(e)
    }

    function cm(e, t, n) {
        return um(e, t, !0, n, function (e, t) {
            return Math.min(function (e) {
                return e.dom().childNodes.length
            }(e), t)
        })
    }

    function sm(e, t, n) {
        return um(e, t, !1, n, function (e, t) {
            return 0 < t ? t - 1 : t
        })
    }

    function lm(e, t) {
        for (var n = e; e && en.isText(e) && 0 === e.length;) e = t ? e.nextSibling : e.previousSibling;
        return e || n
    }

    function fm(e, t, n) {
        if (e && e.hasOwnProperty(t)) {
            var r = G(e[t], function (e) {
                return e !== n
            });
            0 === r.length ? delete e[t] : e[t] = r
        }
    }

    var dm = function FN(r, o) {
            function e(e) {
                var t = o(e);
                if (t <= 0 || null === t) {
                    var n = Ze(e, r);
                    return parseFloat(n) || 0
                }
                return t
            }

            function i(o, e) {
                return y(e, function (e, t) {
                    var n = Ze(o, t), r = n === undefined ? 0 : parseInt(n, 10);
                    return isNaN(r) ? e : e + r
                }, 0)
            }

            return {
                set: function (e, t) {
                    if (!L(t) && !t.match(/^[0-9]+$/)) throw new Error(r + ".set accepts only positive integer values. Value was " + t);
                    var n = e.dom();
                    We(n) && (n.style[r] = t + "px")
                }, get: e, getOuter: e, aggregate: i, max: function (e, t, n) {
                    var r = i(e, n);
                    return r < t ? t - r : 0
                }
            }
        }("height", function (e) {
            var t = e.dom();
            return Pe(e) ? t.getBoundingClientRect().height : t.offsetHeight
        }), hm = function (r, e) {
            return r.view(e).fold($([]), function (e) {
                var t = r.owner(e), n = hm(r, t);
                return [e].concat(n)
            })
        }, mm =/* */Object.freeze({
            __proto__: null, view: function (e) {
                return (e.dom() === j.document ? D.none() : D.from(e.dom().defaultView.frameElement)).map(at.fromDom)
            }, owner: function (e) {
                return ye(e)
            }
        }), gm = function (e, t, n, r) {
            var o = at.fromDom(e.getBody()), i = at.fromDom(e.getDoc());
            !function (e) {
                e.dom().offsetWidth
            }(o);
            var a = xh(at.fromDom(n.startContainer), n.startOffset);
            Eh(e, i, t, a, r), a.cleanup()
        }, pm = function (e, t, n) {
            var r = n.startContainer, o = n.startOffset, i = n.endContainer,
                a = n.endOffset;
            t(at.fromDom(r), at.fromDom(i));
            var u = e.dom.createRng();
            u.setStart(r, o), u.setEnd(i, a), e.selection.setRng(n)
        }, vm = function (e, t, n) {
            (e.inline ? Rh : _h)(e, t, n)
        }, ym = function (e, t, n) {
            (e.inline ? Mh : Dh)(e, t, n)
        }, bm = function (e, t, n) {
            var r, o, i = n;
            if (i.caretPositionFromPoint) (o = i.caretPositionFromPoint(e, t)) && ((r = n.createRange()).setStart(o.offsetNode, o.offset), r.collapse(!0)); else if (n.caretRangeFromPoint) r = n.caretRangeFromPoint(e, t); else if (i.body.createTextRange) {
                r = i.body.createTextRange();
                try {
                    r.moveToPoint(e, t), r.collapse(!0)
                } catch (a) {
                    r = function (e, n, t) {
                        var r, o, i;
                        if (r = t.elementFromPoint(e, n), o = t.body.createTextRange(), r && "HTML" !== r.tagName || (r = t.body), o.moveToElementText(r), 0 < (i = (i = Jn.toArray(o.getClientRects())).sort(function (e, t) {
                            return (e = Math.abs(Math.max(e.top - n, e.bottom - n))) - (t = Math.abs(Math.max(t.top - n, t.bottom - n)))
                        })).length) {
                            n = (i[0].bottom + i[0].top) / 2;
                            try {
                                return o.moveToPoint(e, n), o.collapse(!0), o
                            } catch (a) {
                            }
                        }
                        return null
                    }(e, t, n)
                }
                return function (e, t) {
                    var n = e && e.parentElement ? e.parentElement() : null;
                    return en.isContentEditableFalse(function (e, t, n) {
                        for (; e && e !== t;) {
                            if (n(e)) return e;
                            e = e.parentNode
                        }
                        return null
                    }(n, t, Oh)) ? null : e
                }(r, n.body)
            }
            return r
        }, Cm = function (n, e) {
            return X(e, function (e) {
                var t = n.fire("GetSelectionRange", {range: e});
                return t.range !== e ? t.range : e
            })
        }, wm = Ph, xm = function (e, t) {
            return [e].concat(Ph(e, t))
        }, zm = function (t) {
            return ke(t).fold($([t]), function (e) {
                return [t].concat(zm(e))
            })
        }, Em = function (t) {
            return Te(t).fold($([t]), function (e) {
                return "br" === He(e) ? we(e).map(function (e) {
                    return [t].concat(Em(e))
                }).getOr([]) : [t].concat(Em(e))
            })
        }, Nm = he("element", "width", "rows"), Sm = he("element", "cells"),
        km = he("x", "y"), Tm = function (e) {
            var o = Nm(Ha(e), 0, []);
            return U(wa(e, "tr"), function (n, r) {
                U(wa(n, "td,th"), function (e, t) {
                    !function (e, t, n, r, o) {
                        for (var i = Fh(o, "rowspan"), a = Fh(o, "colspan"), u = e.rows(), c = n; c < n + i; c++) {
                            u[c] || (u[c] = Sm(Ba(r), []));
                            for (var s = t; s < t + a; s++) {
                                u[c].cells()[s] = c === n && s === t ? o : Ha(o)
                            }
                        }
                    }(o, function (e, t, n) {
                        for (; r = t, o = n, i = void 0, ((i = e.rows())[o] ? i[o].cells() : [])[r];) t++;
                        var r, o, i;
                        return t
                    }(o, t, r), r, n, e)
                })
            }), Nm(o.element(), Uh(o.rows()), o.rows())
        }, Am = function (e) {
            return function (e, t) {
                var n = Ha(e.element()), r = at.fromTag("tbody");
                return De(r, t), Bt(n, r), n
            }(e, function (e) {
                return X(e.rows(), function (e) {
                    var t = X(e.cells(), function (e) {
                        var t = Ba(e);
                        return Ge(t, "colspan"), Ge(t, "rowspan"), t
                    }), n = Ha(e.element());
                    return De(n, t), n
                })
            }(e))
        }, Mm = function (n, e, r) {
            return jh(n, e).bind(function (t) {
                return jh(n, r).map(function (e) {
                    return function (e, t, n) {
                        var r = t.x(), o = t.y(), i = n.x(), a = n.y(),
                            u = o < a ? qh(e, r, o, i, a) : qh(e, r, a, i, o);
                        return Nm(e.element(), Uh(u), u)
                    }(n, t, e)
                })
            })
        }, Rm = $h, Dm = function (e) {
            return v(e, function (e) {
                var t = Qa(e);
                return t ? [at.fromDom(t)] : []
            })
        }, _m = function (e) {
            return 1 < $h(e).length
        }, Om = Xh, Hm = function (e) {
            return Xh(Rm(e.selection.getSel()), at.fromDom(e.getBody()))
        }, Bm = function (e, t) {
            var n = Om(t, e);
            return 0 < n.length ? Qh(e, n) : function (e, t) {
                return 0 < t.length && t[0].collapsed ? Zh() : Jh(e, t[0])
            }(e, t)
        }, Pm = function (e, t) {
            if (void 0 === t && (t = {}), t.get = !0, t.format = t.format || "html", t.selection = !0, (t = e.fire("BeforeGetContent", t)).isDefaultPrevented()) return e.fire("GetContent", t), t.content;
            if ("text" === t.format) return function (r) {
                return D.from(r.selection.getRng()).map(function (e) {
                    var t = r.dom.add(r.getBody(), "div", {
                        "data-mce-bogus": "all",
                        style: "overflow: hidden; opacity: 0;"
                    }, e.cloneContents()), n = gu.trim(t.innerText);
                    return r.dom.remove(t), n
                }).getOr("")
            }(e);
            t.getInner = !0;
            var n = function (e, t) {
                var n, r = e.selection.getRng(), o = e.dom.create("body"),
                    i = e.selection.getSel(), a = Cm(e, Rm(i));
                return (n = t.contextual ? Bm(at.fromDom(e.getBody()), a).dom() : r.cloneContents()) && o.appendChild(n), e.selection.serializer.serialize(o, t)
            }(e, t);
            return "tree" === t.format ? n : (t.content = e.selection.isCollapsed() ? "" : n, e.fire("GetContent", t), t.content)
        }, Lm = function (e, t) {
            return e && t && e.startContainer === t.startContainer && e.startOffset === t.startOffset && e.endContainer === t.endContainer && e.endOffset === t.endOffset
        }, Vm = function (e, t) {
            var n = t.collapsed, r = t.cloneRange(), o = Ku.fromRangeStart(t);
            return im(e, n, !0, r).each(function (e) {
                n && Ku.isAbove(o, e) || r.setStart(e.container(), e.offset())
            }), n || im(e, n, !1, r).each(function (e) {
                r.setEnd(e.container(), e.offset())
            }), n && r.collapse(!0), Lm(t, r) ? D.none() : D.some(r)
        }, Im = function (e, t, n) {
            if ((n = function (e, t) {
                return (e = e || {format: "html"}).set = !0, e.selection = !0, e.content = t, e
            }(n, t)).no_events || !(n = e.fire("BeforeSetContent", n)).isDefaultPrevented()) {
                var r = e.selection.getRng();
                !function (r, e) {
                    var t = D.from(e.firstChild).map(at.fromDom),
                        n = D.from(e.lastChild).map(at.fromDom);
                    r.deleteContents(), r.insertNode(e);
                    var o = t.bind(we).filter(Vt).bind(am),
                        i = n.bind(xe).filter(Vt).bind(am);
                    nu(o, t.filter(Vt), function (e, t) {
                        !function (e, t) {
                            e.insertData(0, t)
                        }(t.dom(), e.dom().data), Pt(e)
                    }), nu(i, n.filter(Vt), function (e, t) {
                        var n = t.dom().length;
                        t.dom().appendData(e.dom().data), r.setEnd(t.dom(), n), Pt(e)
                    }), r.collapse(!1)
                }(r, r.createContextualFragment(n.content)), e.selection.setRng(r), ym(e, r), n.no_events || e.fire("SetContent", n)
            } else e.fire("SetContent", n)
        };

    function Fm(e) {
        return !!e.select
    }

    function Um(e) {
        return !(!e || !e.ownerDocument) && Ht(at.fromDom(e.ownerDocument), at.fromDom(e))
    }

    function jm(u, c, e, s) {
        function t(e, t) {
            return Im(s, e, t)
        }

        function r() {
            var e, t, n = d();
            return !(n && n.anchorNode && n.focusNode) || ((e = u.createRng()).setStart(n.anchorNode, n.anchorOffset), e.collapse(!0), (t = u.createRng()).setStart(n.focusNode, n.focusOffset), t.collapse(!0), e.compareBoundaryPoints(e.START_TO_START, t) <= 0)
        }

        var n, o, l, f, i = function p(i, n) {
            var a, u;
            return {
                selectorChangedWithUnbind: function (e, t) {
                    return a || (a = {}, u = {}, n.on("NodeChange", function (e) {
                        var n = e.element,
                            r = i.getParents(n, null, i.getRoot()), o = {};
                        Jn.each(a, function (e, n) {
                            Jn.each(r, function (t) {
                                if (i.is(t, n)) return u[n] || (Jn.each(e, function (e) {
                                    e(!0, {node: t, selector: n, parents: r})
                                }), u[n] = e), o[n] = e, !1
                            })
                        }), Jn.each(u, function (e, t) {
                            o[t] || (delete u[t], Jn.each(e, function (e) {
                                e(!1, {node: n, selector: t, parents: r})
                            }))
                        })
                    })), a[e] || (a[e] = []), a[e].push(t), {
                        unbind: function () {
                            fm(a, e, t), fm(u, e, t)
                        }
                    }
                }
            }
        }(u, s).selectorChangedWithUnbind, a = function (e) {
            var t = h();
            t.collapse(!!e), m(t)
        }, d = function () {
            return c.getSelection ? c.getSelection() : c.document.selection
        }, h = function () {
            function e(e, t, n) {
                try {
                    return t.compareBoundaryPoints(e, n)
                } catch (r) {
                    return -1
                }
            }

            var t, n, r, o;
            if (!c) return null;
            if (null == (o = c.document)) return null;
            if (s.bookmark !== undefined && !1 === Bd(s)) {
                var i = kd(s);
                if (i.isSome()) return i.map(function (e) {
                    return Cm(s, [e])[0]
                }).getOr(o.createRange())
            }
            try {
                (t = d()) && !en.isRestrictedNode(t.anchorNode) && (n = 0 < t.rangeCount ? t.getRangeAt(0) : t.createRange ? t.createRange() : o.createRange())
            } catch (a) {
            }
            return (n = (n = Cm(s, [n])[0]) || (o.createRange ? o.createRange() : o.body.createTextRange())).setStart && 9 === n.startContainer.nodeType && n.collapsed && (r = u.getRoot(), n.setStart(r, 0), n.setEnd(r, 0)), l && f && (0 === e(n.START_TO_START, n, l) && 0 === e(n.END_TO_END, n, l) ? n = f : f = l = null), n
        }, m = function (e, t) {
            var n, r;
            if (function (e) {
                return !!e && (!!Fm(e) || Um(e.startContainer) && Um(e.endContainer))
            }(e)) {
                var o = Fm(e) ? e : null;
                if (o) {
                    f = null;
                    try {
                        o.select()
                    } catch (i) {
                    }
                } else {
                    if (n = d(), e = s.fire("SetSelectionRange", {
                        range: e,
                        forward: t
                    }).range, n) {
                        f = e;
                        try {
                            n.removeAllRanges(), n.addRange(e)
                        } catch (i) {
                        }
                        !1 === t && n.extend && (n.collapse(e.endContainer, e.endOffset), n.extend(e.startContainer, e.startOffset)), l = 0 < n.rangeCount ? n.getRangeAt(0) : null
                    }
                    e.collapsed || e.startContainer !== e.endContainer || !n.setBaseAndExtent || Kn.ie || e.endOffset - e.startOffset < 2 && e.startContainer.hasChildNodes() && (r = e.startContainer.childNodes[e.startOffset]) && "IMG" === r.tagName && (n.setBaseAndExtent(e.startContainer, e.startOffset, e.endContainer, e.endOffset), n.anchorNode === e.startContainer && n.focusNode === e.endContainer || n.setBaseAndExtent(r, 0, r, 1)), s.fire("AfterSetSelectionRange", {
                        range: e,
                        forward: t
                    })
                }
            }
        }, g = {
            bookmarkManager: null,
            controlSelection: null,
            dom: u,
            win: c,
            serializer: e,
            editor: s,
            collapse: a,
            setCursorLocation: function (e, t) {
                var n = u.createRng();
                e ? (n.setStart(e, t), n.setEnd(e, t), m(n), a(!1)) : (Vh(u, n, s.getBody(), !0), m(n))
            },
            getContent: function (e) {
                return Pm(s, e)
            },
            setContent: t,
            getBookmark: function (e, t) {
                return n.getBookmark(e, t)
            },
            moveToBookmark: function (e) {
                return n.moveToBookmark(e)
            },
            select: function (e, t) {
                return function (r, e, o) {
                    return D.from(e).map(function (e) {
                        var t = r.nodeIndex(e), n = r.createRng();
                        return n.setStart(e.parentNode, t), n.setEnd(e.parentNode, t + 1), o && (Vh(r, n, e, !0), Vh(r, n, e, !1)), n
                    })
                }(u, e, t).each(m), e
            },
            isCollapsed: function () {
                var e = h(), t = d();
                return !(!e || e.item) && (e.compareEndPoints ? 0 === e.compareEndPoints("StartToEnd", e) : !t || e.collapsed)
            },
            isForward: r,
            setNode: function (e) {
                return t(u.getOuterHTML(e)), e
            },
            getNode: function () {
                return function (e, t) {
                    var n, r, o, i, a;
                    return t ? (r = t.startContainer, o = t.endContainer, i = t.startOffset, a = t.endOffset, n = t.commonAncestorContainer, !t.collapsed && (r === o && a - i < 2 && r.hasChildNodes() && (n = r.childNodes[i]), 3 === r.nodeType && 3 === o.nodeType && (r = r.length === i ? lm(r.nextSibling, !0) : r.parentNode, o = 0 === a ? lm(o.previousSibling, !1) : o.parentNode, r && r === o)) ? r : n && 3 === n.nodeType ? n.parentNode : n) : e
                }(s.getBody(), h())
            },
            getSel: d,
            setRng: m,
            getRng: h,
            getStart: function (e) {
                return cm(s.getBody(), h(), e)
            },
            getEnd: function (e) {
                return sm(s.getBody(), h(), e)
            },
            getSelectedBlocks: function (e, t) {
                return function (e, t, n, r) {
                    var o, i, a = [];
                    if (i = e.getRoot(), n = e.getParent(n || cm(i, t, t.collapsed), e.isBlock), r = e.getParent(r || sm(i, t, t.collapsed), e.isBlock), n && n !== i && a.push(n), n && r && n !== r) for (var u = new Ui(o = n, i); (o = u.next()) && o !== r;) e.isBlock(o) && a.push(o);
                    return r && n !== r && r !== i && a.push(r), a
                }(u, h(), e, t)
            },
            normalize: function () {
                var e = h(), t = d();
                if (_m(t) || !Ih(s)) return e;
                var n = Vm(u, e);
                return n.each(function (e) {
                    m(e, r())
                }), n.getOr(e)
            },
            selectorChanged: function (e, t) {
                return i(e, t), g
            },
            selectorChangedWithUnbind: i,
            getScrollContainer: function () {
                for (var e, t = u.getRoot(); t && "BODY" !== t.nodeName;) {
                    if (t.scrollHeight > t.clientHeight) {
                        e = t;
                        break
                    }
                    t = t.parentNode
                }
                return e
            },
            scrollIntoView: function (e, t) {
                return vm(s, e, t)
            },
            placeCaretAt: function (e, t) {
                return m(bm(e, t, s.getDoc()))
            },
            getBoundingClientRect: function () {
                var e = h();
                return e.collapsed ? Ic.fromRangeStart(e).getClientRects()[0] : e.getBoundingClientRect()
            },
            destroy: function () {
                c = l = f = null, o.destroy()
            }
        };
        return n = mh(g), o = hh(g, s), g.bookmarkManager = n, g.controlSelection = o, g
    }

    function qm(e, i, a) {
        e.addNodeFilter("font", function (e) {
            U(e, function (e) {
                var t = i.parse(e.attr("style")), n = e.attr("color"),
                    r = e.attr("face"), o = e.attr("size");
                n && (t.color = n), r && (t["font-family"] = r), o && (t["font-size"] = a[parseInt(e.attr("size"), 10) - 1]), e.name = "span", e.attr("style", i.serialize(t)), function (t, e) {
                    U(e, function (e) {
                        t.attr(e, null)
                    })
                }(e, ["color", "face", "size"])
            })
        })
    }

    function $m(e, t) {
        var n = Wr();
        t.convert_fonts_to_spans && qm(e, n, Jn.explode(t.font_size_legacy_values)), function (e, n) {
            e.addNodeFilter("strike", function (e) {
                U(e, function (e) {
                    var t = n.parse(e.attr("style"));
                    t["text-decoration"] = "line-through", e.name = "span", e.attr("style", n.serialize(t))
                })
            })
        }(e, n)
    }

    function Wm(e, t, n, r) {
        (e.padd_empty_with_br || t.insert) && n[r.name] ? r.empty().append(new gf("br", 1)).shortEnded = !0 : r.empty().append(new gf("#text", 3)).value = $r
    }

    function Km(t, e, n, r) {
        return r.isEmpty(e, n, function (e) {
            return function (e, t) {
                var n = e.getElementRule(t.name);
                return n && n.paddEmpty
            }(t, e)
        })
    }

    function Xm(T, A) {
        void 0 === A && (A = Lr());
        var M = {}, R = [], D = {}, _ = {};
        (T = T || {}).validate = !("validate" in T) || T.validate, T.root_name = T.root_name || "body";
        var O = function (e) {
            var t, n, r;
            (n = e.name) in M && ((r = D[n]) ? r.push(e) : D[n] = [e]), t = R.length;
            for (; t--;) (n = R[t].name) in e.attributes.map && ((r = _[n]) ? r.push(e) : _[n] = [e]);
            return e
        }, e = {
            schema: A, addAttributeFilter: function (e, n) {
                og(ig(e), function (e) {
                    var t;
                    for (t = 0; t < R.length; t++) if (R[t].name === e) return void R[t].callbacks.push(n);
                    R.push({name: e, callbacks: [n]})
                })
            }, getAttributeFilters: function () {
                return [].concat(R)
            }, addNodeFilter: function (e, n) {
                og(ig(e), function (e) {
                    var t = M[e];
                    t || (M[e] = t = []), t.push(n)
                })
            }, getNodeFilters: function () {
                var e = [];
                for (var t in M) M.hasOwnProperty(t) && e.push({
                    name: t,
                    callbacks: M[t]
                });
                return e
            }, filterNode: O, parse: function (e, a) {
                var t, n, r, o, i, u, c, s, l, f, d, h = [];
                a = a || {}, D = {}, _ = {}, l = ag(rg("script,style,head,html,body,title,meta,param"), A.getBlockElements());
                var m, g = A.getNonEmptyElements(), p = A.children,
                    v = T.validate,
                    y = "forced_root_block" in a ? a.forced_root_block : T.forced_root_block,
                    b = !1 === (m = y) ? "" : !0 === m ? "p" : m,
                    C = A.getWhiteSpaceElements(), w = /^[ \t\r\n]+/,
                    x = /[ \t\r\n]+$/, z = /[ \t\r\n]+/g, E = /^[ \t\r\n]+$/;
                f = C.hasOwnProperty(a.context) || C.hasOwnProperty(T.root_name);

                function N(e) {
                    var t, n, r, o, i = A.getBlockElements();
                    for (t = e.prev; t && 3 === t.type;) {
                        if (0 < (r = t.value.replace(x, "")).length) return void (t.value = r);
                        if (n = t.next) {
                            if (3 === n.type && n.value.length) {
                                t = t.prev;
                                continue
                            }
                            if (!i[n.name] && "script" !== n.name && "style" !== n.name) {
                                t = t.prev;
                                continue
                            }
                        }
                        o = t.prev, t.remove(), t = o
                    }
                }

                var S = function (e, t) {
                    var n, r = new gf(e, t);
                    return e in M && ((n = D[e]) ? n.push(r) : D[e] = [r]), r
                };
                t = hd({
                    validate: v,
                    allow_script_urls: T.allow_script_urls,
                    allow_conditional_comments: T.allow_conditional_comments,
                    preserve_cdata: T.preserve_cdata,
                    self_closing_elements: function (e) {
                        var t, n = {};
                        for (t in e) "li" !== t && "p" !== t && (n[t] = e[t]);
                        return n
                    }(A.getSelfClosingElements()),
                    cdata: function (e) {
                        d.append(S("#cdata", 4)).value = e
                    },
                    text: function (e, t) {
                        var n;
                        f || (e = e.replace(z, " "), function (e, t) {
                            return e && (t[e.name] || "br" === e.name)
                        }(d.lastChild, l) && (e = e.replace(w, ""))), 0 !== e.length && ((n = S("#text", 3)).raw = !!t, d.append(n).value = e)
                    },
                    comment: function (e) {
                        d.append(S("#comment", 8)).value = e
                    },
                    pi: function (e, t) {
                        d.append(S(e, 7)).value = t, N(d)
                    },
                    doctype: function (e) {
                        d.append(S("#doctype", 10)).value = e, N(d)
                    },
                    start: function (e, t, n) {
                        var r, o, i, a, u;
                        if (i = v ? A.getElementRule(e) : {}) {
                            for ((r = S(i.outputName || e, 1)).attributes = t, r.shortEnded = n, d.append(r), (u = p[d.name]) && p[r.name] && !u[r.name] && h.push(r), o = R.length; o--;) (a = R[o].name) in t.map && ((c = _[a]) ? c.push(r) : _[a] = [r]);
                            l[e] && N(r), n || (d = r), !f && C[e] && (f = !0)
                        }
                    },
                    end: function (e) {
                        var t, n, r, o, i;
                        if (n = v ? A.getElementRule(e) : {}) {
                            if (l[e] && !f) {
                                if ((t = d.firstChild) && 3 === t.type) if (0 < (r = t.value.replace(w, "")).length) t.value = r, t = t.next; else for (o = t.next, t.remove(), t = o; t && 3 === t.type;) r = t.value, o = t.next, 0 !== r.length && !E.test(r) || (t.remove(), t = o), t = o;
                                if ((t = d.lastChild) && 3 === t.type) if (0 < (r = t.value.replace(x, "")).length) t.value = r, t = t.prev; else for (o = t.prev, t.remove(), t = o; t && 3 === t.type;) r = t.value, o = t.prev, 0 !== r.length && !E.test(r) || (t.remove(), t = o), t = o
                            }
                            if (f && C[e] && (f = !1), n.removeEmpty && Km(A, g, C, d) && !d.attr("name") && !d.attr("id")) return i = d.parent, l[d.name] ? d.empty().remove() : d.unwrap(), void (d = i);
                            n.paddEmpty && (function (e) {
                                return ng(e, "#text") && e.firstChild.value === $r
                            }(d) || Km(A, g, C, d)) && Wm(T, a, l, d), d = d.parent
                        }
                    }
                }, A);
                var k = d = new gf(a.context || T.root_name, 11);
                if (t.parse(e, a.format), v && h.length && (a.context ? a.invalid = !0 : function (e) {
                    var t, n, r, o, i, a, u, c, s, l, f, d, h, m, g, p;
                    for (d = rg("tr,td,th,tbody,thead,tfoot,table"), l = A.getNonEmptyElements(), f = A.getWhiteSpaceElements(), h = A.getTextBlockElements(), m = A.getSpecialElements(), t = 0; t < e.length; t++) if ((n = e[t]).parent && !n.fixed) if (h[n.name] && "li" === n.parent.name) {
                        for (g = n.next; g && h[g.name];) g.name = "li", g.fixed = !0, n.parent.insert(g, n.parent), g = g.next;
                        n.unwrap(n)
                    } else {
                        for (o = [n], r = n.parent; r && !A.isValidChild(r.name, n.name) && !d[r.name]; r = r.parent) o.push(r);
                        if (r && 1 < o.length) {
                            for (o.reverse(), i = a = O(o[0].clone()), s = 0; s < o.length - 1; s++) {
                                for (A.isValidChild(a.name, o[s].name) ? (u = O(o[s].clone()), a.append(u)) : u = a, c = o[s].firstChild; c && c !== o[s + 1];) p = c.next, u.append(c), c = p;
                                a = u
                            }
                            Km(A, l, f, i) ? r.insert(n, o[0], !0) : (r.insert(i, o[0], !0), r.insert(n, i)), r = o[0], (Km(A, l, f, r) || ng(r, "br")) && r.empty().remove()
                        } else if (n.parent) {
                            if ("li" === n.name) {
                                if ((g = n.prev) && ("ul" === g.name || "ul" === g.name)) {
                                    g.append(n);
                                    continue
                                }
                                if ((g = n.next) && ("ul" === g.name || "ul" === g.name)) {
                                    g.insert(n, g.firstChild, !0);
                                    continue
                                }
                                n.wrap(O(new gf("ul", 1)));
                                continue
                            }
                            A.isValidChild(n.parent.name, "div") && A.isValidChild("div", n.name) ? n.wrap(O(new gf("div", 1))) : m[n.name] ? n.empty().remove() : n.unwrap()
                        }
                    }
                }(h)), b && ("body" === k.name || a.isRootContent) && function () {
                    function e(e) {
                        e && ((r = e.firstChild) && 3 === r.type && (r.value = r.value.replace(w, "")), (r = e.lastChild) && 3 === r.type && (r.value = r.value.replace(x, "")))
                    }

                    var t, n, r = k.firstChild;
                    if (A.isValidChild(k.name, b.toLowerCase())) {
                        for (; r;) t = r.next, 3 === r.type || 1 === r.type && "p" !== r.name && !l[r.name] && !r.attr("data-mce-type") ? (n || ((n = S(b, 1)).attr(T.forced_root_block_attrs), k.insert(n, r)), n.append(r)) : (e(n), n = null), r = t;
                        e(n)
                    }
                }(), !a.invalid) {
                    for (s in D) if (D.hasOwnProperty(s)) {
                        for (c = M[s], i = (n = D[s]).length; i--;) n[i].parent || n.splice(i, 1);
                        for (r = 0, o = c.length; r < o; r++) c[r](n, s, a)
                    }
                    for (r = 0, o = R.length; r < o; r++) if ((c = R[r]).name in _) {
                        for (i = (n = _[c.name]).length; i--;) n[i].parent || n.splice(i, 1);
                        for (i = 0, u = c.callbacks.length; i < u; i++) c.callbacks[i](n, c.name, a)
                    }
                }
                return k
            }
        };
        return function (e, g) {
            var p = e.schema;
            g.remove_trailing_brs && e.addNodeFilter("br", function (e, t, n) {
                var r, o, i, a, u, c, s, l, f = e.length,
                    d = Jn.extend({}, p.getBlockElements()),
                    h = p.getNonEmptyElements(), m = p.getNonEmptyElements();
                for (d.body = 1, r = 0; r < f; r++) if (i = (o = e[r]).parent, d[o.parent.name] && o === i.lastChild) {
                    for (u = o.prev; u;) {
                        if ("span" !== (c = u.name) || "bookmark" !== u.attr("data-mce-type")) {
                            if ("br" !== c) break;
                            if ("br" === c) {
                                o = null;
                                break
                            }
                        }
                        u = u.prev
                    }
                    o && (o.remove(), Km(p, h, m, i) && (s = p.getElementRule(i.name)) && (s.removeEmpty ? i.remove() : s.paddEmpty && Wm(g, n, d, i)))
                } else {
                    for (a = o; i && i.firstChild === a && i.lastChild === a && !d[(a = i).name];) i = i.parent;
                    a === i && !0 !== g.padd_empty_with_br && ((l = new gf("#text", 3)).value = $r, o.replace(l))
                }
            }), e.addAttributeFilter("href", function (e) {
                var t, n, r, o = e.length;
                if (!g.allow_unsafe_link_target) for (; o--;) "a" === (t = e[o]).name && "_blank" === t.attr("target") && t.attr("rel", (n = t.attr("rel"), void 0, r = n ? Jn.trim(n) : "", /\b(noopener)\b/g.test(r) ? r : r.split(" ").filter(function (e) {
                    return 0 < e.length
                }).concat(["noopener"]).sort().join(" ")))
            }), g.allow_html_in_named_anchor || e.addAttributeFilter("id,name", function (e) {
                for (var t, n, r, o, i = e.length; i--;) if ("a" === (o = e[i]).name && o.firstChild && !o.attr("href")) for (r = o.parent, t = o.lastChild; n = t.prev, r.insert(t, o), t = n;) ;
            }), g.fix_list_elements && e.addNodeFilter("ul,ol", function (e) {
                for (var t, n, r = e.length; r--;) if ("ul" === (n = (t = e[r]).parent).name || "ol" === n.name) if (t.prev && "li" === t.prev.name) t.prev.append(t); else {
                    var o = new gf("li", 1);
                    o.attr("style", "list-style-type: none"), t.wrap(o)
                }
            }), g.validate && p.getValidClasses() && e.addAttributeFilter("class", function (e) {
                for (var t, n, r, o, i, a, u, c = e.length, s = p.getValidClasses(); c--;) {
                    for (n = (t = e[c]).attr("class").split(" "), i = "", r = 0; r < n.length; r++) o = n[r], u = !1, (a = s["*"]) && a[o] && (u = !0), a = s[t.name], !u && a && a[o] && (u = !0), u && (i && (i += " "), i += o);
                    i.length || (i = null), t.attr("class", i)
                }
            })
        }(e, T), tg(e, T), e
    }

    function Ym(e, t, n) {
        -1 === Jn.inArray(t, n) && (e.addAttributeFilter(n, function (e, t) {
            for (var n = e.length; n--;) e[n].attr(t, null)
        }), t.push(n))
    }

    function Gm(e, t, n, r, o) {
        return function (e, t, n) {
            return t.no_events || !e ? n : function (e, t) {
                return e.fire("PostProcess", t)
            }(e, ne(ne({}, t), {content: n})).content
        }(e, o, function (e, t, n) {
            return zf(e, t).serialize(n)
        }(t, n, r))
    }

    function Zm(a, u) {
        var e = ["data-mce-selected"], c = u && u.dom ? u.dom : ea.DOM,
            s = u && u.schema ? u.schema : Lr(a);
        a.entity_encoding = a.entity_encoding || "named", a.remove_trailing_brs = !("remove_trailing_brs" in a) || a.remove_trailing_brs;
        var l = Xm(a, s);
        return ug(l, a, c), {
            schema: s,
            addNodeFilter: l.addNodeFilter,
            addAttributeFilter: l.addAttributeFilter,
            serialize: function (e, t) {
                void 0 === t && (t = {});
                var n = ne({format: "html"}, t), r = sg(u, e, n),
                    o = function (e, t, n) {
                        var r = gu.trim(n.getInner ? t.innerHTML : e.getOuterHTML(t));
                        return n.selection || mr(at.fromDom(t)) ? r : Jn.trim(r)
                    }(c, r, n), i = function (e, t, n) {
                        var r = n.selection ? ne({forced_root_block: !1}, n) : n,
                            o = e.parse(t, r);
                        return cg(o), o
                    }(l, o, n);
                return "tree" === n.format ? i : Gm(u, a, s, i, n)
            },
            addRules: function (e) {
                s.addValidElements(e)
            },
            setRules: function (e) {
                s.setValidElements(e)
            },
            addTempAttr: d(Ym, l, e),
            getTempAttrs: function () {
                return e
            },
            getNodeFilters: l.getNodeFilters,
            getAttributeFilters: l.getAttributeFilters
        }
    }

    function Jm(e, t) {
        var n = Zm(e, t);
        return {
            schema: n.schema,
            addNodeFilter: n.addNodeFilter,
            addAttributeFilter: n.addAttributeFilter,
            serialize: n.serialize,
            addRules: n.addRules,
            setRules: n.setRules,
            addTempAttr: n.addTempAttr,
            getTempAttrs: n.getTempAttrs,
            getNodeFilters: n.getNodeFilters,
            getAttributeFilters: n.getAttributeFilters
        }
    }

    function Qm(e) {
        var t, n, r = decodeURIComponent(e).split(",");
        return (n = /data:([^;]+)/.exec(r[0])) && (t = n[1]), {
            type: t,
            data: r[1]
        }
    }

    function eg(e) {
        return (e || "blobid") + hg++
    }

    var tg = function (e, t) {
            t.inline_styles && $m(e, t)
        }, ng = function (e, t) {
            return e && e.firstChild && e.firstChild === e.lastChild && e.firstChild.name === t
        }, rg = Jn.makeMap, og = Jn.each, ig = Jn.explode, ag = Jn.extend,
        ug = function (t, c, s) {
            t.addAttributeFilter("data-mce-tabindex", function (e, t) {
                for (var n, r = e.length; r--;) (n = e[r]).attr("tabindex", n.attr("data-mce-tabindex")), n.attr(t, null)
            }), t.addAttributeFilter("src,href,style", function (e, t) {
                for (var n, r, o = e.length, i = "data-mce-" + t, a = c.url_converter, u = c.url_converter_scope; o--;) (r = (n = e[o]).attr(i)) !== undefined ? (n.attr(t, 0 < r.length ? r : null), n.attr(i, null)) : (r = n.attr(t), "style" === t ? r = s.serializeStyle(s.parseStyle(r), n.name) : a && (r = a.call(u, r, t, n.name)), n.attr(t, 0 < r.length ? r : null))
            }), t.addAttributeFilter("class", function (e) {
                for (var t, n, r = e.length; r--;) (n = (t = e[r]).attr("class")) && (n = t.attr("class").replace(/(?:^|\s)mce-item-\w+(?!\S)/g, ""), t.attr("class", 0 < n.length ? n : null))
            }), t.addAttributeFilter("data-mce-type", function (e, t, n) {
                for (var r, o = e.length; o--;) {
                    if ("bookmark" === (r = e[o]).attr("data-mce-type") && !n.cleanup) D.from(r.firstChild).exists(function (e) {
                        return !gu.isZwsp(e.value)
                    }) ? r.unwrap() : r.remove()
                }
            }), t.addNodeFilter("noscript", function (e) {
                for (var t, n = e.length; n--;) (t = e[n].firstChild) && (t.value = kr.decode(t.value))
            }), t.addNodeFilter("script,style", function (e, t) {
                for (var n, r, o, i = e.length, a = function (e) {
                    return e.replace(/(<!--\[CDATA\[|\]\]-->)/g, "\n").replace(/^[\r\n]*|[\r\n]*$/g, "").replace(/^\s*((<!--)?(\s*\/\/)?\s*<!\[CDATA\[|(<!--\s*)?\/\*\s*<!\[CDATA\[\s*\*\/|(\/\/)?\s*<!--|\/\*\s*<!--\s*\*\/)\s*[\r\n]*/gi, "").replace(/\s*(\/\*\s*\]\]>\s*\*\/(-->)?|\s*\/\/\s*\]\]>(-->)?|\/\/\s*(-->)?|\]\]>|\/\*\s*-->\s*\*\/|\s*-->\s*)\s*$/g, "")
                }; i--;) r = (n = e[i]).firstChild ? n.firstChild.value : "", "script" === t ? ((o = n.attr("type")) && n.attr("type", "mce-no/type" === o ? null : o.replace(/^mce\-/, "")), "xhtml" === c.element_format && 0 < r.length && (n.firstChild.value = "// <![CDATA[\n" + a(r) + "\n// ]]>")) : "xhtml" === c.element_format && 0 < r.length && (n.firstChild.value = "\x3c!--\n" + a(r) + "\n--\x3e")
            }), t.addNodeFilter("#comment", function (e) {
                for (var t, n = e.length; n--;) t = e[n], c.preserve_cdata && 0 === t.value.indexOf("[CDATA[") ? (t.name = "#cdata", t.type = 4, t.value = s.decode(t.value.replace(/^\[CDATA\[|\]\]$/g, ""))) : 0 === t.value.indexOf("mce:protected ") && (t.name = "#text", t.type = 3, t.raw = !0, t.value = unescape(t.value).substr(14))
            }), t.addNodeFilter("xml:namespace,input", function (e, t) {
                for (var n, r = e.length; r--;) 7 === (n = e[r]).type ? n.remove() : 1 === n.type && ("input" !== t || n.attr("type") || n.attr("type", "text"))
            }), t.addAttributeFilter("data-mce-type", function (e) {
                U(e, function (e) {
                    "format-caret" === e.attr("data-mce-type") && (e.isEmpty(t.schema.getNonEmptyElements()) ? e.remove() : e.unwrap())
                })
            }), t.addAttributeFilter("data-mce-src,data-mce-href,data-mce-style,data-mce-selected,data-mce-expando,data-mce-type,data-mce-resize,data-mce-placeholder", function (e, t) {
                for (var n = e.length; n--;) e[n].attr(t, null)
            })
        }, cg = function (e) {
            function t(e) {
                return e && "br" === e.name
            }

            var n, r;
            t(n = e.lastChild) && t(r = n.prev) && (n.remove(), r.remove())
        }, sg = function (e, t, n) {
            return function (e, t) {
                return e && e.hasEventListeners("PreProcess") && !t.no_events
            }(e, n) ? function (e, t, n) {
                var r, o, i, a = e.dom;
                return t = t.cloneNode(!0), (r = j.document.implementation).createHTMLDocument && (o = r.createHTMLDocument(""), Jn.each("BODY" === t.nodeName ? t.childNodes : [t], function (e) {
                    o.body.appendChild(o.importNode(e, !0))
                }), t = "BODY" !== t.nodeName ? o.body.firstChild : o.body, i = a.doc, a.doc = o), function (e, t) {
                    e.fire("PreProcess", t)
                }(e, ne(ne({}, n), {node: t})), i && (a.doc = i), t
            }(e, t, n) : t
        }, lg = function (e) {
            return 0 === e.indexOf("blob:") ? function (i) {
                return new xn(function (e, t) {
                    function n() {
                        t("Cannot convert " + i + " to Blob. Resource might not exist or is inaccessible.")
                    }

                    try {
                        var r = new j.XMLHttpRequest;
                        r.open("GET", i, !0), r.responseType = "blob", r.onload = function () {
                            200 === this.status ? e(this.response) : n()
                        }, r.onerror = n, r.send()
                    } catch (o) {
                        n()
                    }
                })
            }(e) : 0 === e.indexOf("data:") ? function (i) {
                return new xn(function (e) {
                    var t, n, r, o = Qm(i);
                    try {
                        t = j.atob(o.data)
                    } catch (VN) {
                        return void e(new j.Blob([]))
                    }
                    for (n = new Uint8Array(t.length), r = 0; r < n.length; r++) n[r] = t.charCodeAt(r);
                    e(new j.Blob([n], {type: o.type}))
                })
            }(e) : null
        }, fg = function (n) {
            return new xn(function (e) {
                var t = new j.FileReader;
                t.onloadend = function () {
                    e(t.result)
                }, t.readAsDataURL(n)
            })
        }, dg = Qm, hg = 0;

    function mg(o, i) {
        var a = {};
        return {
            findAll: function (e, n) {
                var t;
                n = n || $(!0), t = G(function (e) {
                    return e ? Z(e.getElementsByTagName("img")) : []
                }(e), function (e) {
                    var t = e.src;
                    return !!Kn.fileApi && (!e.hasAttribute("data-mce-bogus") && (!e.hasAttribute("data-mce-placeholder") && (!(!t || t === Kn.transparentSrc) && (0 === t.indexOf("blob:") ? !o.isUploaded(t) && n(e) : 0 === t.indexOf("data:") && n(e)))))
                });
                var r = X(t, function (n) {
                    if (a[n.src]) return new xn(function (t) {
                        a[n.src].then(function (e) {
                            if ("string" == typeof e) return e;
                            t({image: n, blobInfo: e.blobInfo})
                        })
                    });
                    var e = new xn(function (e, t) {
                        !function (n, r, o, t) {
                            var i, a;
                            0 !== r.src.indexOf("blob:") ? (i = dg(r.src).data, (a = n.findFirst(function (e) {
                                return e.base64() === i
                            })) ? o({
                                image: r,
                                blobInfo: a
                            }) : lg(r.src).then(function (e) {
                                a = n.create(eg(), e, i), n.add(a), o({
                                    image: r,
                                    blobInfo: a
                                })
                            }, function (e) {
                                t(e)
                            })) : (a = n.getByUri(r.src)) ? o({
                                image: r,
                                blobInfo: a
                            }) : lg(r.src).then(function (t) {
                                fg(t).then(function (e) {
                                    i = dg(e).data, a = n.create(eg(), t, i), n.add(a), o({
                                        image: r,
                                        blobInfo: a
                                    })
                                })
                            }, function (e) {
                                t(e)
                            })
                        }(i, n, e, t)
                    }).then(function (e) {
                        return delete a[e.image.src], e
                    })["catch"](function (e) {
                        return delete a[n.src], e
                    });
                    return a[n.src] = e
                });
                return xn.all(r)
            }
        }
    }

    function gg(c, a) {
        function n(e, t, n, r) {
            var o, i;
            (o = new j.XMLHttpRequest).open("POST", a.url), o.withCredentials = a.credentials, o.upload.onprogress = function (e) {
                r(e.loaded / e.total * 100)
            }, o.onerror = function () {
                n("Image upload failed due to a XHR Transport error. Code: " + o.status)
            }, o.onload = function () {
                var e;
                o.status < 200 || 300 <= o.status ? n("HTTP Error: " + o.status) : (e = JSON.parse(o.responseText)) && "string" == typeof e.location ? t(function (e, t) {
                    return e ? e.replace(/\/$/, "") + "/" + t.replace(/^\//, "") : t
                }(a.basePath, e.location)) : n("Invalid JSON: " + o.responseText)
            }, (i = new j.FormData).append("file", e.blob(), e.filename()), o.send(i)
        }

        function s(e, t) {
            return {url: t, blobInfo: e, status: !0}
        }

        function l(e, t) {
            return {url: "", blobInfo: e, status: !1, error: t}
        }

        function f(e, t) {
            Jn.each(o[e], function (e) {
                e(t)
            }), delete o[e]
        }

        function r(e, t) {
            return e = Jn.grep(e, function (e) {
                return !c.isUploaded(e.blobUri())
            }), xn.all(Jn.map(e, function (e) {
                return c.isPending(e.blobUri()) ? function (e) {
                    var t = e.blobUri();
                    return new xn(function (e) {
                        o[t] = o[t] || [], o[t].push(e)
                    })
                }(e) : function (i, a, u) {
                    return c.markPending(i.blobUri()), new xn(function (t) {
                        function e() {
                        }

                        var n;
                        try {
                            var r = function () {
                                n && (n.close(), e)
                            };
                            a(i, function (e) {
                                r(), c.markUploaded(i.blobUri(), e), f(i.blobUri(), s(i, e)), t(s(i, e))
                            }, function (e) {
                                r(), c.removeFailed(i.blobUri()), f(i.blobUri(), l(i, e)), t(l(i, e))
                            }, function (e) {
                                e < 0 || 100 < e || (n = n || u()).progressBar.value(e)
                            })
                        } catch (o) {
                            t(l(i, o.message))
                        }
                    })
                }(e, a.handler, t)
            }))
        }

        var o = {};
        return !1 === P(a.handler) && (a.handler = n), {
            upload: function (e, t) {
                return !a.url && function (e) {
                    return e === n
                }(a.handler) ? new xn(function (e) {
                    e([])
                }) : r(e, t)
            }
        }
    }

    function pg(o) {
        function t(t) {
            return function (e) {
                return o.selection ? t(e) : []
            }
        }

        function r(e, t, n) {
            for (var r = 0; -1 !== (r = e.indexOf(t, r)) && (e = e.substring(0, r) + n + e.substr(r + t.length), r += n.length - t.length + 1), -1 !== r;) ;
            return e
        }

        function i(e, t, n) {
            return e = r(e, 'src="' + t + '"', 'src="' + n + '"'), e = r(e, 'data-mce-src="' + t + '"', 'data-mce-src="' + n + '"')
        }

        function n(t, n) {
            U(o.undoManager.data, function (e) {
                "fragmented" === e.type ? e.fragments = X(e.fragments, function (e) {
                    return i(e, t, n)
                }) : e.content = i(e.content, t, n)
            })
        }

        function a() {
            return o.notificationManager.open({
                text: o.translate("Image uploading..."),
                type: "info",
                timeout: -1,
                progressBar: !0
            })
        }

        function u(e, t) {
            h.removeByUri(e.src), n(e.src, t), o.$(e).attr({
                src: bs(o) ? function (e) {
                    return e + (-1 === e.indexOf("?") ? "?" : "&") + (new Date).getTime()
                }(t) : t, "data-mce-src": o.convertURL(t, "src")
            })
        }

        function c(n) {
            return f = f || gg(m, {
                url: ws(o),
                basePath: xs(o),
                credentials: zs(o),
                handler: Es(o)
            }), p().then(t(function (r) {
                var e = X(r, function (e) {
                    return e.blobInfo
                });
                return f.upload(e, a).then(t(function (e) {
                    var t = X(e, function (e, t) {
                        var n = r[t].image;
                        return e.status && Cs(o) ? u(n, e.url) : e.error && fh.uploadError(o, e.error), {
                            element: n,
                            status: e.status
                        }
                    });
                    return n && n(t), t
                }))
            }))
        }

        function e(e) {
            if (ys(o)) return c(e)
        }

        function s(t) {
            return !1 !== b(g, function (e) {
                return e(t)
            }) && (0 !== t.getAttribute("src").indexOf("data:") || vs(o)(t))
        }

        function l(e) {
            return e.replace(/src="(blob:[^"]+)"/g, function (e, n) {
                var t = m.getResultUri(n);
                if (t) return 'src="' + t + '"';
                var r = h.getByUri(n);
                return (r = r || y(o.editorManager.get(), function (e, t) {
                    return e || t.editorUpload && t.editorUpload.blobCache.getByUri(n)
                }, null)) ? 'src="data:' + r.blob().type + ";base64," + r.base64() + '"' : e
            })
        }

        var f, d, h = function () {
            var n = [], o = function (e) {
                var t, n;
                if (!e.blob || !e.base64) throw new Error("blob and base64 representations of the image are required for BlobInfo to be created");
                return t = e.id || Qg("blobid"), n = e.name || t, {
                    id: $(t),
                    name: $(n),
                    filename: $(n + "." + function (e) {
                        return {
                            "image/jpeg": "jpg",
                            "image/jpg": "jpg",
                            "image/gif": "gif",
                            "image/png": "png"
                        }[e.toLowerCase()] || "dat"
                    }(e.blob.type)),
                    blob: $(e.blob),
                    base64: $(e.base64),
                    blobUri: $(e.blobUri || j.URL.createObjectURL(e.blob)),
                    uri: $(e.uri)
                }
            }, t = function (t) {
                return e(function (e) {
                    return e.id() === t
                })
            }, e = function (e) {
                return G(n, e)[0]
            };
            return {
                create: function (e, t, n, r) {
                    if (K(e)) return o({id: e, name: r, blob: t, base64: n});
                    if (_(e)) return o(e);
                    throw new Error("Unknown input type")
                }, add: function (e) {
                    t(e.id()) || n.push(e)
                }, get: t, getByUri: function (t) {
                    return e(function (e) {
                        return e.blobUri() === t
                    })
                }, findFirst: e, removeByUri: function (t) {
                    n = G(n, function (e) {
                        return e.blobUri() !== t || (j.URL.revokeObjectURL(e.blobUri()), !1)
                    })
                }, destroy: function () {
                    U(n, function (e) {
                        j.URL.revokeObjectURL(e.blobUri())
                    }), n = []
                }
            }
        }(), m = function v() {
            function n(e, t) {
                return {status: e, resultUri: t}
            }

            function t(e) {
                return e in r
            }

            var r = {};
            return {
                hasBlobUri: t, getResultUri: function (e) {
                    var t = r[e];
                    return t ? t.resultUri : null
                }, isPending: function (e) {
                    return !!t(e) && 1 === r[e].status
                }, isUploaded: function (e) {
                    return !!t(e) && 2 === r[e].status
                }, markPending: function (e) {
                    r[e] = n(1, null)
                }, markUploaded: function (e, t) {
                    r[e] = n(2, t)
                }, removeFailed: function (e) {
                    delete r[e]
                }, destroy: function () {
                    r = {}
                }
            }
        }(), g = [], p = function () {
            return (d = d || mg(m, h)).findAll(o.getBody(), s).then(t(function (e) {
                return e = G(e, function (e) {
                    return "string" != typeof e || (fh.displayError(o, e), !1)
                }), U(e, function (e) {
                    n(e.image.src, e.blobInfo.blobUri()), e.image.src = e.blobInfo.blobUri(), e.image.removeAttribute("data-mce-src")
                }), e
            }))
        };
        return o.on("SetContent", function () {
            ys(o) ? e() : p()
        }), o.on("RawSaveContent", function (e) {
            e.content = l(e.content)
        }), o.on("GetContent", function (e) {
            e.source_view || "raw" === e.format || (e.content = l(e.content))
        }), o.on("PostRender", function () {
            o.parser.addNodeFilter("img", function (e) {
                U(e, function (e) {
                    var t = e.attr("src");
                    if (!h.getByUri(t)) {
                        var n = m.getResultUri(t);
                        n && e.attr("src", n)
                    }
                })
            })
        }), {
            blobCache: h,
            addFilter: function (e) {
                g.push(e)
            },
            uploadImages: c,
            uploadImagesAuto: e,
            scanForImages: p,
            destroy: function () {
                h.destroy(), m.destroy(), d = f = null
            }
        }
    }

    function vg(e, t, n) {
        var r = e.formatter.get(n);
        if (r) for (var o = 0; o < r.length; o++) if (!1 === r[o].inherit && e.dom.is(t, r[o].selector)) return !0;
        return !1
    }

    function yg(t, e, n, r) {
        var o = t.dom.getRoot();
        return e !== o && (e = t.dom.getParent(e, function (e) {
            return !!vg(t, e, n) || (e.parentNode === o || !!op(t, e, n, r, !0))
        }), op(t, e, n, r))
    }

    function bg(e, t, n) {
        return !!rp(t, n.inline) || (!!rp(t, n.block) || (n.selector ? 1 === t.nodeType && e.is(t, n.selector) : void 0))
    }

    function Cg(e, t, n, r, o, i) {
        var a, u, c, s = n[r];
        if (n.onmatch) return n.onmatch(t, n, r);
        if (s) if ("undefined" == typeof s.length) {
            for (a in s) if (s.hasOwnProperty(a)) {
                if (u = "attributes" === r ? e.getAttrib(t, a) : yl(e, t, a), o && !u && !n.exact) return;
                if ((!o || n.exact) && !rp(u, vl(e, gl(s[a], i), a))) return
            }
        } else for (c = 0; c < s.length; c++) if ("attributes" === r ? e.getAttrib(t, s[c]) : yl(e, t, s[c])) return n;
        return n
    }

    function wg(e, t, n, r) {
        var o;
        return r ? yg(e, r, t, n) : (r = e.selection.getNode(), !!yg(e, r, t, n) || !((o = e.selection.getStart()) === r || !yg(e, o, t, n)))
    }

    function xg(r, o, i) {
        var e, a = [], u = {};
        return e = r.selection.getStart(), r.dom.getParent(e, function (e) {
            var t, n;
            for (t = 0; t < o.length; t++) n = o[t], !u[n] && op(r, e, n, i) && (u[n] = !0, a.push(n))
        }, r.dom.getRoot()), a
    }

    function zg(e, t) {
        var n, r, o, i, a, u = e.formatter.get(t), c = e.dom;
        if (u) for (n = e.selection.getStart(), r = Cl(c, n), i = u.length - 1; 0 <= i; i--) {
            if (!(a = u[i].selector) || u[i].defaultBlock) return !0;
            for (o = r.length - 1; 0 <= o; o--) if (c.is(r[o], a)) return !0
        }
        return !1
    }

    function Eg(e, t) {
        return e.splitText(t)
    }

    function Ng(e) {
        var t = e.startContainer, n = e.startOffset, r = e.endContainer,
            o = e.endOffset;
        return t === r && en.isText(t) ? 0 < n && n < t.nodeValue.length && (t = (r = Eg(t, n)).previousSibling, n < o ? (t = r = Eg(r, o -= n).previousSibling, o = r.nodeValue.length, n = 0) : o = 0) : (en.isText(t) && 0 < n && n < t.nodeValue.length && (t = Eg(t, n), n = 0), en.isText(r) && 0 < o && o < r.nodeValue.length && (o = (r = Eg(r, o).previousSibling).nodeValue.length)), {
            startContainer: t,
            startOffset: n,
            endContainer: r,
            endOffset: o
        }
    }

    function Sg(e, t, n) {
        if (0 !== n) {
            var r = e.data.slice(t, t + n), o = t + n >= e.data.length,
                i = 0 === t;
            e.replaceData(t, n, function (n, r, o) {
                return y(n, function (e, t) {
                    return cl(t) || Yl(t) ? e.previousCharIsSpace || "" === e.str && r || e.str.length === n.length - 1 && o ? {
                        previousCharIsSpace: !1,
                        str: e.str + $r
                    } : {
                        previousCharIsSpace: !0,
                        str: e.str + " "
                    } : {previousCharIsSpace: !1, str: e.str + t}
                }, {previousCharIsSpace: !1, str: ""}).str
            }(r, i, o))
        }
    }

    function kg(e, t) {
        var n = e.data.slice(t), r = n.length - function (e) {
            return e.replace(/^\s+/g, "")
        }(n).length;
        return Sg(e, t, r)
    }

    function Tg(e, t) {
        var n = at.fromDom(e);
        return function (e, t, n) {
            return ka(e, t, n).isSome()
        }(at.fromDom(t), "pre,code", d(ve, n))
    }

    function Ag(e, t) {
        return $a(t) && !1 === function (e, t) {
            return en.isText(t) && /^[ \t\r\n]*$/.test(t.data) && !1 === Tg(e, t)
        }(e, t) || function (e) {
            return en.isElement(e) && "A" === e.nodeName && e.hasAttribute("name")
        }(t) || ip(t)
    }

    function Mg(e, t) {
        return function (e, t) {
            var n = e.container(), r = e.offset();
            return !1 === Ic.isTextPosition(e) && n === t.parentNode && r > Ic.before(t).offset()
        }(t, e) ? Ic(t.container(), t.offset() - 1) : t
    }

    function Rg(e) {
        return $a(e.previousSibling) ? D.some(function (e) {
            return en.isText(e) ? Ic(e, e.data.length) : Ic.after(e)
        }(e.previousSibling)) : e.previousSibling ? ql.lastPositionIn(e.previousSibling) : D.none()
    }

    function Dg(e) {
        return $a(e.nextSibling) ? D.some(function (e) {
            return en.isText(e) ? Ic(e, 0) : Ic.before(e)
        }(e.nextSibling)) : e.nextSibling ? ql.firstPositionIn(e.nextSibling) : D.none()
    }

    function _g(e, t) {
        return Rg(t).orThunk(function () {
            return Dg(t)
        }).orThunk(function () {
            return function (e, t) {
                var n = Ic.before(t.previousSibling ? t.previousSibling : t.parentNode);
                return ql.prevPosition(e, n).fold(function () {
                    return ql.nextPosition(e, Ic.after(t))
                }, D.some)
            }(e, t)
        })
    }

    function Og(e, t) {
        return Dg(t).orThunk(function () {
            return Rg(t)
        }).orThunk(function () {
            return function (e, t) {
                return ql.nextPosition(e, Ic.after(t)).fold(function () {
                    return ql.prevPosition(e, Ic.before(t))
                }, D.some)
            }(e, t)
        })
    }

    function Hg(e, t, n) {
        return function (e, t, n) {
            return e ? Og(t, n) : _g(t, n)
        }(e, t, n).map(d(Mg, n))
    }

    function Bg(t, n, e) {
        e.fold(function () {
            t.focus()
        }, function (e) {
            t.selection.setRng(e.toRange(), n)
        })
    }

    function Pg(e, t) {
        return t && e.schema.getBlockElements().hasOwnProperty(He(t))
    }

    function Lg(e) {
        if (cp(e)) {
            var t = at.fromHtml('<br data-mce-bogus="1">');
            return _e(e), Bt(e, t), D.some(Ic.before(t.dom()))
        }
        return D.none()
    }

    function Vg(e, t, a) {
        var n = we(e).filter(Vt), r = xe(e).filter(Vt);
        return Pt(e), function (e, t, n, r) {
            return e.isSome() && t.isSome() && n.isSome() ? D.some(r(e.getOrDie(), t.getOrDie(), n.getOrDie())) : D.none()
        }(n, r, t, function (e, t, n) {
            var r = e.dom(), o = t.dom(), i = r.data.length;
            return function (e, t, n) {
                var r = le(e.data).length;
                e.appendData(t.data), Pt(at.fromDom(t)), n && kg(e, r)
            }(r, o, a), n.container() === o ? Ic(r, i) : n
        }).orThunk(function () {
            return a && (n.each(function (e) {
                return function (e, t) {
                    var n = e.data.slice(0, t), r = n.length - le(n).length;
                    return Sg(e, t - r, r)
                }(e.dom(), e.dom().length)
            }), r.each(function (e) {
                return kg(e.dom(), 0)
            })), t
        })
    }

    function Ig(e) {
        return 0 < function (e) {
            for (var t = []; e;) {
                if (3 === e.nodeType && e.nodeValue !== lp || 1 < e.childNodes.length) return [];
                1 === e.nodeType && t.push(e), e = e.firstChild
            }
            return t
        }(e).length
    }

    function Fg(e) {
        if (e) {
            var t = new Ui(e, e);
            for (e = t.current(); e; e = t.next()) if (en.isText(e)) return e
        }
        return null
    }

    function Ug(e) {
        var t = at.fromTag("span");
        return Xe(t, {
            id: fp,
            "data-mce-bogus": "1",
            "data-mce-type": "format-caret"
        }), e && Bt(t, at.fromText(lp)), t
    }

    function jg(e, t, n) {
        void 0 === n && (n = !0);
        var r = e.dom, o = e.selection;
        if (Ig(t)) sp(e, !1, at.fromDom(t), n); else {
            var i = o.getRng(), a = r.getParent(t, r.isBlock),
                u = function (e) {
                    var t = Fg(e);
                    return t && t.nodeValue.charAt(0) === lp && t.deleteData(0, 1), t
                }(t);
            i.startContainer === u && 0 < i.startOffset && i.setStart(u, i.startOffset - 1), i.endContainer === u && 0 < i.endOffset && i.setEnd(u, i.endOffset - 1), r.remove(t, !0), a && r.isEmpty(a) && tp(at.fromDom(a)), o.setRng(i)
        }
    }

    function qg(e, t, n) {
        void 0 === n && (n = !0);
        var r = e.dom, o = e.selection;
        if (t) jg(e, t, n); else if (!(t = fc(e.getBody(), o.getStart()))) for (; t = r.get(fp);) jg(e, t, !1)
    }

    function $g(e, t, n) {
        var r = e.dom, o = r.getParent(n, d(hl, e));
        o && r.isEmpty(o) ? n.parentNode.replaceChild(t, n) : (ep(at.fromDom(n)), r.isEmpty(n) ? n.parentNode.replaceChild(t, n) : r.insertAfter(t, n))
    }

    function Wg(e, t) {
        return e.appendChild(t), t
    }

    function Kg(e, t) {
        var n = m(e, function (e, t) {
            return Wg(e, t.cloneNode(!1))
        }, t);
        return Wg(n, n.ownerDocument.createTextNode(lp))
    }

    function Xg(t) {
        t.on("mouseup keydown", function (e) {
            !function (e, t) {
                var n = e.selection, r = e.getBody();
                qg(e, null, !1), 8 !== t && 46 !== t || !n.isCollapsed() || n.getStart().innerHTML !== lp || qg(e, fc(r, n.getStart())), 37 !== t && 39 !== t || qg(e, fc(r, n.getStart()))
            }(t, e.keyCode)
        })
    }

    function Yg(e, t) {
        return e.schema.getTextInlineElements().hasOwnProperty(He(t)) && !lc(t.dom()) && !en.isBogus(t.dom())
    }

    var Gg, Zg, Jg = 0, Qg = function (e) {
            return e + Jg++ + function () {
                function e() {
                    return Math.round(4294967295 * Math.random()).toString(36)
                }

                return "s" + (new Date).getTime().toString(36) + e() + e() + e()
            }()
        }, ep = function (e) {
            var t = wa(e, "br"), n = G(function (e) {
                for (var t = [], n = e.dom(); n;) t.push(at.fromDom(n)), n = n.lastChild;
                return t
            }(e).slice(-1), tr);
            t.length === n.length && U(n, Pt)
        }, tp = function (e) {
            _e(e), Bt(e, at.fromHtml('<br data-mce-bogus="1">'))
        }, np = function (n) {
            Te(n).each(function (t) {
                we(t).each(function (e) {
                    ur(n) && tr(t) && ur(e) && Pt(t)
                })
            })
        }, rp = pl, op = function (e, t, n, r, o) {
            var i, a, u, c, s = e.formatter.get(n), l = e.dom;
            if (s && t) for (a = 0; a < s.length; a++) if (i = s[a], bg(e.dom, t, i) && Cg(l, t, i, "attributes", o, r) && Cg(l, t, i, "styles", o, r)) {
                if (c = i.classes) for (u = 0; u < c.length; u++) if (!e.dom.hasClass(t, c[u])) return;
                return i
            }
        }, ip = en.hasAttribute("data-mce-bookmark"),
        ap = en.hasAttribute("data-mce-bogus"),
        up = en.hasAttributeValue("data-mce-bogus", "all"),
        cp = function (e, t) {
            return void 0 === t && (t = !0), function (e, t) {
                var n, r = 0;
                if (Ag(e, e)) return !1;
                if (!(n = e.firstChild)) return !0;
                var o = new Ui(n, e);
                do {
                    if (t) {
                        if (up(n)) {
                            n = o.next(!0);
                            continue
                        }
                        if (ap(n)) {
                            n = o.next();
                            continue
                        }
                    }
                    if (en.isBr(n)) r++, n = o.next(); else {
                        if (Ag(e, n)) return !1;
                        n = o.next()
                    }
                } while (n);
                return r <= 1
            }(e.dom(), t)
        }, sp = function (t, n, e, r) {
            void 0 === r && (r = !0);
            var o = Hg(n, t.getBody(), e.dom()), i = Na(e, d(Pg, t), function (t) {
                return function (e) {
                    return e.dom() === t
                }
            }(t.getBody())), a = Vg(e, o, function (e, t) {
                return te(e.schema.getTextInlineElements(), He(t))
            }(t, e));
            t.dom.isEmpty(t.getBody()) ? (t.setContent(""), t.selection.setCursorLocation()) : i.bind(Lg).fold(function () {
                r && Bg(t, n, a)
            }, function (e) {
                r && Bg(t, n, D.some(e))
            })
        }, lp = gu.ZWSP, fp = "_mce_caret", dp = {}, hp = Yn.filter, mp = Yn.each;
    Zg = function (e) {
        var t, n, r = e.selection.getRng();
        t = en.matchNodeNames(["pre"]), r.collapsed || (n = e.selection.getSelectedBlocks(), mp(hp(hp(n, t), function (e) {
            return t(e.previousSibling) && -1 !== Yn.indexOf(n, e.previousSibling)
        }), function (e) {
            !function (e, t) {
                Fi(t).remove(), Fi(e).append("<br><br>").append(t.childNodes)
            }(e.previousSibling, e)
        }))
    }, dp[Gg = "pre"] || (dp[Gg] = []), dp[Gg].push(Zg);

    function gp(o) {
        this.compare = function (e, t) {
            if (e.nodeName !== t.nodeName) return !1;

            function n(n) {
                var r = {};
                return Dp(o.getAttribs(n), function (e) {
                    var t = e.nodeName.toLowerCase();
                    0 !== t.indexOf("_") && "style" !== t && 0 !== t.indexOf("data-") && (r[t] = o.getAttrib(n, t))
                }), r
            }

            function r(e, t) {
                var n, r;
                for (r in e) if (e.hasOwnProperty(r)) {
                    if (void 0 === (n = t[r])) return !1;
                    if (e[r] !== n) return !1;
                    delete t[r]
                }
                for (r in t) if (t.hasOwnProperty(r)) return !1;
                return !0
            }

            return !!r(n(e), n(t)) && (!!r(o.parseStyle(o.getAttrib(e, "style")), o.parseStyle(o.getAttrib(t, "style"))) && (!Xl(e) && !Xl(t)))
        }
    }

    function pp(e, t, n) {
        return e.isChildOf(t, n) && t !== n && !e.isBlock(n)
    }

    function vp(e, t, n) {
        var r, o;
        if (r = t[n ? "startContainer" : "endContainer"], o = t[n ? "startOffset" : "endOffset"], en.isElement(r)) {
            var i = r.childNodes.length - 1;
            !n && o && o--, r = r.childNodes[i < o ? i : o]
        }
        return en.isText(r) && n && o >= r.nodeValue.length && (r = new Ui(r, e.getBody()).next() || r), en.isText(r) && !n && 0 === o && (r = new Ui(r, e.getBody()).prev() || r), r
    }

    function yp(e, t, n, r) {
        var o = e.create(n, r);
        return t.parentNode.insertBefore(o, t), o.appendChild(t), o
    }

    function bp(e, t, n, r, o) {
        var i = at.fromDom(t), a = at.fromDom(e.create(r, o)),
            u = n ? Ee(i) : ze(i);
        return De(a, u), n ? (Ae(i, a), Re(a, i)) : (Me(i, a), Bt(a, i)), a.dom()
    }

    function Cp(e, t, n, r) {
        return !(t = dl(t, n, r)) || "BR" === t.nodeName || e.isBlock(t)
    }

    function wp(e, r, o, t, i) {
        var n, a = e.dom;
        if (!function (e, t, n) {
            return !!Hp(t, n.inline) || (!!Hp(t, n.block) || (n.selector ? en.isElement(t) && e.is(t, n.selector) : void 0))
        }(a, t, r) && !function (e, t) {
            return t.links && "A" === e.nodeName
        }(t, r)) return !1;
        var u = t;
        if ("all" !== r.remove) {
            Op(r.styles, function (e, t) {
                e = vl(a, gl(e, o), t), "number" == typeof t && (t = e, i = null), !r.remove_similar && i && !Hp(yl(a, i, t), e) || a.setStyle(u, t, ""), n = !0
            }), n && "" === a.getAttrib(u, "style") && (u.removeAttribute("style"), u.removeAttribute("data-mce-style")), Op(r.attributes, function (e, t) {
                var n;
                if (e = gl(e, o), "number" == typeof t && (t = e, i = null), r.remove_similar || !i || Hp(a.getAttrib(i, t), e)) {
                    if ("class" === t && (e = a.getAttrib(u, t)) && (n = "", Op(e.split(/\s+/), function (e) {
                        /mce\-\w+/.test(e) && (n += (n ? " " : "") + e)
                    }), n)) return void a.setAttrib(u, t, n);
                    "class" === t && u.removeAttribute("className"), _p.test(t) && u.removeAttribute("data-mce-" + t), u.removeAttribute(t)
                }
            }), Op(r.classes, function (e) {
                e = gl(e, o), i && !a.hasClass(i, e) || a.removeClass(u, e)
            });
            for (var c = a.getAttribs(u), s = 0; s < c.length; s++) {
                var l = c[s].nodeName;
                if (0 !== l.indexOf("_") && 0 !== l.indexOf("data-")) return !1
            }
        }
        return "none" !== r.remove ? (function (t, e, n) {
            var r, o = e.parentNode, i = t.dom, a = us(t);
            n.block && (a ? o === i.getRoot() && (n.list_block && Hp(e, n.list_block) || Op(Jn.grep(e.childNodes), function (e) {
                ml(t, a, e.nodeName.toLowerCase()) ? r ? r.appendChild(e) : (r = yp(i, e, a), i.setAttribs(r, t.settings.forced_root_block_attrs)) : r = 0
            })) : i.isBlock(e) && !i.isBlock(o) && (Cp(i, e, !1) || Cp(i, e.firstChild, !0, !0) || e.insertBefore(i.create("br"), e.firstChild), Cp(i, e, !0) || Cp(i, e.lastChild, !1, !0) || e.appendChild(i.create("br")))), n.selector && n.inline && !Hp(n.inline, e) || i.remove(e, !0)
        }(e, u, r), !0) : void 0
    }

    function xp(u, n, a, e, r) {
        function c(e) {
            var t = function (n, e, r, o, i) {
                var a;
                return Op(Cl(n.dom, e.parentNode).reverse(), function (e) {
                    var t;
                    a || "_start" === e.id || "_end" === e.id || (t = op(n, e, r, o, i)) && !1 !== t.split && (a = e)
                }), a
            }(u, e, n, a, r);
            return function (e, t, n, r, o, i, a, u) {
                var c, s, l, f, d, h, m = e.dom;
                if (n) {
                    for (h = n.parentNode, c = r.parentNode; c && c !== h; c = c.parentNode) {
                        for (s = m.clone(c, !1), d = 0; d < t.length; d++) if (wp(e, t[d], u, s, s)) {
                            s = 0;
                            break
                        }
                        s && (l && s.appendChild(l), f = f || s, l = s)
                    }
                    !i || a.mixed && m.isBlock(n) || (r = m.split(n, r)), l && (o.parentNode.insertBefore(l, o), f.appendChild(o))
                }
                return r
            }(u, l, t, e, e, !0, f, a)
        }

        function s(e) {
            var t = h.get(e ? "_start" : "_end"),
                n = t[e ? "firstChild" : "lastChild"];
            return function (e) {
                return Xl(e) && en.isElement(e) && ("_start" === e.id || "_end" === e.id)
            }(n) && (n = n[e ? "firstChild" : "lastChild"]), en.isText(n) && 0 === n.data.length && (n = e ? t.previousSibling || t.nextSibling : t.nextSibling || t.previousSibling), h.remove(t, !0), n
        }

        function t(e) {
            var t, n, r = e.commonAncestorContainer, o = Al(u, e, l, !0);
            if (f.split) {
                if (o = Ng(o), (t = vp(u, o, !0)) !== (n = vp(u, o))) {
                    if (/^(TR|TH|TD)$/.test(t.nodeName) && t.firstChild && (t = "TR" === t.nodeName ? t.firstChild.firstChild || t : t.firstChild || t), r && /^T(HEAD|BODY|FOOT|R)$/.test(r.nodeName) && function (e) {
                        return /^(TH|TD)$/.test(e.nodeName)
                    }(n) && n.firstChild && (n = n.firstChild || n), pp(h, t, n)) {
                        var i = D.from(t.firstChild).getOr(t);
                        return c(bp(h, i, !0, "span", {
                            id: "_start",
                            "data-mce-type": "bookmark"
                        })), void s(!0)
                    }
                    if (pp(h, n, t)) {
                        i = D.from(n.lastChild).getOr(n);
                        return c(bp(h, i, !1, "span", {
                            id: "_end",
                            "data-mce-type": "bookmark"
                        })), void s(!1)
                    }
                    t = yp(h, t, "span", {
                        id: "_start",
                        "data-mce-type": "bookmark"
                    }), n = yp(h, n, "span", {
                        id: "_end",
                        "data-mce-type": "bookmark"
                    });
                    var a = h.createRng();
                    a.setStartAfter(t), a.setEndBefore(n), nf(h, a, function (e) {
                        U(e, function (e) {
                            Xl(e) || Xl(e.parentNode) || c(e)
                        })
                    }), c(t), c(n), t = s(!0), n = s()
                } else t = n = c(t);
                o.startContainer = t.parentNode ? t.parentNode : t, o.startOffset = h.nodeIndex(t), o.endContainer = n.parentNode ? n.parentNode : n, o.endOffset = h.nodeIndex(n) + 1
            }
            nf(h, o, function (e) {
                Op(e, function (e) {
                    g(e), en.isElement(e) && "underline" === u.dom.getStyle(e, "text-decoration") && e.parentNode && "underline" === bl(h, e.parentNode) && wp(u, {
                        deep: !1,
                        exact: !0,
                        inline: "span",
                        styles: {textDecoration: "underline"}
                    }, null, e)
                })
            })
        }

        var o, i, l = u.formatter.get(n), f = l[0], d = !0, h = u.dom,
            m = u.selection, g = function (e) {
                var t, n, r, o, i;
                if (en.isElement(e) && h.getContentEditable(e) && (o = d, d = "true" === h.getContentEditable(e), i = !0), t = Jn.grep(e.childNodes), d && !i) for (n = 0, r = l.length; n < r && !wp(u, l[n], a, e, e); n++) ;
                if (f.deep && t.length) {
                    for (n = 0, r = t.length; n < r; n++) g(t[n]);
                    i && (d = o)
                }
            };
        if (e) ll(e) ? ((i = h.createRng()).setStartBefore(e), i.setEndAfter(e), t(i)) : t(e); else if ("false" !== h.getContentEditable(m.getNode())) m.isCollapsed() && f.inline && !h.select("td[data-mce-selected],th[data-mce-selected]").length ? function (e, t, n, r) {
            var o, i, a, u, c, s, l, f = e.dom, d = e.selection, h = [],
                m = d.getRng();
            for (o = m.startContainer, i = m.startOffset, 3 === (c = o).nodeType && (i !== o.nodeValue.length && (u = !0), c = c.parentNode); c;) {
                if (op(e, c, t, n, r)) {
                    s = c;
                    break
                }
                c.nextSibling && (u = !0), h.push(c), c = c.parentNode
            }
            if (s) if (u) {
                a = d.getBookmark(), m.collapse(!0);
                var g = Al(e, m, e.formatter.get(t), !0);
                g = Ng(g), e.formatter.remove(t, n, g), d.moveToBookmark(a)
            } else {
                l = fc(e.getBody(), s);
                var p = Ug(!1).dom(), v = Kg(h, p);
                $g(e, p, l || s), jg(e, l, !1), d.setCursorLocation(v, 1), f.isEmpty(s) && f.remove(s)
            }
        }(u, n, a, r) : (o = Kc.getPersistentBookmark(u.selection, !0), t(m.getRng()), m.moveToBookmark(o), f.inline && wg(u, n, a, m.getStart()) && fl(h, m, m.getRng()), u.nodeChanged()); else {
            e = m.getNode();
            for (var p = 0, v = l.length; p < v && (!l[p].ceFalseOverride || !wp(u, l[p], a, e, e)); p++) ;
        }
    }

    function zp(e) {
        return en.isElement(e) && !Xl(e) && !lc(e) && !en.isBogus(e)
    }

    function Ep(e, t) {
        var n;
        for (n = e; n; n = n[t]) {
            if (en.isText(n) && 0 !== n.nodeValue.length) return e;
            if (en.isElement(n) && !Xl(n)) return n
        }
        return e
    }

    function Np(e, t, n) {
        var r, o, i = new gp(e);
        if (t && n && (t = Ep(t, "previousSibling"), n = Ep(n, "nextSibling"), i.compare(t, n))) {
            for (r = t.nextSibling; r && r !== n;) r = (o = r).nextSibling, t.appendChild(o);
            return e.remove(n), Jn.each(Jn.grep(n.childNodes), function (e) {
                t.appendChild(e)
            }), t
        }
        return n
    }

    function Sp(n, e) {
        return d(function (e, t) {
            return !(!t || !yl(n, t, e))
        }, e)
    }

    function kp(r, e, t) {
        return d(function (e, t, n) {
            r.setStyle(n, e, t), "" === n.getAttribute("style") && n.removeAttribute("style"), Lp(r, n)
        }, e, t)
    }

    function Tp(e, t) {
        var n;
        1 === t.nodeType && t.parentNode && 1 === t.parentNode.nodeType && (n = bl(e, t.parentNode), e.getStyle(t, "color") && n ? e.setStyle(t, "text-decoration", n) : e.getStyle(t, "text-decoration") === n && e.setStyle(t, "text-decoration", null))
    }

    function Ap(n, e, r, o) {
        Bp(e, function (t) {
            Bp(n.dom.select(t.inline, o), function (e) {
                zp(e) && wp(n, t, r, e, t.exact ? e : null)
            }), function (r, e, t) {
                if (e.clear_child_styles) {
                    var n = e.links ? "*:not(a)" : "*";
                    Bp(r.select(n, t), function (n) {
                        zp(n) && Bp(e.styles, function (e, t) {
                            r.setStyle(n, t, "")
                        })
                    })
                }
            }(n.dom, t, o)
        })
    }

    function Mp(t) {
        var n = Ic.fromRangeStart(t), r = Ic.fromRangeEnd(t),
            o = t.commonAncestorContainer;
        return ql.fromPosition(!1, o, r).map(function (e) {
            return !Tc(n, r, o) && Tc(n, e, o) ? function (e, t, n, r) {
                var o = j.document.createRange();
                return o.setStart(e, t), o.setEnd(n, r), o
            }(n.container(), n.offset(), e.container(), e.offset()) : t
        }).getOr(t)
    }

    function Rp(e, t, n, r, o) {
        return null === t.get() && function (t, n) {
            var r = ut({});
            t.set({}), n.on("NodeChange", function (e) {
                Up(n, e.element, r, t.get())
            })
        }(t, e), function (e, t, n, r) {
            var o = e.get();
            U(t.split(","), function (e) {
                o[e] || (o[e] = {
                    similar: r,
                    callbacks: []
                }), o[e].callbacks.push(n)
            }), e.set(o)
        }(t, n, r, o), {
            unbind: function () {
                return function (e, t, n) {
                    var r = e.get();
                    U(t.split(","), function (e) {
                        r[e].callbacks = G(r[e].callbacks, function (e) {
                            return e !== n
                        }), 0 === r[e].callbacks.length && delete r[e]
                    }), e.set(r)
                }(t, n, r)
            }
        }
    }

    var Dp = Jn.each, _p = /^(src|href|style)$/, Op = Jn.each, Hp = pl,
        Bp = Jn.each, Pp = function (e, t, n) {
            Bp(e.childNodes, function (e) {
                zp(e) && (t(e) && n(e), e.hasChildNodes() && Pp(e, t, n))
            })
        }, Lp = function (e, t) {
            "SPAN" === t.nodeName && 0 === e.getAttribs(t).length && e.remove(t, !0)
        }, Vp = function (e) {
            return e.collapsed ? e : Mp(e)
        }, Ip = Jn.each, Fp = function (m, g, p, r) {
            function v(n, e) {
                if (e = e || C, n) {
                    if (e.onformat && e.onformat(n, e, p, r), Ip(e.styles, function (e, t) {
                        i.setStyle(n, t, gl(e, p))
                    }), e.styles) {
                        var t = i.getAttrib(n, "style");
                        t && i.setAttrib(n, "data-mce-style", t)
                    }
                    Ip(e.attributes, function (e, t) {
                        i.setAttrib(n, t, gl(e, p))
                    }), Ip(e.classes, function (e) {
                        e = gl(e, p), i.hasClass(n, e) || i.addClass(n, e)
                    })
                }
            }

            function y(e, t) {
                var n = !1;
                return !!C.selector && (Ip(e, function (e) {
                    if (!("collapsed" in e && e.collapsed !== o)) return i.is(t, e.selector) && !lc(t) ? (v(t, e), !(n = !0)) : void 0
                }), n)
            }

            function e(c, e, t, s) {
                var l, f, d = [], h = !0;
                l = C.inline || C.block, f = c.create(l), v(f), nf(c, e, function (e) {
                    var a, u = function (e) {
                        var t = !1, n = h, r = e.nodeName.toLowerCase(),
                            o = e.parentNode.nodeName.toLowerCase();
                        if (en.isElement(e) && c.getContentEditable(e) && (n = h, h = "true" === c.getContentEditable(e), t = !0), pl(r, "br")) return a = 0, void (C.block && c.remove(e));
                        if (C.wrapper && op(m, e, g, p)) a = 0; else {
                            if (h && !t && C.block && !C.wrapper && hl(m, r) && ml(m, o, l)) return e = c.rename(e, l), v(e), d.push(e), void (a = 0);
                            if (C.selector) {
                                var i = y(b, e);
                                if (!C.inline || i) return void (a = 0)
                            }
                            !h || t || !ml(m, l, r) || !ml(m, o, l) || !s && 3 === e.nodeType && 1 === e.nodeValue.length && 65279 === e.nodeValue.charCodeAt(0) || lc(e) || C.inline && c.isBlock(e) ? (a = 0, Ip(Jn.grep(e.childNodes), u), t && (h = n), a = 0) : (a || (a = c.clone(f, !1), e.parentNode.insertBefore(a, e), d.push(a)), a.appendChild(e))
                        }
                    };
                    Ip(e, u)
                }), !0 === C.links && Ip(d, function (e) {
                    var t = function (e) {
                        "A" === e.nodeName && v(e, C), Ip(Jn.grep(e.childNodes), t)
                    };
                    t(e)
                }), Ip(d, function (e) {
                    function t(e) {
                        var t = !1;
                        return Ip(e.childNodes, function (e) {
                            if (function (e) {
                                return e && 1 === e.nodeType && !Xl(e) && !lc(e) && !en.isBogus(e)
                            }(e)) return t = e, !1
                        }), t
                    }

                    var n, r, o, i, a;
                    (r = 0, Ip(e.childNodes, function (e) {
                        (function (e) {
                            return e && en.isText(e) && 0 === e.length
                        })(e) || Xl(e) || r++
                    }), n = r, !(1 < d.length) && c.isBlock(e) || 0 !== n) ? (C.inline || C.wrapper) && (C.exact || 1 !== n || ((i = t(o = e)) && !Xl(i) && bg(c, i, C) && (a = c.clone(i, !1), v(a), c.replace(a, o, !0), c.remove(i, !0)), e = a || o), Ap(m, b, p, e), function (t, n, r, o, i) {
                        op(t, i.parentNode, r, o) && wp(t, n, o, i) || n.merge_with_parents && t.dom.getParent(i.parentNode, function (e) {
                            if (op(t, e, r, o)) return wp(t, n, o, i), !0
                        })
                    }(m, C, g, p, e), function (e, t, n, r) {
                        t.styles && t.styles.backgroundColor && Pp(r, Sp(e, "fontSize"), kp(e, "backgroundColor", gl(t.styles.backgroundColor, n)))
                    }(c, C, p, e), function (e, t, n, r) {
                        "sub" !== t.inline && "sup" !== t.inline || (Pp(r, Sp(e, "fontSize"), kp(e, "fontSize", "")), e.remove(e.select("sup" === t.inline ? "sub" : "sup", r), !0))
                    }(c, C, 0, e), function (e, t, n, r) {
                        r && !1 !== t.merge_siblings && (r = Np(e, dl(r), r), r = Np(e, r, dl(r, !0)))
                    }(c, C, 0, e)) : c.remove(e, !0)
                })
            }

            var t, n, b = m.formatter.get(g), C = b[0],
                o = !r && m.selection.isCollapsed(), i = m.dom, a = m.selection;
            if ("false" !== i.getContentEditable(a.getNode())) {
                if (C) {
                    if (r) ll(r) ? y(b, r) || ((n = i.createRng()).setStartBefore(r), n.setEndAfter(r), e(i, Al(m, n, b), 0, !0)) : e(i, r, 0, !0); else if (o && C.inline && !i.select("td[data-mce-selected],th[data-mce-selected]").length) !function (e, t, n) {
                        var r, o, i, a, u, c, s = e.selection;
                        a = (r = s.getRng()).startOffset, c = r.startContainer.nodeValue, (o = fc(e.getBody(), s.getStart())) && (i = Fg(o));
                        var l = /[^\s\u00a0\u00ad\u200b\ufeff]/;
                        c && 0 < a && a < c.length && l.test(c.charAt(a)) && l.test(c.charAt(a - 1)) ? (u = s.getBookmark(), r.collapse(!0), r = Al(e, r, e.formatter.get(t)), r = Ng(r), e.formatter.apply(t, n, r), s.moveToBookmark(u)) : (o && i.nodeValue === lp || (i = (o = function (e, t) {
                            return e.importNode(t, !0)
                        }(e.getDoc(), Ug(!0).dom())).firstChild, r.insertNode(o), a = 1), e.formatter.apply(t, n, o), s.setCursorLocation(i, a))
                    }(m, g, p); else {
                        var u = m.selection.getNode();
                        m.settings.forced_root_block || !b[0].defaultBlock || i.getParent(u, i.isBlock) || Fp(m, b[0].defaultBlock), m.selection.setRng(Vp(m.selection.getRng())), t = Kc.getPersistentBookmark(m.selection, !0), e(i, Al(m, a.getRng(), b)), C.styles && function (e, t, n, r) {
                            (t.styles.color || t.styles.textDecoration) && (Jn.walk(r, d(Tp, e), "childNodes"), Tp(e, r))
                        }(i, C, 0, u), a.moveToBookmark(t), fl(i, a, a.getRng()), m.nodeChanged()
                    }
                    !function (e, t) {
                        mp(dp[e], function (e) {
                            e(t)
                        })
                    }(g, m)
                }
            } else {
                r = a.getNode();
                for (var c = 0, s = b.length; c < s; c++) if (b[c].ceFalseOverride && i.is(r, b[c].selector)) return void v(r, b[c])
            }
        }, Up = function (r, e, t, n) {
            var o = J(t.get()), i = {}, a = {}, u = G(Cl(r.dom, e), function (e) {
                return 1 === e.nodeType && !e.getAttribute("data-mce-bogus")
            });
            N(n, function (e, n) {
                Jn.each(u, function (t) {
                    return r.formatter.matchNode(t, n, {}, e.similar) ? (-1 === o.indexOf(n) && (U(e.callbacks, function (e) {
                        e(!0, {node: t, format: n, parents: u})
                    }), i[n] = e.callbacks), a[n] = e.callbacks, !1) : !vg(r, t, n) && void 0
                })
            });
            var c = jp(t.get(), a, e, u);
            t.set(ne(ne({}, i), c))
        }, jp = function (e, n, r, o) {
            return A(e, function (e, t) {
                return !!te(n, t) || (U(e, function (e) {
                    e(!1, {node: r, format: t, parents: o})
                }), !1)
            }).t
        }, qp = function (r) {
            var t = {
                valigntop: [{selector: "td,th", styles: {verticalAlign: "top"}}],
                valignmiddle: [{
                    selector: "td,th",
                    styles: {verticalAlign: "middle"}
                }],
                valignbottom: [{
                    selector: "td,th",
                    styles: {verticalAlign: "bottom"}
                }],
                alignleft: [{
                    selector: "figure.image",
                    collapsed: !1,
                    classes: "align-left",
                    ceFalseOverride: !0,
                    preview: "font-family font-size"
                }, {
                    selector: "figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",
                    styles: {textAlign: "left"},
                    inherit: !1,
                    preview: !1,
                    defaultBlock: "div"
                }, {
                    selector: "img,table",
                    collapsed: !1,
                    styles: {"float": "left"},
                    preview: "font-family font-size"
                }],
                aligncenter: [{
                    selector: "figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",
                    styles: {textAlign: "center"},
                    inherit: !1,
                    preview: "font-family font-size",
                    defaultBlock: "div"
                }, {
                    selector: "figure.image",
                    collapsed: !1,
                    classes: "align-center",
                    ceFalseOverride: !0,
                    preview: "font-family font-size"
                }, {
                    selector: "img",
                    collapsed: !1,
                    styles: {
                        display: "block",
                        marginLeft: "auto",
                        marginRight: "auto"
                    },
                    preview: !1
                }, {
                    selector: "table",
                    collapsed: !1,
                    styles: {marginLeft: "auto", marginRight: "auto"},
                    preview: "font-family font-size"
                }],
                alignright: [{
                    selector: "figure.image",
                    collapsed: !1,
                    classes: "align-right",
                    ceFalseOverride: !0,
                    preview: "font-family font-size"
                }, {
                    selector: "figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",
                    styles: {textAlign: "right"},
                    inherit: !1,
                    preview: "font-family font-size",
                    defaultBlock: "div"
                }, {
                    selector: "img,table",
                    collapsed: !1,
                    styles: {"float": "right"},
                    preview: "font-family font-size"
                }],
                alignjustify: [{
                    selector: "figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",
                    styles: {textAlign: "justify"},
                    inherit: !1,
                    defaultBlock: "div",
                    preview: "font-family font-size"
                }],
                bold: [{inline: "strong", remove: "all"}, {
                    inline: "span",
                    styles: {fontWeight: "bold"}
                }, {inline: "b", remove: "all"}],
                italic: [{inline: "em", remove: "all"}, {
                    inline: "span",
                    styles: {fontStyle: "italic"}
                }, {inline: "i", remove: "all"}],
                underline: [{
                    inline: "span",
                    styles: {textDecoration: "underline"},
                    exact: !0
                }, {inline: "u", remove: "all"}],
                strikethrough: [{
                    inline: "span",
                    styles: {textDecoration: "line-through"},
                    exact: !0
                }, {inline: "strike", remove: "all"}],
                forecolor: {
                    inline: "span",
                    styles: {color: "%value"},
                    links: !0,
                    remove_similar: !0,
                    clear_child_styles: !0
                },
                hilitecolor: {
                    inline: "span",
                    styles: {backgroundColor: "%value"},
                    links: !0,
                    remove_similar: !0,
                    clear_child_styles: !0
                },
                fontname: {
                    inline: "span",
                    toggle: !1,
                    styles: {fontFamily: "%value"},
                    clear_child_styles: !0
                },
                fontsize: {
                    inline: "span",
                    toggle: !1,
                    styles: {fontSize: "%value"},
                    clear_child_styles: !0
                },
                fontsize_class: {inline: "span", attributes: {"class": "%value"}},
                blockquote: {block: "blockquote", wrapper: !0, remove: "all"},
                subscript: {inline: "sub"},
                superscript: {inline: "sup"},
                code: {inline: "code"},
                link: {
                    inline: "a",
                    selector: "a",
                    remove: "all",
                    split: !0,
                    deep: !0,
                    onmatch: function () {
                        return !0
                    },
                    onformat: function (n, e, t) {
                        Jn.each(t, function (e, t) {
                            r.setAttrib(n, t, e)
                        })
                    }
                },
                removeformat: [{
                    selector: "b,strong,em,i,font,u,strike,sub,sup,dfn,code,samp,kbd,var,cite,mark,q,del,ins",
                    remove: "all",
                    split: !0,
                    expand: !1,
                    block_expand: !0,
                    deep: !0
                }, {
                    selector: "span",
                    attributes: ["style", "class"],
                    remove: "empty",
                    split: !0,
                    expand: !1,
                    deep: !0
                }, {
                    selector: "*",
                    attributes: ["style", "class"],
                    split: !1,
                    expand: !1,
                    deep: !0
                }]
            };
            return Jn.each("p h1 h2 h3 h4 h5 h6 div address pre div dt dd samp".split(/\s/), function (e) {
                t[e] = {block: e, remove: "all"}
            }), t
        };

    function $p(e, t) {
        function c(e) {
            var t;
            return r = "string" == typeof e ? {
                name: e,
                classes: [],
                attrs: {}
            } : e, function (e, t) {
                t.classes.length && Wv.addClass(e, t.classes.join(" ")), Wv.setAttribs(e, t.attrs)
            }(t = Wv.create(r.name), r), t
        }

        var n, r, o, s = t && t.schema || Lr({}), l = function (n, e, t) {
            var r, o, i, a = 0 < e.length && e[0], u = a && a.name;
            if (i = function (e, t) {
                var n = "string" != typeof e ? e.nodeName.toLowerCase() : e,
                    r = s.getElementRule(n), o = r && r.parentsRequired;
                return !(!o || !o.length) && (t && -1 !== Jn.inArray(o, t) ? t : o[0])
            }(n, u)) u === i ? (o = e[0], e = e.slice(1)) : o = i; else if (a) o = e[0], e = e.slice(1); else if (!t) return n;
            return o && (r = c(o)).appendChild(n), t && (r || (r = Wv.create("div")).appendChild(n), Jn.each(t, function (e) {
                var t = c(e);
                r.insertBefore(t, n)
            })), l(r, e, o && o.siblings)
        };
        return e && e.length ? (r = e[0], n = c(r), (o = Wv.create("div")).appendChild(l(n, e.slice(1), r.siblings)), o) : ""
    }

    function Wp(e) {
        var t, a = {classes: [], attrs: {}};
        return "*" !== (e = a.selector = Jn.trim(e)) && (t = e.replace(/(?:([#\.]|::?)([\w\-]+)|(\[)([^\]]+)\]?)/g, function (e, t, n, r, o) {
            switch (t) {
                case"#":
                    a.attrs.id = n;
                    break;
                case".":
                    a.classes.push(n);
                    break;
                case":":
                    -1 !== Jn.inArray("checked disabled enabled read-only required".split(" "), n) && (a.attrs[n] = n)
            }
            if ("[" === r) {
                var i = o.match(/([\w\-]+)(?:\=\"([^\"]+))?/);
                i && (a.attrs[i[1]] = i[2])
            }
            return ""
        })), a.name = t || "div", a
    }

    function Kp(n, e) {
        var t, r, o, i, a, u, c = "";
        if (!1 === (u = n.settings.preview_styles)) return "";

        function s(e) {
            return e.replace(/%(\w+)/g, "")
        }

        if ("string" != typeof u && (u = "font-family font-size font-weight font-style text-decoration text-transform color background-color border border-radius outline text-shadow"), "string" == typeof e) {
            if (!(e = n.formatter.get(e))) return;
            e = e[0]
        }
        return "preview" in e && !1 === (u = e.preview) ? "" : (t = e.block || e.inline || "span", r = (i = function (e) {
            return e && "string" == typeof e ? (e = (e = e.split(/\s*,\s*/)[0]).replace(/\s*(~\+|~|\+|>)\s*/g, "$1"), Jn.map(e.split(/(?:>|\s+(?![^\[\]]+\]))/), function (e) {
                var t = Jn.map(e.split(/(?:~\+|~|\+)/), Wp), n = t.pop();
                return t.length && (n.siblings = t), n
            }).reverse()) : []
        }(e.selector)).length ? (i[0].name || (i[0].name = t), t = e.selector, $p(i, n)) : $p([t], n), o = Wv.select(t, r)[0] || r.firstChild, $v(e.styles, function (e, t) {
            (e = s(e)) && Wv.setStyle(o, t, e)
        }), $v(e.attributes, function (e, t) {
            (e = s(e)) && Wv.setAttrib(o, t, e)
        }), $v(e.classes, function (e) {
            e = s(e), Wv.hasClass(o, e) || Wv.addClass(o, e)
        }), n.fire("PreviewFormats"), Wv.setStyles(r, {
            position: "absolute",
            left: -65535
        }), n.getBody().appendChild(r), a = Wv.getStyle(n.getBody(), "fontSize", !0), a = /px$/.test(a) ? parseInt(a, 10) : 0, $v(u.split(" "), function (e) {
            var t = Wv.getStyle(o, e, !0);
            if (!("background-color" === e && /transparent|rgba\s*\([^)]+,\s*0\)/.test(t) && (t = Wv.getStyle(n.getBody(), e, !0), "#ffffff" === Wv.toHex(t).toLowerCase()) || "color" === e && "#000000" === Wv.toHex(t).toLowerCase())) {
                if ("font-size" === e && /em|%$/.test(t)) {
                    if (0 === a) return;
                    t = parseFloat(t) / (/%$/.test(t) ? 100 : 1) * a + "px"
                }
                "border" === e && t && (c += "padding:0 2px;"), c += e + ":" + t + ";"
            }
        }), n.fire("AfterPreviewFormats"), Wv.remove(r), c)
    }

    function Xp(e, t, n, r, o) {
        var i = t.get(n);
        !wg(e, n, r, o) || "toggle" in i[0] && !i[0].toggle ? Fp(e, n, r, o) : xp(e, n, r, o)
    }

    function Yp(e) {
        var t = function o(e) {
            var n = {}, r = function (e, t) {
                e && ("string" != typeof e ? Jn.each(e, function (e, t) {
                    r(t, e)
                }) : (O(t) || (t = [t]), Jn.each(t, function (e) {
                    "undefined" == typeof e.deep && (e.deep = !e.selector), "undefined" == typeof e.split && (e.split = !e.selector || e.inline), "undefined" == typeof e.remove && e.selector && !e.inline && (e.remove = "none"), e.selector && e.inline && (e.mixed = !0, e.block_expand = !0), "string" == typeof e.classes && (e.classes = e.classes.split(/\s+/))
                }), n[e] = t))
            };
            return r(qp(e.dom)), r(e.settings.formats), {
                get: function (e) {
                    return e ? n[e] : n
                }, has: function (e) {
                    return te(n, e)
                }, register: r, unregister: function (e) {
                    return e && n[e] && delete n[e], n
                }
            }
        }(e), n = ut(null);
        return Kv(e), Xg(e), {
            get: t.get,
            has: t.has,
            register: t.register,
            unregister: t.unregister,
            apply: d(Fp, e),
            remove: d(xp, e),
            toggle: d(Xp, e, t),
            match: d(wg, e),
            matchAll: d(xg, e),
            matchNode: d(op, e),
            canApply: d(zg, e),
            formatChanged: d(Rp, e, n),
            getCssText: d(Kp, e)
        }
    }

    function Gp(e) {
        return en.isElement(e) ? e.outerHTML : en.isText(e) ? kr.encodeRaw(e.data, !1) : en.isComment(e) ? "\x3c!--" + e.data + "--\x3e" : ""
    }

    function Zp(e, t, n) {
        var r = function (e) {
            var t, n, r;
            for (r = j.document.createElement("div"), t = j.document.createDocumentFragment(), e && (r.innerHTML = e); n = r.firstChild;) t.appendChild(n);
            return t
        }(t);
        if (e.hasChildNodes() && n < e.childNodes.length) {
            var o = e.childNodes[n];
            o.parentNode.insertBefore(r, o)
        } else e.appendChild(r)
    }

    function Jp(e) {
        return {
            type: "fragmented",
            fragments: e,
            content: "",
            bookmark: null,
            beforeBookmark: null
        }
    }

    function Qp(e) {
        return {
            type: "complete",
            fragments: null,
            content: e,
            bookmark: null,
            beforeBookmark: null
        }
    }

    function ev(e) {
        return "fragmented" === e.type ? e.fragments.join("") : e.content
    }

    function tv(e) {
        var t = at.fromTag("body", ey.get().getOrThunk(function () {
            var e = j.document.implementation.createHTMLDocument("undo");
            return ey.set(D.some(e)), e
        }));
        return _a(t, ev(e)), U(wa(t, "*[data-mce-bogus]"), Oe), function (e) {
            return e.dom().innerHTML
        }(t)
    }

    function nv(e) {
        return 0 === e.get()
    }

    function rv(e, t, n) {
        nv(n) && (e.typing = t)
    }

    function ov(e, t) {
        e.typing && (rv(e, !1, t), e.add())
    }

    function iv(n) {
        var r = ut(D.none()), o = ut(0), i = ut(0), a = {
            data: [], typing: !1, beforeChange: function () {
                !function (e, t, n) {
                    nv(t) && n.set(D.some(Kc.getUndoBookmark(e.selection)))
                }(n, o, r)
            }, add: function (e, t) {
                return function (e, t, n, r, o, i, a) {
                    var u = e.settings, c = ty(e);
                    if (i = i || {}, i = Jn.extend(i, c), !1 === nv(r) || e.removed) return null;
                    var s = t.data[n.get()];
                    if (e.fire("BeforeAddUndo", {
                        level: i,
                        lastLevel: s,
                        originalEvent: a
                    }).isDefaultPrevented()) return null;
                    if (s && ry(s, i)) return null;
                    if (t.data[n.get()] && o.get().each(function (e) {
                        t.data[n.get()].beforeBookmark = e
                    }), u.custom_undo_redo_levels && t.data.length > u.custom_undo_redo_levels) {
                        for (var l = 0; l < t.data.length - 1; l++) t.data[l] = t.data[l + 1];
                        t.data.length--, n.set(t.data.length)
                    }
                    i.bookmark = Kc.getUndoBookmark(e.selection), n.get() < t.data.length - 1 && (t.data.length = n.get() + 1), t.data.push(i), n.set(t.data.length - 1);
                    var f = {level: i, lastLevel: s, originalEvent: a};
                    return e.fire("AddUndo", f), 0 < n.get() && (e.setDirty(!0), e.fire("change", f)), i
                }(n, a, i, o, r, e, t)
            }, undo: function () {
                return function (e, t, n, r) {
                    var o;
                    return t.typing && (t.add(), t.typing = !1, rv(t, !1, n)), 0 < r.get() && (r.set(r.get() - 1), o = t.data[r.get()], ny(e, o, !0), e.setDirty(!0), e.fire("Undo", {level: o})), o
                }(n, a, o, i)
            }, redo: function () {
                return function (e, t, n) {
                    var r;
                    return t.get() < n.length - 1 && (t.set(t.get() + 1), r = n[t.get()], ny(e, r, !1), e.setDirty(!0), e.fire("Redo", {level: r})), r
                }(n, i, a.data)
            }, clear: function () {
                !function (e, t, n) {
                    t.data = [], n.set(0), t.typing = !1, e.fire("ClearUndos")
                }(n, a, i)
            }, reset: function () {
                !function (e) {
                    e.clear(), e.add()
                }(a)
            }, hasUndo: function () {
                return function (e, t, n) {
                    return 0 < n.get() || t.typing && t.data[0] && !ry(ty(e), t.data[0])
                }(n, a, i)
            }, hasRedo: function () {
                return function (e, t) {
                    return t.get() < e.data.length - 1 && !e.typing
                }(a, i)
            }, transact: function (e) {
                return function (e, t, n) {
                    return ov(e, t), e.beforeChange(), e.ignore(n), e.add()
                }(a, o, e)
            }, ignore: function (e) {
                !function (e, t) {
                    try {
                        e.set(e.get() + 1), t()
                    } finally {
                        e.set(e.get() - 1)
                    }
                }(o, e)
            }, extra: function (e, t) {
                !function (e, t, n, r, o) {
                    if (t.transact(r)) {
                        var i = t.data[n.get()].bookmark,
                            a = t.data[n.get() - 1];
                        ny(e, a, !0), t.transact(o) && (t.data[n.get() - 1].beforeBookmark = i)
                    }
                }(n, a, i, e, t)
            }
        };
        return function (n, r, o) {
            function i(e) {
                rv(r, !1, o), r.add({}, e)
            }

            var a = ut(!1);
            n.on("init", function () {
                r.add()
            }), n.on("BeforeExecCommand", function (e) {
                var t = e.command;
                "Undo" !== t && "Redo" !== t && "mceRepaint" !== t && (ov(r, o), r.beforeChange())
            }), n.on("ExecCommand", function (e) {
                var t = e.command;
                "Undo" !== t && "Redo" !== t && "mceRepaint" !== t && i(e)
            }), n.on("ObjectResizeStart cut", function () {
                r.beforeChange()
            }), n.on("SaveContent ObjectResized blur", i), n.on("dragend", i), n.on("keyup", function (e) {
                var t = e.keyCode;
                e.isDefaultPrevented() || ((33 <= t && t <= 36 || 37 <= t && t <= 40 || 45 === t || e.ctrlKey) && (i(), n.nodeChanged()), 46 !== t && 8 !== t || n.nodeChanged(), a.get() && r.typing && !1 === ry(ty(n), r.data[0]) && (!1 === n.isDirty() && (n.setDirty(!0), n.fire("change", {
                    level: r.data[0],
                    lastLevel: null
                })), n.fire("TypingUndo"), a.set(!1), n.nodeChanged()))
            }), n.on("keydown", function (e) {
                var t = e.keyCode;
                if (!e.isDefaultPrevented()) if (33 <= t && t <= 36 || 37 <= t && t <= 40 || 45 === t) r.typing && i(e); else {
                    var n = e.ctrlKey && !e.altKey || e.metaKey;
                    !(t < 16 || 20 < t) || 224 === t || 91 === t || r.typing || n || (r.beforeChange(), rv(r, !0, o), r.add({}, e), a.set(!0))
                }
            }), n.on("mousedown", function (e) {
                r.typing && i(e)
            });
            n.on("input", function (e) {
                e.inputType && (function (e) {
                    return "insertReplacementText" === e.inputType
                }(e) || function (e) {
                    return "insertText" === e.inputType && null === e.data
                }(e)) && i(e)
            }), n.on("AddUndo Undo Redo ClearUndos", function (e) {
                e.isDefaultPrevented() || n.nodeChanged()
            })
        }(n, a, o), function (e) {
            e.addShortcut("meta+z", "", "Undo"), e.addShortcut("meta+y,meta+shift+z", "", "Redo")
        }(n), a
    }

    function av(e) {
        return "keydown" === e.type || "keyup" === e.type
    }

    function uv(e) {
        var t = e.keyCode;
        return t === ph.BACKSPACE || t === ph.DELETE
    }

    function cv(o) {
        var i = o.dom, a = us(o), u = Bs(o), c = function (e, t) {
            if (!function (e) {
                if (av(e)) {
                    var t = e.keyCode;
                    return !uv(e) && (ph.metaKeyPressed(e) || e.altKey || 112 <= t && t <= 123 || h(oy, t))
                }
                return !1
            }(e)) {
                var n = o.getBody(), r = !function (e) {
                    return av(e) && !(uv(e) || "keyup" === e.type && 229 === e.keyCode)
                }(e) && function (e, t, n) {
                    if (cp(at.fromDom(t), !1)) {
                        var r = "" === n, o = t.firstElementChild;
                        return !o || !e.getStyle(t.firstElementChild, "padding-left") && !e.getStyle(t.firstElementChild, "padding-right") && (r ? !e.isBlock(o) : n === o.nodeName.toLowerCase())
                    }
                    return !1
                }(i, n, a);
                "" !== i.getAttrib(n, iy) === r && !t || (i.setAttrib(n, iy, r ? u : null), i.setAttrib(n, "aria-placeholder", r ? u : null), function (e, t) {
                    e.fire("PlaceholderToggle", {state: t})
                }(o, r), o.on(r ? "keydown" : "keyup", c), o.off(r ? "keyup" : "keydown", c))
            }
        };
        u && o.on("init", function (e) {
            c(e, !0), o.on("change SetContent ExecCommand", c), o.on("remove", function () {
                var e = o.getBody();
                i.setAttrib(e, iy, null), i.setAttrib(e, "aria-placeholder", null)
            })
        })
    }

    function sv(e) {
        return e.touches === undefined || 1 !== e.touches.length ? D.none() : D.some(e.touches[0])
    }

    function lv(e, t) {
        return e.hasOwnProperty(t.nodeName)
    }

    function fv(e, t) {
        if (en.isText(t)) {
            if (0 === t.nodeValue.length) return !0;
            if (/^\s+$/.test(t.nodeValue) && (!t.nextSibling || lv(e, t.nextSibling))) return !0
        }
        return !1
    }

    function dv(e) {
        var t, n, r, o, i, a, u, c, s, l, f = e.dom, d = e.selection,
            h = e.schema, m = h.getBlockElements(), g = d.getStart(),
            p = e.getBody(), v = us(e);
        if (g && en.isElement(g) && v && (l = p.nodeName.toLowerCase(), h.isValidChild(l, v.toLowerCase()) && !function (t, e, n) {
            return C(wm(at.fromDom(n), at.fromDom(e)), function (e) {
                return lv(t, e.dom())
            })
        }(m, p, g))) {
            for (n = (t = d.getRng()).startContainer, r = t.startOffset, o = t.endContainer, i = t.endOffset, s = Bd(e), g = p.firstChild; g;) if (y = m, b = g, en.isText(b) || en.isElement(b) && !lv(y, b) && !Xl(b)) {
                if (fv(m, g)) {
                    g = (u = g).nextSibling, f.remove(u);
                    continue
                }
                a || (a = f.create(v, cs(e)), g.parentNode.insertBefore(a, g), c = !0), g = (u = g).nextSibling, a.appendChild(u)
            } else a = null, g = g.nextSibling;
            var y, b;
            c && s && (t.setStart(n, r), t.setEnd(o, i), d.setRng(t), e.nodeChanged())
        }
    }

    function hv(e) {
        return cy(e) && e.data[0] === gu.ZWSP
    }

    function mv(e) {
        return cy(e) && e.data[e.data.length - 1] === gu.ZWSP
    }

    function gv(e) {
        return e.ownerDocument.createTextNode(gu.ZWSP)
    }

    function pv(e, t) {
        return e ? function (e) {
            if (cy(e.previousSibling)) return mv(e.previousSibling) || e.previousSibling.appendData(gu.ZWSP), e.previousSibling;
            if (cy(e)) return hv(e) || e.insertData(0, gu.ZWSP), e;
            var t = gv(e);
            return e.parentNode.insertBefore(t, e), t
        }(t) : function (e) {
            if (cy(e.nextSibling)) return hv(e.nextSibling) || e.nextSibling.insertData(0, gu.ZWSP), e.nextSibling;
            if (cy(e)) return mv(e) || e.appendData(gu.ZWSP), e;
            var t = gv(e);
            return e.nextSibling ? e.parentNode.insertBefore(t, e.nextSibling) : e.parentNode.appendChild(t), t
        }(t)
    }

    function vv(e, t) {
        return en.isText(e.container()) ? pv(t, e.container()) : pv(t, e.getNode())
    }

    function yv(e, t) {
        var n = t.get();
        return n && e.container() === n && La(n)
    }

    function bv(e, t) {
        if (!t) return t;
        var n = t.container(), r = t.offset();
        return e ? La(n) ? en.isText(n.nextSibling) ? Ic(n.nextSibling, 0) : Ic.after(n) : Fa(t) ? Ic(n, r + 1) : t : La(n) ? en.isText(n.previousSibling) ? Ic(n.previousSibling, n.previousSibling.data.length) : Ic.before(n) : Ua(t) ? Ic(n, r - 1) : t
    }

    function Cv(e, t) {
        var n = kc(t, e);
        return n || e
    }

    function wv(e, t, n) {
        var r = hy.normalizeForwards(n), o = Cv(t, r.container());
        return hy.findRootInline(e, o, r).fold(function () {
            return ql.nextPosition(o, r).bind(d(hy.findRootInline, e, o)).map(function (e) {
                return gy.before(e)
            })
        }, D.none)
    }

    function xv(e, t) {
        return null === fc(e, t)
    }

    function zv(e, t, n) {
        return hy.findRootInline(e, t, n).filter(d(xv, t))
    }

    function Ev(e, t, n) {
        var r = hy.normalizeBackwards(n);
        return zv(e, t, r).bind(function (e) {
            return ql.prevPosition(e, r).isNone() ? D.some(gy.start(e)) : D.none()
        })
    }

    function Nv(e, t, n) {
        var r = hy.normalizeForwards(n);
        return zv(e, t, r).bind(function (e) {
            return ql.nextPosition(e, r).isNone() ? D.some(gy.end(e)) : D.none()
        })
    }

    function Sv(e, t, n) {
        var r = hy.normalizeBackwards(n), o = Cv(t, r.container());
        return hy.findRootInline(e, o, r).fold(function () {
            return ql.prevPosition(o, r).bind(d(hy.findRootInline, e, o)).map(function (e) {
                return gy.after(e)
            })
        }, D.none)
    }

    function kv(e) {
        return !1 === hy.isRtl(py(e))
    }

    function Tv(e, t, n) {
        return my([wv, Ev, Nv, Sv], [e, t, n]).filter(kv)
    }

    function Av(e) {
        return e.fold($("before"), $("start"), $("end"), $("after"))
    }

    function Mv(e) {
        return e.fold(gy.before, gy.before, gy.after, gy.after)
    }

    function Rv(n, e, r, t, o, i) {
        return nu(hy.findRootInline(e, r, t), hy.findRootInline(e, r, o), function (e, t) {
            return e !== t && hy.hasSameParentBlock(r, e, t) ? gy.after(n ? e : t) : i
        }).getOr(i)
    }

    function Dv(e, t) {
        return e.fold($(!0), function (e) {
            return !function (e, t) {
                return Av(e) === Av(t) && py(e) === py(t)
            }(e, t)
        })
    }

    function _v(e, t) {
        return e ? t.fold(q(D.some, gy.start), D.none, q(D.some, gy.after), D.none) : t.fold(D.none, q(D.some, gy.before), D.none, q(D.some, gy.end))
    }

    function Ov(e, t, n, r) {
        var o = hy.normalizePosition(e, r), i = Tv(t, n, o);
        return Tv(t, n, o).bind(d(_v, e)).orThunk(function () {
            return function (t, n, r, o, e) {
                var i = hy.normalizePosition(t, e);
                return ql.fromPosition(t, r, i).map(d(hy.normalizePosition, t)).fold(function () {
                    return o.map(Mv)
                }, function (e) {
                    return Tv(n, r, e).map(d(Rv, t, n, r, i, e)).filter(d(Dv, o))
                }).filter(kv)
            }(e, t, n, i, r)
        })
    }

    function Hv(e) {
        return P(e.selection.getSel().modify)
    }

    function Bv(e, t, n) {
        var r = e ? 1 : -1;
        return t.setRng(Ic(n.container(), n.offset() + r).toRange()), t.getSel().modify("move", e ? "forward" : "backward", "word"), !0
    }

    function Pv(e, t) {
        var n = e.dom.createRng();
        n.setStart(t.container(), t.offset()), n.setEnd(t.container(), t.offset()), e.selection.setRng(n)
    }

    function Lv(e) {
        return !1 !== e.settings.inline_boundaries
    }

    function Vv(e, t) {
        e ? t.setAttribute("data-mce-selected", "inline-boundary") : t.removeAttribute("data-mce-selected")
    }

    function Iv(t, e, n) {
        return fy(e, n).map(function (e) {
            return Pv(t, e), n
        })
    }

    function Fv(e, t, n) {
        return function () {
            return !!Lv(t) && wy(e, t)
        }
    }

    function Uv(e) {
        return y(e, function (e, t) {
            return e.concat(function (t) {
                function e(e) {
                    return X(e, function (e) {
                        return (e = Ka(e)).node = t, e
                    })
                }

                if (en.isElement(t)) return e(t.getClientRects());
                if (en.isText(t)) {
                    var n = t.ownerDocument.createRange();
                    return n.setStart(t, 0), n.setEnd(t, t.data.length), e(n.getClientRects())
                }
            }(t))
        }, [])
    }

    var jv, qv, $v = Jn.each, Wv = ea.DOM, Kv = function (e) {
            e.addShortcut("meta+b", "", "Bold"), e.addShortcut("meta+i", "", "Italic"), e.addShortcut("meta+u", "", "Underline");
            for (var t = 1; t <= 6; t++) e.addShortcut("access+" + t, "", ["FormatBlock", !1, "h" + t]);
            e.addShortcut("access+7", "", ["FormatBlock", !1, "p"]), e.addShortcut("access+8", "", ["FormatBlock", !1, "div"]), e.addShortcut("access+9", "", ["FormatBlock", !1, "address"])
        }, Xv = 0, Yv = 2, Gv = 1, Zv = function (m, g) {
            function p(e, t, n, r) {
                for (var o = e; o - t < r && o < n && m[o] === g[o - t];) ++o;
                return function (e, t, n) {
                    return {start: e, end: t, diag: n}
                }(e, o, t)
            }

            var e = m.length + g.length + 2, v = new Array(e), y = new Array(e),
                s = function (e, t, n, r, o) {
                    var i = l(e, t, n, r);
                    if (null === i || i.start === t && i.diag === t - r || i.end === e && i.diag === e - n) for (var a = e, u = n; a < t || u < r;) a < t && u < r && m[a] === g[u] ? (o.push([0, m[a]]), ++a, ++u) : r - n < t - e ? (o.push([2, m[a]]), ++a) : (o.push([1, g[u]]), ++u); else {
                        s(e, i.start, n, i.start - i.diag, o);
                        for (var c = i.start; c < i.end; ++c) o.push([0, m[c]]);
                        s(i.end, t, i.end - i.diag, r, o)
                    }
                }, l = function (e, t, n, r) {
                    var o = t - e, i = r - n;
                    if (0 == o || 0 == i) return null;
                    var a, u, c, s, l, f = o - i, d = i + o,
                        h = (d % 2 == 0 ? d : 1 + d) / 2;
                    for (v[1 + h] = e, y[1 + h] = t + 1, a = 0; a <= h; ++a) {
                        for (u = -a; u <= a; u += 2) {
                            for (c = u + h, u === -a || u !== a && v[c - 1] < v[c + 1] ? v[c] = v[c + 1] : v[c] = v[c - 1] + 1, l = (s = v[c]) - e + n - u; s < t && l < r && m[s] === g[l];) v[c] = ++s, ++l;
                            if (f % 2 != 0 && f - a <= u && u <= f + a && y[c - f] <= v[c]) return p(y[c - f], u + e - n, t, r)
                        }
                        for (u = f - a; u <= f + a; u += 2) {
                            for (c = u + h - f, u === f - a || u !== f + a && y[c + 1] <= y[c - 1] ? y[c] = y[c + 1] - 1 : y[c] = y[c - 1], l = (s = y[c] - 1) - e + n - u; e <= s && n <= l && m[s] === g[l];) y[c] = s--, l--;
                            if (f % 2 == 0 && -a <= u && u <= a && y[c] <= v[c + f]) return p(y[c], u + e - n, t, r)
                        }
                    }
                }, t = [];
            return s(0, m.length, 0, g.length, t), t
        }, Jv = function (e) {
            return G(X(Z(e.childNodes), Gp), function (e) {
                return 0 < e.length
            })
        }, Qv = function (e, t) {
            var n = X(Z(t.childNodes), Gp);
            return function (e, t) {
                var n = 0;
                U(e, function (e) {
                    e[0] === Xv ? n++ : e[0] === Gv ? (Zp(t, e[1], n), n++) : e[0] === Yv && function (e, t) {
                        if (e.hasChildNodes() && t < e.childNodes.length) {
                            var n = e.childNodes[t];
                            n.parentNode.removeChild(n)
                        }
                    }(t, n)
                })
            }(Zv(n, e), t), t
        }, ey = ut(D.none()), ty = function (n) {
            var e, t, r;
            return e = Jv(n.getBody()), function (e) {
                return -1 !== e.indexOf("</iframe>")
            }(t = (r = v(e, function (e) {
                var t = md.trimInternal(n.serializer, e);
                return 0 < t.length ? [t] : []
            })).join("")) ? Jp(r) : Qp(t)
        }, ny = function (e, t, n) {
            "fragmented" === t.type ? Qv(t.fragments, e.getBody()) : e.setContent(t.content, {format: "raw"}), e.selection.moveToBookmark(n ? t.beforeBookmark : t.bookmark)
        }, ry = function (e, t) {
            return !(!e || !t) && (!!function (e, t) {
                return ev(e) === ev(t)
            }(e, t) || function (e, t) {
                return tv(e) === tv(t)
            }(e, t))
        },
        oy = [9, 27, ph.HOME, ph.END, 19, 20, 44, 144, 145, 33, 34, 45, 16, 17, 18, 91, 92, 93, ph.DOWN, ph.UP, ph.LEFT, ph.RIGHT].concat(Kn.browser.isFirefox() ? [224] : []),
        iy = "data-mce-placeholder", ay = function (n) {
            var r = ut(D.none()), o = ut(!1), i = ha(function (e) {
                n.fire("longpress", ne(ne({}, e), {type: "longpress"})), o.set(!0)
            }, 400);
            n.on("touchstart", function (n) {
                sv(n).each(function (e) {
                    i.cancel();
                    var t = {x: $(e.clientX), y: $(e.clientY), target: $(n.target)};
                    i.throttle(n), o.set(!1), r.set(D.some(t))
                })
            }, !0), n.on("touchmove", function (e) {
                i.cancel(), sv(e).each(function (t) {
                    r.get().each(function (e) {
                        !function (e, t) {
                            var n = Math.abs(e.clientX - t.x()),
                                r = Math.abs(e.clientY - t.y());
                            return 5 < n || 5 < r
                        }(t, e) || (r.set(D.none()), o.set(!1), n.fire("longpresscancel"))
                    })
                })
            }, !0), n.on("touchend touchcancel", function (t) {
                i.cancel(), "touchcancel" !== t.type && r.get().filter(function (e) {
                    return e.target().isEqualNode(t.target)
                }).each(function () {
                    o.get() ? t.preventDefault() : n.fire("tap", ne(ne({}, t), {type: "tap"}))
                })
            }, !0)
        }, uy = function (e) {
            us(e) && e.on("NodeChange", d(dv, e))
        }, cy = en.isText, sy = d(pv, !0), ly = d(pv, !1), fy = function (n, e) {
            return e.fold(function (e) {
                Jc.remove(n.get());
                var t = sy(e);
                return n.set(t), D.some(Ic(t, t.length - 1))
            }, function (e) {
                return ql.firstPositionIn(e).map(function (e) {
                    if (yv(e, n)) return Ic(n.get(), 1);
                    Jc.remove(n.get());
                    var t = vv(e, !0);
                    return n.set(t), Ic(t, 1)
                })
            }, function (e) {
                return ql.lastPositionIn(e).map(function (e) {
                    if (yv(e, n)) return Ic(n.get(), n.get().length - 1);
                    Jc.remove(n.get());
                    var t = vv(e, !1);
                    return n.set(t), Ic(t, t.length - 1)
                })
            }, function (e) {
                Jc.remove(n.get());
                var t = ly(e);
                return n.set(t), D.some(Ic(t, 1))
            })
        }, dy = /[\u0591-\u07FF\uFB1D-\uFDFF\uFE70-\uFEFC]/, hy = {
            isInlineTarget: function (e, t) {
                return ge(at.fromDom(t), _s(e))
            },
            findRootInline: function (e, t, n) {
                var r = function (e, t, n) {
                    return G(ea.DOM.getParents(n.container(), "*", t), e)
                }(e, t, n);
                return D.from(r[r.length - 1])
            },
            isRtl: function (e) {
                return "rtl" === ea.DOM.getStyle(e, "direction", !0) || function (e) {
                    return dy.test(e)
                }(e.textContent)
            },
            isAtZwsp: function (e) {
                return Fa(e) || Ua(e)
            },
            normalizePosition: bv,
            normalizeForwards: d(bv, !0),
            normalizeBackwards: d(bv, !1),
            hasSameParentBlock: function (e, t, n) {
                var r = kc(t, e), o = kc(n, e);
                return r && r === o
            }
        }, my = function (e, t) {
            for (var n = 0; n < e.length; n++) {
                var r = e[n].apply(null, t);
                if (r.isSome()) return r
            }
            return D.none()
        },
        gy = vd([{before: ["element"]}, {start: ["element"]}, {end: ["element"]}, {after: ["element"]}]),
        py = function (e) {
            return e.fold(W, W, W, W)
        }, vy = Tv, yy = Ov, by = (d(Ov, !1), d(Ov, !0), Mv),
        Cy = function (e) {
            return e.fold(gy.start, gy.start, gy.end, gy.end)
        }, wy = function (e, t) {
            var n = t.selection.getRng(),
                r = e ? Ic.fromRangeEnd(n) : Ic.fromRangeStart(n);
            return !!Hv(t) && (e && Fa(r) ? Bv(!0, t.selection, r) : !(e || !Ua(r)) && Bv(!1, t.selection, r))
        }, xy = {
            move: function (e, t, n) {
                return function () {
                    return !!Lv(e) && function (t, n, e) {
                        var r = t.getBody(),
                            o = Ic.fromRangeStart(t.selection.getRng()),
                            i = d(hy.isInlineTarget, t);
                        return yy(e, i, r, o).bind(function (e) {
                            return Iv(t, n, e)
                        })
                    }(e, t, n).isSome()
                }
            },
            moveNextWord: d(Fv, !0),
            movePrevWord: d(Fv, !1),
            setupSelectedState: function (t) {
                var n = ut(null), r = d(hy.isInlineTarget, t);
                return t.on("NodeChange", function (e) {
                    !Lv(t) || Kn.browser.isIE() && e.initial || (function (e, t, n) {
                        var r = G(t.select('*[data-mce-selected="inline-boundary"]'), e),
                            o = G(n, e);
                        U(x(r, o), d(Vv, !1)), U(x(o, r), d(Vv, !0))
                    }(r, t.dom, e.parents), function (e, t) {
                        if (e.selection.isCollapsed() && !0 !== e.composing && t.get()) {
                            var n = Ic.fromRangeStart(e.selection.getRng());
                            Ic.isTextPosition(n) && !1 === hy.isAtZwsp(n) && (Pv(e, Jc.removeAndReposition(t.get(), n)), t.set(null))
                        }
                    }(t, n), function (n, r, o, e) {
                        if (r.selection.isCollapsed()) {
                            var t = G(e, n);
                            U(t, function (e) {
                                var t = Ic.fromRangeStart(r.selection.getRng());
                                vy(n, r.getBody(), t).bind(function (e) {
                                    return Iv(r, o, e)
                                })
                            })
                        }
                    }(r, t, n, e.parents))
                }), n
            },
            setCaretPosition: Pv
        };
    (qv = jv = jv || {})[qv.Up = -1] = "Up", qv[qv.Down = 1] = "Down";

    function zy(o, i, a, e, u, t) {
        function n(e) {
            var t, n, r;
            for (r = Uv([e]), -1 === o && (r = r.reverse()), t = 0; t < r.length; t++) if (n = r[t], !a(n, c)) {
                if (0 < l.length && i(n, Yn.last(l)) && s++, n.line = s, u(n)) return !0;
                l.push(n)
            }
        }

        var r, c, s = 0, l = [];
        return (c = Yn.last(t.getClientRects())) && (n(r = t.getNode()), function (e, t, n, r) {
            for (; r = Sc(r, e, Wa, t);) if (n(r)) return
        }(o, e, n, r)), l
    }

    function Ey(t) {
        return function (e) {
            return function (e, t) {
                return t.line > e
            }(t, e)
        }
    }

    function Ny(t) {
        return function (e) {
            return function (e, t) {
                return t.line === e
            }(t, e)
        }
    }

    function Sy(e, t) {
        return Math.abs(e.left - t)
    }

    function ky(e, t) {
        return Math.abs(e.right - t)
    }

    function Ty(e, t) {
        return e >= t.left && e <= t.right
    }

    function Ay(e, o) {
        return Yn.reduce(e, function (e, t) {
            var n, r;
            return n = Math.min(Sy(e, o), ky(e, o)), r = Math.min(Sy(t, o), ky(t, o)), Ty(o, t) ? t : Ty(o, e) ? e : r === n && $y(t.node) ? t : r < n ? t : e
        })
    }

    function My(e, t, n, r) {
        for (; r = Wy(r, e, Wa, t);) if (n(r)) return
    }

    function Ry(e, t, n) {
        var r, o = Uv(function (e) {
            return G(Z(e.getElementsByTagName("*")), xc)
        }(e)), i = G(o, function (e) {
            return n >= e.top && n <= e.bottom
        });
        return (r = (r = Ay(i, t)) && Ay(function (e, r) {
            function t(t, e) {
                var n;
                return n = G(Uv([e]), function (e) {
                    return !t(e, r)
                }), o = o.concat(n), 0 === n.length
            }

            var o = [];
            return o.push(r), My(jv.Up, e, d(t, Ga), r.node), My(jv.Down, e, d(t, Za), r.node), o
        }(e, r), t)) && xc(r.node) ? function (e, t) {
            return {node: e.node, before: Sy(e, t) < ky(e, t)}
        }(r, t) : null
    }

    function Dy(e, t, n, r, o) {
        return t._selectionOverrides.showCaret(e, n, r, o)
    }

    function _y(e, t) {
        return e.fire("BeforeObjectSelected", {target: t}).isDefaultPrevented() ? null : function (e) {
            var t = e.ownerDocument.createRange();
            return t.selectNode(e), t
        }(t)
    }

    function Oy(e, t, n) {
        var r = Dc(1, e.getBody(), t), o = Ic.fromRangeStart(r),
            i = o.getNode();
        if (Xy(i)) return Dy(1, e, i, !o.isAtEnd(), !1);
        var a = o.getNode(!0);
        if (Xy(a)) return Dy(1, e, a, !1, !1);
        var u = e.dom.getParent(o.getNode(), function (e) {
            return Xy(e) || Ky(e)
        });
        return Xy(u) ? Dy(1, e, u, !1, n) : null
    }

    function Hy(e, t, n) {
        if (!t || !t.collapsed) return t;
        var r = Oy(e, t, n);
        return r || t
    }

    function By(n, r, o) {
        return D.from(o.container()).filter(en.isText).exists(function (e) {
            var t = n ? 0 : -1;
            return r(e.data.charAt(o.offset() + t))
        })
    }

    function Py(e) {
        var t = e.container();
        return en.isText(t) && 0 === t.data.length
    }

    function Ly(t, n) {
        return function (e) {
            return D.from(Ac(t ? 0 : -1, e)).filter(n).isSome()
        }
    }

    function Vy(e) {
        return "IMG" === e.nodeName && "block" === Ze(at.fromDom(e), "display")
    }

    function Iy(e) {
        return en.isContentEditableFalse(e) && !en.isBogusAll(e)
    }

    var Fy, Uy, jy = d(zy, jv.Up, Ga, Za), qy = d(zy, jv.Down, Za, Ga),
        $y = en.isContentEditableFalse, Wy = Sc, Ky = en.isContentEditableTrue,
        Xy = en.isContentEditableFalse, Yy = d(By, !0, cl), Gy = d(By, !1, cl),
        Zy = Ly(!0, Vy), Jy = Ly(!1, Vy), Qy = Ly(!0, en.isTable),
        eb = Ly(!1, en.isTable), tb = Ly(!0, Iy), nb = Ly(!1, Iy);
    (Uy = Fy = Fy || {})[Uy.Br = 0] = "Br", Uy[Uy.Block = 1] = "Block", Uy[Uy.Wrap = 2] = "Wrap", Uy[Uy.Eol = 3] = "Eol";

    function rb(e, t) {
        return e === Lc.Backwards ? w(t) : t
    }

    function ob(e, t, n, r) {
        for (var o, i, a, u, c, s, l = Ys(n), f = r, d = []; f && (c = l, s = f, o = t === Lc.Forwards ? c.next(s) : c.prev(s));) {
            if (en.isBr(o.getNode(!1))) return t === Lc.Forwards ? {
                positions: rb(t, d).concat([o]),
                breakType: Fy.Br,
                breakAt: D.some(o)
            } : {positions: rb(t, d), breakType: Fy.Br, breakAt: D.some(o)};
            if (o.isVisible()) {
                if (e(f, o)) {
                    var h = (i = t, a = f, u = o, en.isBr(u.getNode(i === Lc.Forwards)) ? Fy.Br : !1 === Tc(a, u) ? Fy.Block : Fy.Wrap);
                    return {
                        positions: rb(t, d),
                        breakType: h,
                        breakAt: D.some(o)
                    }
                }
                d.push(o), f = o
            } else f = o
        }
        return {positions: rb(t, d), breakType: Fy.Eol, breakAt: D.none()}
    }

    function ib(n, r, o, e) {
        return r(o, e).breakAt.map(function (e) {
            var t = r(o, e).positions;
            return n === Lc.Backwards ? t.concat(e) : [e].concat(t)
        }).getOr([])
    }

    function ab(e, i) {
        return y(e, function (e, o) {
            return e.fold(function () {
                return D.some(o)
            }, function (r) {
                return nu(z(r.getClientRects()), z(o.getClientRects()), function (e, t) {
                    var n = Math.abs(i - e.left);
                    return Math.abs(i - t.left) <= n ? o : r
                }).or(e)
            })
        }, D.none())
    }

    function ub(t, e) {
        return z(e.getClientRects()).bind(function (e) {
            return ab(t, e.left)
        })
    }

    function cb(e, t, n, r) {
        var o = e === Lc.Forwards, i = o ? tb : nb;
        if (!r.collapsed) {
            var a = Vw(r);
            if (Lw(a)) return Dy(e, t, a, e === Lc.Backwards, !0)
        }
        var u = function (e) {
            return Pa(e.startContainer)
        }(r), c = Oc(e, t.getBody(), r);
        if (i(c)) return _y(t, c.getNode(!o));
        var s = hy.normalizePosition(o, n(c));
        if (!s) return u ? r : null;
        if (i(s)) return Dy(e, t, s.getNode(!o), o, !0);
        var l = n(s);
        return l && i(l) && Pc(s, l) ? Dy(e, t, l.getNode(!o), o, !0) : u ? Hy(t, s.toRange(), !0) : null
    }

    function sb(e, t, n, r) {
        var o, i, a, u, c, s, l, f, d;
        if (d = Vw(r), o = Oc(e, t.getBody(), r), i = n(t.getBody(), Ey(1), o), a = G(i, Ny(1)), c = Yn.last(o.getClientRects()), (tb(o) || Qy(o)) && (d = o.getNode()), (nb(o) || eb(o)) && (d = o.getNode(!0)), !c) return null;
        if (s = c.left, (u = Ay(a, s)) && Lw(u.node)) return l = Math.abs(s - u.left), f = Math.abs(s - u.right), Dy(e, t, u.node, l < f, !0);
        if (d) {
            var h = function (e, t, n, r) {
                function o(e) {
                    return Yn.last(e.getClientRects())
                }

                var i, a, u, c, s, l, f = Ys(t), d = [], h = 0;
                l = o(c = 1 === e ? (i = f.next, a = Za, u = Ga, Ic.after(r)) : (i = f.prev, a = Ga, u = Za, Ic.before(r)));
                do {
                    if (c.isVisible() && !u(s = o(c), l)) {
                        if (0 < d.length && a(s, Yn.last(d)) && h++, (s = Ka(s)).position = c, s.line = h, n(s)) return d;
                        d.push(s)
                    }
                } while (c = i(c));
                return d
            }(e, t.getBody(), Ey(1), d);
            if (u = Ay(G(h, Ny(1)), s)) return Hy(t, u.position.toRange(), !0);
            if (u = Yn.last(G(h, Ny(0)))) return Hy(t, u.position.toRange(), !0)
        }
    }

    function lb(e, t, n) {
        var r, o, i = Ys(e.getBody()), a = d(Bc, i.next), u = d(Bc, i.prev);
        if (n.collapsed && e.settings.forced_root_block) {
            if (!(r = e.dom.getParent(n.startContainer, "PRE"))) return;
            (1 === t ? a(Ic.fromRangeStart(n)) : u(Ic.fromRangeStart(n))) || (o = function (e) {
                var t = e.dom.create(us(e));
                return (!Kn.ie || 11 <= Kn.ie) && (t.innerHTML = '<br data-mce-bogus="1">'), t
            }(e), 1 === t ? e.$(r).after(o) : e.$(r).before(o), e.selection.select(o, !0), e.selection.collapse())
        }
    }

    function fb(t, n) {
        return function () {
            var e = function (e, t) {
                var n, r = Ys(e.getBody()), o = d(Bc, r.next),
                    i = d(Bc, r.prev), a = t ? Lc.Forwards : Lc.Backwards,
                    u = t ? o : i, c = e.selection.getRng();
                return (n = cb(a, e, u, c)) ? n : (n = lb(e, a, c)) || null
            }(t, n);
            return !!e && (t.selection.setRng(e), !0)
        }
    }

    function db(t, n) {
        return function () {
            var e = function (e, t) {
                var n, r = t ? 1 : -1, o = t ? qy : jy,
                    i = e.selection.getRng();
                return (n = sb(r, e, o, i)) ? n : (n = lb(e, r, i)) || null
            }(t, n);
            return !!e && (t.selection.setRng(e), !0)
        }
    }

    function hb(n, r) {
        return function () {
            var e = r ? Ic.fromRangeEnd(n.selection.getRng()) : Ic.fromRangeStart(n.selection.getRng()),
                t = r ? Hw(n.getBody(), e) : Ow(n.getBody(), e);
            return (r ? E(t.positions) : z(t.positions)).filter(function (t) {
                return function (e) {
                    return t ? nb(e) : tb(e)
                }
            }(r)).fold($(!1), function (e) {
                return n.selection.setRng(e.toRange()), !0
            })
        }
    }

    function mb(e, t, n, r, o) {
        var i = wa(at.fromDom(n), "td,th,caption").map(function (e) {
            return e.dom()
        });
        return function (e, o, i) {
            return y(e, function (e, r) {
                return e.fold(function () {
                    return D.some(r)
                }, function (e) {
                    var t = Math.sqrt(Math.abs(e.x - o) + Math.abs(e.y - i)),
                        n = Math.sqrt(Math.abs(r.x - o) + Math.abs(r.y - i));
                    return D.some(n < t ? r : e)
                })
            }, D.none())
        }(G(function (n, e) {
            return v(e, function (e) {
                var t = function (e, t) {
                    return {
                        left: e.left - t,
                        top: e.top - t,
                        right: e.right + 2 * t,
                        bottom: e.bottom + 2 * t,
                        width: e.width + t,
                        height: e.height + t
                    }
                }(Ka(e.getBoundingClientRect()), -1);
                return [{x: t.left, y: n(t), cell: e}, {
                    x: t.right,
                    y: n(t),
                    cell: e
                }]
            })
        }(e, i), function (e) {
            return t(e, o)
        }), r, o).map(function (e) {
            return e.cell
        })
    }

    function gb(t, n) {
        return z(n.getClientRects()).bind(function (e) {
            return Iw(t, e.left, e.top)
        }).bind(function (e) {
            return ub(function (t) {
                return ql.lastPositionIn(t).map(function (e) {
                    return Ow(t, e).positions.concat(e)
                }).getOr([])
            }(e), n)
        })
    }

    function pb(t, n) {
        return E(n.getClientRects()).bind(function (e) {
            return Fw(t, e.left, e.top)
        }).bind(function (e) {
            return ub(function (t) {
                return ql.firstPositionIn(t).map(function (e) {
                    return [e].concat(Hw(t, e).positions)
                }).getOr([])
            }(e), n)
        })
    }

    function vb(e, t) {
        e.selection.setRng(t), ym(e, t)
    }

    function yb(e, t, n) {
        var r = e(t, n);
        return function (e) {
            return e.breakType === Fy.Wrap && 0 === e.positions.length
        }(r) || !en.isBr(n.getNode()) && function (e) {
            return e.breakType === Fy.Br && 1 === e.positions.length
        }(r) ? !function (t, n, e) {
            return e.breakAt.map(function (e) {
                return t(n, e).breakAt.isSome()
            }).getOr(!1)
        }(e, t, r) : r.breakAt.isNone()
    }

    function bb(e, t, n, r) {
        var o = e.selection.getRng(), i = t ? 1 : -1;
        if (wc() && function (e, t, n) {
            var r = Ic.fromRangeStart(t);
            return ql.positionIn(!e, n).map(function (e) {
                return e.isEqual(r)
            }).getOr(!1)
        }(t, o, n)) {
            var a = Dy(i, e, n, !t, !0);
            return vb(e, a), !0
        }
        return !1
    }

    function Cb(e, t) {
        var n = t.getNode(e);
        return en.isElement(n) && "TABLE" === n.nodeName ? D.some(n) : D.none()
    }

    function wb(n, r, o) {
        var e = Cb(!!r, o), i = !1 === r;
        e.fold(function () {
            return vb(n, o.toRange())
        }, function (t) {
            return ql.positionIn(i, n.getBody()).filter(function (e) {
                return e.isEqual(o)
            }).fold(function () {
                return vb(n, o.toRange())
            }, function (e) {
                return function (n, r, o, e) {
                    var i = us(r);
                    i ? r.undoManager.transact(function () {
                        var e = at.fromTag(i);
                        Xe(e, cs(r)), Bt(e, at.fromTag("br")), n ? Me(at.fromDom(o), e) : Ae(at.fromDom(o), e);
                        var t = r.dom.createRng();
                        t.setStart(e.dom(), 0), t.setEnd(e.dom(), 0), vb(r, t)
                    }) : vb(r, e.toRange())
                }(r, n, t, o)
            })
        })
    }

    function xb(e, t, n, r) {
        var o = e.selection.getRng(), i = Ic.fromRangeStart(o), a = e.getBody();
        if (!t && Uw(r, i)) {
            var u = function (t, n, e) {
                return gb(n, e).orThunk(function () {
                    return z(e.getClientRects()).bind(function (e) {
                        return ab(Bw(t, Ic.before(n)), e.left)
                    })
                }).getOr(Ic.before(n))
            }(a, n, i);
            return wb(e, t, u), !0
        }
        if (t && jw(r, i)) {
            u = function (t, n, e) {
                return pb(n, e).orThunk(function () {
                    return z(e.getClientRects()).bind(function (e) {
                        return ab(Pw(t, Ic.after(n)), e.left)
                    })
                }).getOr(Ic.after(n))
            }(a, n, i);
            return wb(e, t, u), !0
        }
        return !1
    }

    function zb(t, n) {
        return function () {
            return D.from(t.dom.getParent(t.selection.getNode(), "td,th")).bind(function (e) {
                return D.from(t.dom.getParent(e, "table")).map(function (e) {
                    return bb(t, n, e)
                })
            }).getOr(!1)
        }
    }

    function Eb(n, r) {
        return function () {
            return D.from(n.dom.getParent(n.selection.getNode(), "td,th")).bind(function (t) {
                return D.from(n.dom.getParent(t, "table")).map(function (e) {
                    return xb(n, r, e, t)
                })
            }).getOr(!1)
        }
    }

    function Nb(e) {
        return h(["figcaption"], He(e))
    }

    function Sb(e) {
        var t = j.document.createRange();
        return t.setStartBefore(e.dom()), t.setEndBefore(e.dom()), t
    }

    function kb(e, t, n) {
        n ? Bt(e, t) : Re(e, t)
    }

    function Tb(e, t, n, r) {
        return "" === t ? function (e, t) {
            var n = at.fromTag("br");
            return kb(e, n, t), Sb(n)
        }(e, r) : function (e, t, n, r) {
            var o = at.fromTag(n), i = at.fromTag("br");
            return Xe(o, r), Bt(o, i), kb(e, o, t), Sb(i)
        }(e, r, t, n)
    }

    function Ab(e, t, n) {
        return t ? function (e, t) {
            return Hw(e, t).breakAt.isNone()
        }(e.dom(), n) : function (e, t) {
            return Ow(e, t).breakAt.isNone()
        }(e.dom(), n)
    }

    function Mb(t, n) {
        var r = at.fromDom(t.getBody()),
            o = Ic.fromRangeStart(t.selection.getRng()), i = us(t), a = cs(t);
        return function (e, t) {
            var n = d(ve, t);
            return Sa(at.fromDom(e.container()), ur, n).filter(Nb)
        }(o, r).exists(function () {
            if (Ab(r, n, o)) {
                var e = Tb(r, i, a, n);
                return t.selection.setRng(e), !0
            }
            return !1
        })
    }

    function Rb(e, t) {
        return function () {
            return !!e.selection.isCollapsed() && Mb(e, t)
        }
    }

    function Db(e, t) {
        return v(function (e) {
            return X(e, function (e) {
                return ne({
                    shiftKey: !1,
                    altKey: !1,
                    ctrlKey: !1,
                    metaKey: !1,
                    keyCode: 0,
                    action: u
                }, e)
            })
        }(e), function (e) {
            return function (e, t) {
                return t.keyCode === e.keyCode && t.shiftKey === e.shiftKey && t.altKey === e.altKey && t.ctrlKey === e.ctrlKey && t.metaKey === e.metaKey
            }(e, t) ? [e] : []
        })
    }

    function _b(e, t) {
        return {from: $(e), to: $(t)}
    }

    function Ob(e, t) {
        var n = at.fromDom(e), r = at.fromDom(t.container());
        return Kw(n, r).map(function (e) {
            return function (e, t) {
                return {block: $(e), position: $(t)}
            }(e, t)
        })
    }

    function Hb(t, n, e) {
        var r = Ob(t, Ic.fromRangeStart(e)), o = r.bind(function (e) {
            return ql.fromPosition(n, t, e.position()).bind(function (e) {
                return Ob(t, e).map(function (e) {
                    return function (t, n, r) {
                        return en.isBr(r.position().getNode()) && !1 === cp(r.block()) ? ql.positionIn(!1, r.block().dom()).bind(function (e) {
                            return e.isEqual(r.position()) ? ql.fromPosition(n, t, e).bind(function (e) {
                                return Ob(t, e)
                            }) : D.some(r)
                        }).getOr(r) : r
                    }(t, n, e)
                })
            })
        });
        return nu(r, o, _b).filter(function (e) {
            return function (e) {
                return !1 === ve(e.from().block(), e.to().block())
            }(e) && function (e) {
                return Ce(e.from().block()).bind(function (t) {
                    return Ce(e.to().block()).filter(function (e) {
                        return ve(t, e)
                    })
                }).isSome()
            }(e) && function (e) {
                return !1 === en.isContentEditableFalse(e.from().block().dom()) && !1 === en.isContentEditableFalse(e.to().block().dom())
            }(e)
        })
    }

    function Bb(e) {
        var t = function (e) {
            var t = Ne(e);
            return p(t, ur).fold(function () {
                return t
            }, function (e) {
                return t.slice(0, e)
            })
        }(e);
        return U(t, Pt), t
    }

    function Pb(e, t) {
        var n = xm(t, e);
        return g(n.reverse(), function (e) {
            return cp(e)
        }).each(Pt)
    }

    function Lb(e, t, n, r) {
        if (cp(n)) return tp(n), ql.firstPositionIn(n.dom());
        (function (e) {
            return 0 === G(ze(e), function (e) {
                return !cp(e)
            }).length
        })(r) && cp(t) && Ae(r, at.fromTag("br"));
        var o = ql.prevPosition(n.dom(), Ic.before(r.dom()));
        return U(Bb(t), function (e) {
            Ae(r, e)
        }), Pb(e, t), o
    }

    function Vb(e, t, n) {
        if (cp(n)) return Pt(n), cp(t) && tp(t), ql.firstPositionIn(t.dom());
        var r = ql.lastPositionIn(n.dom());
        return U(Bb(t), function (e) {
            Bt(n, e)
        }), Pb(e, t), r
    }

    function Ib(e, t) {
        return Ht(t, e) ? function (e, t) {
            var n = xm(t, e);
            return D.from(n[n.length - 1])
        }(t, e) : D.none()
    }

    function Fb(e, t) {
        ql.positionIn(e, t.dom()).map(function (e) {
            return e.getNode()
        }).map(at.fromDom).filter(tr).each(Pt)
    }

    function Ub(e, t, n) {
        return Fb(!0, t), Fb(!1, n), Ib(t, n).fold(d(Vb, e, t, n), d(Lb, e, t, n))
    }

    function jb(e, t) {
        var n = at.fromDom(t), r = d(ve, e);
        return Na(n, hr, r).isSome()
    }

    function qb(e, t) {
        var n = ql.prevPosition(e.dom(), Ic.fromRangeStart(t)).isNone(),
            r = ql.nextPosition(e.dom(), Ic.fromRangeEnd(t)).isNone();
        return !function (e, t) {
            return jb(e, t.startContainer) || jb(e, t.endContainer)
        }(e, t) && n && r
    }

    function $b(e) {
        var t = at.fromDom(e.getBody()), n = e.selection.getRng();
        return qb(t, n) ? function (e) {
            return e.setContent(""), e.selection.setCursorLocation(), !0
        }(e) : function (n, r) {
            var o = r.getRng();
            return nu(Kw(n, at.fromDom(o.startContainer)), Kw(n, at.fromDom(o.endContainer)), function (e, t) {
                return !1 === ve(e, t) && (o.deleteContents(), Zw(n, !0, e, t).each(function (e) {
                    r.setRng(e.toRange())
                }), !0)
            }).getOr(!1)
        }(t, e.selection)
    }

    function Wb(e) {
        return Hc(e).exists(tr)
    }

    function Kb(e, t, n) {
        var r = G(xm(at.fromDom(n.container()), t), ur), o = z(r).getOr(t);
        return ql.fromPosition(e, o.dom(), n).filter(Wb)
    }

    function Xb(e, t) {
        return Hc(t).exists(tr) || Kb(!0, e, t).isSome()
    }

    function Yb(e, t) {
        return function (e) {
            return D.from(e.getNode(!0)).map(at.fromDom)
        }(t).exists(tr) || Kb(!1, e, t).isSome()
    }

    function Gb(e, t, n, r) {
        var o = r.getNode(!1 === t);
        return Kw(at.fromDom(e), at.fromDom(n.getNode())).map(function (e) {
            return cp(e) ? nx.remove(e.dom()) : nx.moveToElement(o)
        }).orThunk(function () {
            return D.some(nx.moveToElement(o))
        })
    }

    function Zb(t, n, r) {
        return ql.fromPosition(n, t, r).bind(function (e) {
            return function (e) {
                return hr(at.fromDom(e)) || lr(at.fromDom(e))
            }(e.getNode()) ? D.none() : function (t, e, n, r) {
                function o(e) {
                    return er(at.fromDom(e)) && !Tc(n, r, t)
                }

                return _c(!e, n).fold(function () {
                    return _c(e, r).fold($(!1), o)
                }, o)
            }(t, n, r, e) ? D.none() : n && en.isContentEditableFalse(e.getNode()) ? Gb(t, n, r, e) : !1 === n && en.isContentEditableFalse(e.getNode(!0)) ? Gb(t, n, r, e) : n && nb(r) ? D.some(nx.moveToPosition(e)) : !1 === n && tb(r) ? D.some(nx.moveToPosition(e)) : D.none()
        })
    }

    function Jb(t, e, n) {
        return function (e, t) {
            var n = t.getNode(!1 === e), r = e ? "after" : "before";
            return en.isElement(n) && n.getAttribute("data-mce-caret") === r
        }(e, n) ? function (e, t) {
            return e && en.isContentEditableFalse(t.nextSibling) ? D.some(nx.moveToElement(t.nextSibling)) : !1 === e && en.isContentEditableFalse(t.previousSibling) ? D.some(nx.moveToElement(t.previousSibling)) : D.none()
        }(e, n.getNode(!1 === e)).fold(function () {
            return Zb(t, e, n)
        }, D.some) : Zb(t, e, n).bind(function (e) {
            return function (t, n, e) {
                return e.fold(function (e) {
                    return D.some(nx.remove(e))
                }, function (e) {
                    return D.some(nx.moveToElement(e))
                }, function (e) {
                    return Tc(n, e, t) ? D.none() : D.some(nx.moveToPosition(e))
                })
            }(t, n, e)
        })
    }

    function Qb(e, t) {
        return D.from(rx(e.getBody(), t))
    }

    function eC(t, n) {
        var e = t.selection.getNode();
        return Qb(t, e).filter(en.isContentEditableFalse).fold(function () {
            return function (e, t, n) {
                var r = Dc(t ? 1 : -1, e, n), o = Ic.fromRangeStart(r),
                    i = at.fromDom(e);
                return !1 === t && nb(o) ? D.some(nx.remove(o.getNode(!0))) : t && tb(o) ? D.some(nx.remove(o.getNode())) : !1 === t && tb(o) && Yb(i, o) ? ex(i, o).map(function (e) {
                    return nx.remove(e.getNode())
                }) : t && nb(o) && Xb(i, o) ? tx(i, o).map(function (e) {
                    return nx.remove(e.getNode())
                }) : Jb(e, t, o)
            }(t.getBody(), n, t.selection.getRng()).map(function (e) {
                return e.fold(function (t, n) {
                    return function (e) {
                        return t._selectionOverrides.hideFakeCaret(), sp(t, n, at.fromDom(e)), !0
                    }
                }(t, n), function (n, r) {
                    return function (e) {
                        var t = r ? Ic.before(e) : Ic.after(e);
                        return n.selection.setRng(t.toRange()), !0
                    }
                }(t, n), function (t) {
                    return function (e) {
                        return t.selection.setRng(e.toRange()), !0
                    }
                }(t))
            }).getOr(!1)
        }, function () {
            return !0
        })
    }

    function tC(e, t) {
        var n = e.selection.getNode();
        return !!en.isContentEditableFalse(n) && Qb(e, n.parentNode).filter(en.isContentEditableFalse).fold(function () {
            return function (e) {
                U(wa(e, ".mce-offscreen-selection"), Pt)
            }(at.fromDom(e.getBody())), sp(e, t, at.fromDom(e.selection.getNode())), Xw(e), !0
        }, function () {
            return !0
        })
    }

    function nC(e, t, n, r, o, i) {
        var a = Dy(r, e, i.getNode(!o), o, !0);
        if (t.collapsed) {
            var u = t.cloneRange();
            o ? u.setEnd(a.startContainer, a.startOffset) : u.setStart(a.endContainer, a.endOffset), u.deleteContents()
        } else t.deleteContents();
        return e.selection.setRng(a), function (e, t) {
            en.isText(t) && 0 === t.data.length && e.remove(t)
        }(e.dom, n), !0
    }

    function rC(t, n) {
        return function (e) {
            return fy(n, e).map(function (e) {
                return xy.setCaretPosition(t, e), !0
            }).getOr(!1)
        }
    }

    function oC(e, t, n, r) {
        var o = e.getBody(), i = d(hy.isInlineTarget, e);
        e.undoManager.ignore(function () {
            e.selection.setRng(function (e, t) {
                var n = j.document.createRange();
                return n.setStart(e.container(), e.offset()), n.setEnd(t.container(), t.offset()), n
            }(n, r)), e.execCommand("Delete"), vy(i, o, Ic.fromRangeStart(e.selection.getRng())).map(Cy).map(rC(e, t))
        }), e.nodeChanged()
    }

    function iC(n, r, o, i) {
        var a = function (e, t) {
                var n = kc(t, e);
                return n || e
            }(n.getBody(), i.container()), u = d(hy.isInlineTarget, n),
            c = vy(u, a, i);
        return c.bind(function (e) {
            return o ? e.fold($(D.some(Cy(e))), D.none, $(D.some(by(e))), D.none) : e.fold(D.none, $(D.some(by(e))), D.none, $(D.some(Cy(e))))
        }).map(rC(n, r)).getOrThunk(function () {
            var t = ql.navigate(o, a, i), e = t.bind(function (e) {
                return vy(u, a, e)
            });
            return c.isSome() && e.isSome() ? hy.findRootInline(u, a, i).map(function (e) {
                return !!function (o) {
                    return nu(ql.firstPositionIn(o), ql.lastPositionIn(o), function (e, t) {
                        var n = hy.normalizePosition(!0, e),
                            r = hy.normalizePosition(!1, t);
                        return ql.nextPosition(o, n).map(function (e) {
                            return e.isEqual(r)
                        }).getOr(!0)
                    }).getOr(!0)
                }(e) && (sp(n, o, at.fromDom(e)), !0)
            }).getOr(!1) : e.bind(function (e) {
                return t.map(function (e) {
                    return o ? oC(n, r, i, e) : oC(n, r, e, i), !0
                })
            }).getOr(!1)
        })
    }

    function aC(e) {
        return 1 === Ne(e).length
    }

    function uC(e, t, n, r) {
        var o = d(Yg, t), i = X(G(r, o), function (e) {
            return e.dom()
        });
        if (0 === i.length) sp(t, e, n); else {
            var a = function (e, t) {
                var n = Ug(!1), r = Kg(t, n.dom());
                return Ae(at.fromDom(e), n), Pt(at.fromDom(e)), Ic(r, 0)
            }(n.dom(), i);
            t.selection.setRng(a.toRange())
        }
    }

    function cC(n, r) {
        var e = at.fromDom(n.getBody()), t = at.fromDom(n.selection.getStart()),
            o = G(function (e, t) {
                var n = xm(t, e);
                return p(n, ur).fold($(n), function (e) {
                    return n.slice(0, e)
                })
            }(e, t), aC);
        return E(o).map(function (e) {
            var t = Ic.fromRangeStart(n.selection.getRng());
            return !(!Yw(r, t, e.dom()) || function (e) {
                return lc(e.dom()) && Ig(e.dom())
            }(e)) && (uC(r, n, e, o), !0)
        }).getOr(!1)
    }

    function sC(e, t) {
        return {start: $(e), end: $(t)}
    }

    function lC(e, t) {
        return Aa(at.fromDom(e), "td,th", t)
    }

    function fC(e, t) {
        return ka(e, "table", t)
    }

    function dC(e) {
        return !1 === ve(e.start(), e.end())
    }

    function hC(e, n) {
        return fC(e.start(), n).bind(function (t) {
            return fC(e.end(), n).bind(function (e) {
                return function (e, t) {
                    return e ? D.some(t) : D.none()
                }(ve(t, e), t)
            })
        })
    }

    function mC(e) {
        return wa(e, "td,th")
    }

    function gC(n, e) {
        var t = lC(e.startContainer, n), r = lC(e.endContainer, n);
        return e.collapsed ? D.none() : nu(t, r, sC).fold(function () {
            return t.fold(function () {
                return r.bind(function (t) {
                    return fC(t, n).bind(function (e) {
                        return z(mC(e)).map(function (e) {
                            return sC(e, t)
                        })
                    })
                })
            }, function (t) {
                return fC(t, n).bind(function (e) {
                    return E(mC(e)).map(function (e) {
                        return sC(t, e)
                    })
                })
            })
        }, function (e) {
            return lx(n, e) ? D.none() : function (t, e) {
                return fC(t.start(), e).bind(function (e) {
                    return E(mC(e)).map(function (e) {
                        return sC(t.start(), e)
                    })
                })
            }(e, n)
        })
    }

    function pC(t, e) {
        return hC(t, e).map(function (e) {
            return function (e, t, n) {
                return {rng: $(e), table: $(t), cells: $(n)}
            }(t, e, mC(e))
        })
    }

    function vC(e, t) {
        var n = function (t) {
            return function (e) {
                return ve(t, e)
            }
        }(e);
        return function (e, t) {
            var n = lC(e.startContainer, t), r = lC(e.endContainer, t);
            return nu(n, r, sC).filter(dC).filter(function (e) {
                return lx(t, e)
            }).orThunk(function () {
                return gC(t, e)
            })
        }(t, n).bind(function (e) {
            return pC(e, n)
        })
    }

    function yC(e, t) {
        return p(e, function (e) {
            return ve(e, t)
        })
    }

    function bC(n) {
        return function (n) {
            return nu(yC(n.cells(), n.rng().start()), yC(n.cells(), n.rng().end()), function (e, t) {
                return n.cells().slice(e, t + 1)
            })
        }(n).map(function (e) {
            var t = n.cells();
            return e.length === t.length ? sx.removeTable(n.table()) : sx.emptyCells(e)
        })
    }

    function CC(e, t) {
        return U(t, tp), e.selection.setCursorLocation(t[0].dom(), 0), !0
    }

    function wC(e, t) {
        return sp(e, !1, t), !0
    }

    function xC(t, e, n) {
        return function (e, t) {
            return vC(e, t).bind(bC)
        }(e, n).map(function (e) {
            return e.fold(d(wC, t), d(CC, t))
        })
    }

    function zC(t, e, n, r) {
        return fx(e, r).fold(function () {
            return xC(t, e, n)
        }, function (e) {
            return function (e, t) {
                return dx(e, t)
            }(t, e)
        }).getOr(!1)
    }

    function EC(e, t) {
        return g(xm(t, e), hr)
    }

    function NC(t, n, r, o, i) {
        return ql.navigate(r, t.getBody(), i).bind(function (e) {
            return function (e, n, r, o) {
                return ql.firstPositionIn(e.dom()).bind(function (t) {
                    return ql.lastPositionIn(e.dom()).map(function (e) {
                        return n ? r.isEqual(t) && o.isEqual(e) : r.isEqual(e) && o.isEqual(t)
                    })
                }).getOr(!0)
            }(o, r, i, e) ? function (e, t) {
                return dx(e, t)
            }(t, o) : function (e, t, n) {
                return fx(e, at.fromDom(n.getNode())).map(function (e) {
                    return !1 === ve(e, t)
                })
            }(n, o, e)
        }).or(D.some(!0))
    }

    function SC(t, n, r, e) {
        var o = Ic.fromRangeStart(t.selection.getRng());
        return EC(r, e).bind(function (e) {
            return cp(e) ? dx(t, e) : function (e, t, n, r, o) {
                return ql.navigate(n, e.getBody(), o).bind(function (e) {
                    return EC(t, at.fromDom(e.getNode())).map(function (e) {
                        return !1 === ve(e, r)
                    })
                })
            }(t, r, n, e, o)
        }).getOr(!1)
    }

    function kC(e, t) {
        return e ? Qy(t) : eb(t)
    }

    function TC(t, n, e) {
        var r = at.fromDom(t.getBody());
        return fx(r, e).fold(function () {
            return SC(t, n, r, e) || function (e, t) {
                var n = Ic.fromRangeStart(e.selection.getRng());
                return kC(t, n) || ql.fromPosition(t, e.getBody(), n).map(function (e) {
                    return kC(t, e)
                }).getOr(!1)
            }(t, n)
        }, function (e) {
            return function (e, t, n, r) {
                var o = Ic.fromRangeStart(e.selection.getRng());
                return cp(r) ? dx(e, r) : NC(e, n, t, r, o)
            }(t, n, r, e).getOr(!1)
        })
    }

    function AC(e) {
        var t = parseInt(e, 10);
        return isNaN(t) ? 0 : t
    }

    function MC(e, t) {
        return (e || function (e) {
            return "table" === He(e)
        }(t) ? "margin" : "padding") + ("rtl" === Ze(t, "direction") ? "-right" : "-left")
    }

    function RC(e) {
        var t = gx(e);
        return !e.mode.isReadOnly() && (1 < t.length || function (r, e) {
            return b(e, function (e) {
                var t = MC(As(r), e), n = Je(e, t).map(AC).getOr(0);
                return "false" !== r.dom.getContentEditable(e.dom()) && 0 < n
            })
        }(e, t))
    }

    function DC(e) {
        return sr(e) || lr(e)
    }

    function _C(e, t) {
        var n = e.dom, r = e.selection, o = e.formatter, i = Ms(e),
            a = /[a-z%]+$/i.exec(i)[0], u = parseInt(i, 10), c = As(e),
            s = us(e);
        e.queryCommandState("InsertUnorderedList") || e.queryCommandState("InsertOrderedList") || "" !== s || n.getParent(r.getNode(), n.isBlock) || o.apply("div"), U(gx(e), function (e) {
            !function (e, t, n, r, o, i) {
                var a = MC(n, at.fromDom(i));
                if ("outdent" === t) {
                    var u = Math.max(0, AC(i.style[a]) - r);
                    e.setStyle(i, a, u ? u + o : "")
                } else {
                    u = AC(i.style[a]) + r + o;
                    e.setStyle(i, a, u)
                }
            }(n, t, c, u, a, e.dom())
        })
    }

    function OC(e, t, n) {
        return ql.navigateIgnore(e, t, n, Py)
    }

    function HC(e, t) {
        return g(xm(at.fromDom(t.container()), e), ur)
    }

    function BC(e, n, r) {
        return OC(e, n.dom(), r).forall(function (t) {
            return HC(n, r).fold(function () {
                return !1 === Tc(t, r, n.dom())
            }, function (e) {
                return !1 === Tc(t, r, n.dom()) && Ht(e, at.fromDom(t.container()))
            })
        })
    }

    function PC(t, n, r) {
        return HC(n, r).fold(function () {
            return OC(t, n.dom(), r).forall(function (e) {
                return !1 === Tc(e, r, n.dom())
            })
        }, function (e) {
            return OC(t, e.dom(), r).isNone()
        })
    }

    function LC(e) {
        return D.from(e.dom.getParent(e.selection.getStart(!0), e.dom.isBlock))
    }

    function VC(e, t) {
        return e && e.parentNode && e.parentNode.nodeName === t
    }

    function IC(e) {
        return e && /^(OL|UL|LI)$/.test(e.nodeName)
    }

    function FC(e) {
        var t = e.parentNode;
        return /^(LI|DT|DD)$/.test(t.nodeName) ? t : e
    }

    function UC(e, t, n) {
        for (var r = e[n ? "firstChild" : "lastChild"]; r && !en.isElement(r);) r = r[n ? "nextSibling" : "previousSibling"];
        return r === t
    }

    function jC(e) {
        e.innerHTML = '<br data-mce-bogus="1">'
    }

    function qC(e, t) {
        return e.nodeName === t || e.previousSibling && e.previousSibling.nodeName === t
    }

    function $C(e, t) {
        return t && e.isBlock(t) && !/^(TD|TH|CAPTION|FORM)$/.test(t.nodeName) && !/^(fixed|absolute)/i.test(t.style.position) && "true" !== e.getContentEditable(t)
    }

    function WC(e, t, n) {
        return !1 === en.isText(t) ? n : e ? 1 === n && t.data.charAt(n - 1) === gu.ZWSP ? 0 : n : n === t.data.length - 1 && t.data.charAt(n) === gu.ZWSP ? t.data.length : n
    }

    function KC(e, t) {
        var n, r, o = e.getRoot();
        for (n = t; n !== o && "false" !== e.getContentEditable(n);) "true" === e.getContentEditable(n) && (r = n), n = n.parentNode;
        return n !== o ? r : o
    }

    function XC(o, i, e) {
        D.from(e.style).map(o.dom.parseStyle).each(function (e) {
            var t = function (e) {
                var t = {}, n = e.dom();
                if (We(n)) for (var r = 0; r < n.style.length; r++) {
                    var o = n.style.item(r);
                    t[o] = n.style[o]
                }
                return t
            }(at.fromDom(i)), n = ne(ne({}, t), e);
            o.dom.setStyles(i, n)
        });
        var t = D.from(e["class"]).map(function (e) {
            return e.split(/\s+/)
        }), n = D.from(i.className).map(function (e) {
            return G(e.split(/\s+/), function (e) {
                return "" !== e
            })
        });
        nu(t, n, function (t, e) {
            var n = G(e, function (e) {
                return !h(t, e)
            }), r = function c() {
                for (var e = 0, t = 0, n = arguments.length; t < n; t++) e += arguments[t].length;
                var r = Array(e), o = 0;
                for (t = 0; t < n; t++) for (var i = arguments[t], a = 0, u = i.length; a < u; a++, o++) r[o] = i[a];
                return r
            }(t, n);
            o.dom.setAttrib(i, "class", r.join(" "))
        });
        var r = ["style", "class"], a = function (e, t) {
            var n = {};
            return T(e, t, k(n), u), n
        }(e, function (e, t) {
            return !h(r, t)
        });
        o.dom.setAttribs(i, a)
    }

    function YC(e, t) {
        var n = us(e);
        if (n && n.toLowerCase() === t.tagName.toLowerCase()) {
            var r = cs(e);
            XC(e, t, r)
        }
    }

    function GC(e, t, n) {
        var r = e.create("span", {}, "&nbsp;");
        n.parentNode.insertBefore(r, n), t.scrollIntoView(r), e.remove(r)
    }

    function ZC(e, t, n, r) {
        var o = e.createRng();
        r ? (o.setStartBefore(n), o.setEndBefore(n)) : (o.setStartAfter(n), o.setEndAfter(n)), t.setRng(o)
    }

    function JC(e, t) {
        var n, r, o = e.selection, i = e.dom, a = o.getRng();
        Vm(i, a).each(function (e) {
            a.setStart(e.startContainer, e.startOffset), a.setEnd(e.endContainer, e.endOffset)
        });
        var u = a.startOffset, c = a.startContainer;
        if (1 === c.nodeType && c.hasChildNodes()) {
            var s = u > c.childNodes.length - 1;
            c = c.childNodes[Math.min(u, c.childNodes.length - 1)] || c, u = s && 3 === c.nodeType ? c.nodeValue.length : 0
        }
        var l = i.getParent(c, i.isBlock),
            f = l ? i.getParent(l.parentNode, i.isBlock) : null,
            d = f ? f.nodeName.toUpperCase() : "", h = !(!t || !t.ctrlKey);
        "LI" !== d || h || (l = f), c && 3 === c.nodeType && u >= c.nodeValue.length && !function (e, t, n) {
            for (var r, o = new Ui(t, n), i = e.getNonEmptyElements(); r = o.next();) if (i[r.nodeName.toLowerCase()] || 0 < r.length) return !0
        }(e.schema, c, l) && (n = i.create("br"), a.insertNode(n), a.setStartAfter(n), a.setEndAfter(n), r = !0), n = i.create("br"), Qu(i, a, n), GC(i, o, n), ZC(i, o, n, r), e.undoManager.add()
    }

    function QC(e, t) {
        var n = at.fromTag("br");
        Ae(at.fromDom(t), n), e.undoManager.add()
    }

    function ew(e, t) {
        Ax(e.getBody(), t) || Me(at.fromDom(t), at.fromTag("br"));
        var n = at.fromTag("br");
        Me(at.fromDom(t), n), GC(e.dom, e.selection, n.dom()), ZC(e.dom, e.selection, n.dom(), !1), e.undoManager.add()
    }

    function tw(e) {
        return e && "A" === e.nodeName && "href" in e
    }

    function nw(e) {
        return e.fold($(!1), tw, tw, $(!1))
    }

    function rw(e, t) {
        t.fold(u, d(QC, e), d(ew, e), u)
    }

    function ow(e, t) {
        return Ex(e).filter(function (e) {
            return 0 < t.length && ge(at.fromDom(e), t)
        }).isSome()
    }

    function iw(e, t) {
        return Dx(e)
    }

    function aw(n) {
        return function (e, t) {
            return "" === us(e) === n
        }
    }

    function uw(n) {
        return function (e, t) {
            return Sx(e) === n
        }
    }

    function cw(n, r) {
        return function (e, t) {
            return Nx(e) === n.toUpperCase() === r
        }
    }

    function sw(e) {
        return cw("pre", e)
    }

    function lw(n) {
        return function (e, t) {
            return as(e) === n
        }
    }

    function fw(e, t) {
        return Rx(e)
    }

    function dw(e, t) {
        return t
    }

    function hw(e) {
        var t = us(e), n = zx(e.dom, e.selection.getStart());
        return n && e.schema.isValidChild(n.nodeName, t || "P")
    }

    function mw(e, t) {
        return function (n, r) {
            return y(e, function (e, t) {
                return e && t(n, r)
            }, !0) ? D.some(t) : D.none()
        }
    }

    function gw(n, r) {
        var e = r.container(), t = r.offset();
        return en.isText(e) ? (e.insertData(t, n), D.some(Ku(e, t + n.length))) : Hc(r).map(function (e) {
            var t = at.fromText(n);
            return r.isAtEnd() ? Me(e, t) : Ae(e, t), Ku(t.dom(), n.length)
        })
    }

    function pw(e) {
        return Ku.isTextPosition(e) && !e.isAtStart() && !e.isAtEnd()
    }

    function vw(e, t) {
        var n = G(xm(at.fromDom(t.container()), e), ur);
        return z(n).getOr(e)
    }

    function yw(e, t) {
        return pw(t) ? Gy(t) : Gy(t) || ql.prevPosition(vw(e, t).dom(), t).exists(Gy)
    }

    function bw(e, t) {
        return pw(t) ? Yy(t) : Yy(t) || ql.nextPosition(vw(e, t).dom(), t).exists(Yy)
    }

    function Cw(e) {
        return Hc(e).bind(function (e) {
            return Sa(e, Lt)
        }).exists(function (e) {
            return function (e) {
                return h(["pre", "pre-wrap"], e)
            }(Ze(e, "white-space"))
        })
    }

    function ww(e, t) {
        return function (e, t) {
            return ql.prevPosition(e.dom(), t).isNone()
        }(e, t) || function (e, t) {
            return ql.nextPosition(e.dom(), t).isNone()
        }(e, t) || px(e, t) || vx(e, t) || Yb(e, t) || Xb(e, t)
    }

    function xw(e, t) {
        var n = function (e) {
            var t = e.container(), n = e.offset();
            return en.isText(t) && n < t.data.length ? Ku(t, n + 1) : e
        }(t);
        return !Cw(n) && (vx(e, n) || bx(e, n) || Xb(e, n) || bw(e, n))
    }

    function zw(e, t) {
        return function (e, t) {
            return !Cw(t) && (px(e, t) || yx(e, t) || Yb(e, t) || yw(e, t))
        }(e, t) || xw(e, t)
    }

    function Ew(e, t) {
        return Yl(e.charAt(t))
    }

    function Nw(e) {
        var t = e.container();
        return en.isText(t) && ue(t.data, $r)
    }

    function Sw(e) {
        var t = e.data, n = function (e) {
            var n = e.split("");
            return X(n, function (e, t) {
                return Yl(e) && 0 < t && t < n.length - 1 && sl(n[t - 1]) && sl(n[t + 1]) ? " " : e
            }).join("")
        }(t);
        return n !== t && (e.data = n, !0)
    }

    function kw(n, e) {
        return D.some(e).filter(Nw).bind(function (e) {
            var t = e.container();
            return function (e, t) {
                var n = t.data, r = Ku(t, 0);
                return !(!Ew(n, 0) || zw(e, r)) && (t.data = " " + n.slice(1), !0)
            }(n, t) || Sw(t) || function (e, t) {
                var n = t.data, r = Ku(t, n.length - 1);
                return !(!Ew(n, n.length - 1) || zw(e, r)) && (t.data = n.slice(0, -1) + " ", !0)
            }(n, t) ? D.some(e) : D.none()
        })
    }

    function Tw(t) {
        var e = at.fromDom(t.getBody());
        t.selection.isCollapsed() && kw(e, Ku.fromRangeStart(t.selection.getRng())).each(function (e) {
            t.selection.setRng(e.toRange())
        })
    }

    function Aw(t, n) {
        return function (e) {
            return function (e, t) {
                return !Cw(t) && (ww(e, t) || yw(e, t) || bw(e, t))
            }(t, e) ? Px(n) : Lx(n)
        }
    }

    function Mw(e) {
        var t = Ic.fromRangeStart(e.selection.getRng()),
            n = at.fromDom(e.getBody());
        if (e.selection.isCollapsed()) {
            var r = d(hy.isInlineTarget, e),
                o = Ic.fromRangeStart(e.selection.getRng());
            return vy(r, e.getBody(), o).bind(function (t) {
                return function (e) {
                    return e.fold(function (e) {
                        return ql.prevPosition(t.dom(), Ic.before(e))
                    }, function (e) {
                        return ql.firstPositionIn(e)
                    }, function (e) {
                        return ql.lastPositionIn(e)
                    }, function (e) {
                        return ql.nextPosition(t.dom(), Ic.after(e))
                    })
                }
            }(n)).bind(Aw(n, t)).exists(function (t) {
                return function (e) {
                    return t.selection.setRng(e.toRange()), t.nodeChanged(), !0
                }
            }(e))
        }
        return !1
    }

    function Rw(e, t) {
        t.hasAttribute("data-mce-caret") && (qa(t), function (e) {
            e.selection.setRng(e.selection.getRng())
        }(e), e.selection.scrollIntoView(t))
    }

    function Dw(e, t) {
        var n = function (e) {
            return Ta(at.fromDom(e.getBody()), "*[data-mce-caret]").fold($(null), function (e) {
                return e.dom()
            })
        }(e);
        if (n) return "compositionstart" === t.type ? (t.preventDefault(), t.stopPropagation(), void Rw(e, n)) : void (Ia(n) && (Rw(e, n), e.undoManager.add()))
    }

    function _w(t) {
        !function (e) {
            var t = da(function () {
                e.composing || Tw(e)
            }, 0);
            Fx.isIE() && (e.on("keypress", function (e) {
                t.throttle()
            }), e.on("remove", function (e) {
                t.cancel()
            }))
        }(t), t.on("input", function (e) {
            !1 === e.isComposing && Tw(t)
        })
    }

    var Ow = d(ob, Ku.isAbove, -1), Hw = d(ob, Ku.isBelow, 1),
        Bw = d(ib, -1, Ow), Pw = d(ib, 1, Hw), Lw = en.isContentEditableFalse,
        Vw = Qa, Iw = d(mb, function (e) {
            return e.bottom
        }, function (e, t) {
            return e.y < t
        }), Fw = d(mb, function (e) {
            return e.top
        }, function (e, t) {
            return e.y > t
        }), Uw = d(yb, Ow), jw = d(yb, Hw), qw = function (e) {
            for (var t = [], n = 1; n < arguments.length; n++) t[n - 1] = arguments[n];
            var r = Array.prototype.slice.call(arguments, 1);
            return function () {
                return e.apply(null, r)
            }
        }, $w = function (e, t) {
            return g(Db(e, t), function (e) {
                return e.action()
            })
        }, Ww = function (t, n) {
            t.on("keydown", function (e) {
                !1 === e.isDefaultPrevented() && function (e, t, n) {
                    var r = de().os;
                    $w([{keyCode: ph.RIGHT, action: fb(e, !0)}, {
                        keyCode: ph.LEFT,
                        action: fb(e, !1)
                    }, {keyCode: ph.UP, action: db(e, !1)}, {
                        keyCode: ph.DOWN,
                        action: db(e, !0)
                    }, {keyCode: ph.RIGHT, action: zb(e, !0)}, {
                        keyCode: ph.LEFT,
                        action: zb(e, !1)
                    }, {keyCode: ph.UP, action: Eb(e, !1)}, {
                        keyCode: ph.DOWN,
                        action: Eb(e, !0)
                    }, {
                        keyCode: ph.RIGHT,
                        action: xy.move(e, t, !0)
                    }, {
                        keyCode: ph.LEFT,
                        action: xy.move(e, t, !1)
                    }, {
                        keyCode: ph.RIGHT,
                        ctrlKey: !r.isOSX(),
                        altKey: r.isOSX(),
                        action: xy.moveNextWord(e, t)
                    }, {
                        keyCode: ph.LEFT,
                        ctrlKey: !r.isOSX(),
                        altKey: r.isOSX(),
                        action: xy.movePrevWord(e, t)
                    }, {keyCode: ph.UP, action: Rb(e, !1)}, {
                        keyCode: ph.DOWN,
                        action: Rb(e, !0)
                    }], n).each(function (e) {
                        n.preventDefault()
                    })
                }(t, n, e)
            })
        }, Kw = function (e, t) {
            return Ht(e, t) ? Sa(t, function (e) {
                return cr(e) || lr(e)
            }, function (t) {
                return function (e) {
                    return ve(t, at.fromDom(e.dom().parentNode))
                }
            }(e)) : D.none()
        }, Xw = function (e) {
            e.dom.isEmpty(e.getBody()) && (e.setContent(""), function (e) {
                var t = e.getBody(),
                    n = t.firstChild && e.dom.isBlock(t.firstChild) ? t.firstChild : t;
                e.selection.setCursorLocation(n, 0)
            }(e))
        }, Yw = function (i, a, u) {
            return nu(ql.firstPositionIn(u), ql.lastPositionIn(u), function (e, t) {
                var n = hy.normalizePosition(!0, e),
                    r = hy.normalizePosition(!1, t),
                    o = hy.normalizePosition(!1, a);
                return i ? ql.nextPosition(u, o).map(function (e) {
                    return e.isEqual(r) && a.isEqual(n)
                }).getOr(!1) : ql.prevPosition(u, o).map(function (e) {
                    return e.isEqual(n) && a.isEqual(r)
                }).getOr(!1)
            }).getOr(!0)
        }, Gw = function (e, t, n) {
            return n.collapsed ? Hb(e, t, n) : D.none()
        }, Zw = function (e, t, n, r) {
            return t ? Ub(e, r, n) : Ub(e, n, r)
        }, Jw = function (t, n) {
            var r = at.fromDom(t.getBody()),
                e = Gw(r.dom(), n, t.selection.getRng()).bind(function (e) {
                    return Zw(r, n, e.from().block(), e.to().block())
                });
            return e.each(function (e) {
                t.selection.setRng(e.toRange())
            }), e.isSome()
        }, Qw = function (e, t) {
            return !e.selection.isCollapsed() && $b(e)
        }, ex = d(Kb, !1), tx = d(Kb, !0),
        nx = vd([{remove: ["element"]}, {moveToElement: ["element"]}, {moveToPosition: ["position"]}]),
        rx = function (e, t) {
            for (; t && t !== e;) {
                if (en.isContentEditableTrue(t) || en.isContentEditableFalse(t)) return t;
                t = t.parentNode
            }
            return null
        }, ox = function (e, t) {
            return e.selection.isCollapsed() ? eC(e, t) : tC(e, t)
        }, ix = function (e) {
            var t, n = rx(e.getBody(), e.selection.getNode());
            return en.isContentEditableTrue(n) && e.dom.isBlock(n) && e.dom.isEmpty(n) && (t = e.dom.create("br", {"data-mce-bogus": "1"}), e.dom.setHTML(n, ""), n.appendChild(t), e.selection.setRng(Ic.before(t).toRange())), !0
        }, ax = function (e, t) {
            return function (e, t) {
                var n = e.selection.getRng();
                if (!en.isText(n.commonAncestorContainer)) return !1;
                var r = t ? Lc.Forwards : Lc.Backwards, o = Ys(e.getBody()),
                    i = d(Bc, o.next), a = d(Bc, o.prev), u = t ? i : a,
                    c = t ? tb : nb, s = Oc(r, e.getBody(), n),
                    l = hy.normalizePosition(t, u(s));
                if (!l || !Pc(s, l)) return !1;
                if (c(l)) return nC(e, n, s.getNode(), r, t, l);
                var f = u(l);
                return !!(f && c(f) && Pc(l, f)) && nC(e, n, s.getNode(), r, t, f)
            }(e, t)
        }, ux = function (e, t, n) {
            if (e.selection.isCollapsed() && function (e) {
                return !1 !== e.settings.inline_boundaries
            }(e)) {
                var r = Ic.fromRangeStart(e.selection.getRng());
                return iC(e, t, n, r)
            }
            return !1
        }, cx = function (e, t) {
            return !!e.selection.isCollapsed() && cC(e, t)
        }, sx = vd([{removeTable: ["element"]}, {emptyCells: ["cells"]}]),
        lx = function (e, t) {
            return hC(t, e).isSome()
        }, fx = function (e, t) {
            return g(xm(t, e), function (e) {
                return "caption" === He(e)
            })
        }, dx = function (e, t) {
            return tp(t), e.selection.setCursorLocation(t.dom(), 0), D.some(!0)
        }, hx = function (e, t) {
            var n = at.fromDom(e.selection.getStart(!0)), r = Hm(e);
            return e.selection.isCollapsed() && 0 === r.length ? TC(e, t, n) : function (e, t) {
                var n = at.fromDom(e.getBody()), r = e.selection.getRng(),
                    o = Hm(e);
                return 0 !== o.length ? CC(e, o) : zC(e, n, r, t)
            }(e, n)
        }, mx = function (e, t) {
            return !!e.selection.isCollapsed() && function (t, n) {
                var e = Ic.fromRangeStart(t.selection.getRng());
                return ql.fromPosition(n, t.getBody(), e).filter(function (e) {
                    return n ? Zy(e) : Jy(e)
                }).bind(function (e) {
                    return D.from(Ac(n ? 0 : -1, e))
                }).map(function (e) {
                    return t.selection.select(e), !0
                }).getOr(!1)
            }(e, t)
        }, gx = function (e) {
            return G(X(e.selection.getSelectedBlocks(), at.fromDom), function (e) {
                return !DC(e) && !function (e) {
                    return Ce(e).map(DC).getOr(!1)
                }(e) && function (e) {
                    return Sa(e, function (e) {
                        return en.isContentEditableTrue(e.dom()) || en.isContentEditableFalse(e.dom())
                    }).exists(function (e) {
                        return en.isContentEditableTrue(e.dom())
                    })
                }(e)
            })
        }, px = d(PC, !1), vx = d(PC, !0), yx = d(BC, !1), bx = d(BC, !0),
        Cx = function (e, t, n) {
            if (e.selection.isCollapsed() && RC(e)) {
                var r = e.dom, o = e.selection.getRng(),
                    i = Ic.fromRangeStart(o),
                    a = r.getParent(o.startContainer, r.isBlock);
                if (null !== a && px(at.fromDom(a), i)) return _C(e, "outdent"), !0
            }
            return !1
        }, wx = function (t, n) {
            t.on("keydown", function (e) {
                !1 === e.isDefaultPrevented() && function (e, t, n) {
                    $w([{
                        keyCode: ph.BACKSPACE,
                        action: qw(Cx, e, !1)
                    }, {
                        keyCode: ph.BACKSPACE,
                        action: qw(ox, e, !1)
                    }, {
                        keyCode: ph.DELETE,
                        action: qw(ox, e, !0)
                    }, {
                        keyCode: ph.BACKSPACE,
                        action: qw(ax, e, !1)
                    }, {
                        keyCode: ph.DELETE,
                        action: qw(ax, e, !0)
                    }, {
                        keyCode: ph.BACKSPACE,
                        action: qw(ux, e, t, !1)
                    }, {
                        keyCode: ph.DELETE,
                        action: qw(ux, e, t, !0)
                    }, {
                        keyCode: ph.BACKSPACE,
                        action: qw(hx, e, !1)
                    }, {
                        keyCode: ph.DELETE,
                        action: qw(hx, e, !0)
                    }, {
                        keyCode: ph.BACKSPACE,
                        action: qw(mx, e, !1)
                    }, {
                        keyCode: ph.DELETE,
                        action: qw(mx, e, !0)
                    }, {
                        keyCode: ph.BACKSPACE,
                        action: qw(Qw, e, !1)
                    }, {
                        keyCode: ph.DELETE,
                        action: qw(Qw, e, !0)
                    }, {
                        keyCode: ph.BACKSPACE,
                        action: qw(Jw, e, !1)
                    }, {
                        keyCode: ph.DELETE,
                        action: qw(Jw, e, !0)
                    }, {
                        keyCode: ph.BACKSPACE,
                        action: qw(cx, e, !1)
                    }, {
                        keyCode: ph.DELETE,
                        action: qw(cx, e, !0)
                    }], n).each(function (e) {
                        n.preventDefault()
                    })
                }(t, n, e)
            }), t.on("keyup", function (e) {
                !1 === e.isDefaultPrevented() && function (e, t) {
                    $w([{
                        keyCode: ph.BACKSPACE,
                        action: qw(ix, e)
                    }, {keyCode: ph.DELETE, action: qw(ix, e)}], t)
                }(t, e)
            })
        }, xx = function (e, t) {
            var n, r, o = t, i = e.dom,
                a = e.schema.getMoveCaretBeforeOnEnterElements();
            if (t) {
                if (/^(LI|DT|DD)$/.test(t.nodeName)) {
                    var u = function (e) {
                        for (; e;) {
                            if (1 === e.nodeType || 3 === e.nodeType && e.data && /[\r\n\s]/.test(e.data)) return e;
                            e = e.nextSibling
                        }
                    }(t.firstChild);
                    u && /^(UL|OL|DL)$/.test(u.nodeName) && t.insertBefore(i.doc.createTextNode($r), t.firstChild)
                }
                if (r = i.createRng(), t.normalize(), t.hasChildNodes()) {
                    for (var c = new Ui(t, t); n = c.current();) {
                        if (en.isText(n)) {
                            r.setStart(n, 0), r.setEnd(n, 0);
                            break
                        }
                        if (a[n.nodeName.toLowerCase()]) {
                            r.setStartBefore(n), r.setEndBefore(n);
                            break
                        }
                        o = n, n = c.next()
                    }
                    n || (r.setStart(o, 0), r.setEnd(o, 0))
                } else en.isBr(t) ? t.nextSibling && i.isBlock(t.nextSibling) ? (r.setStartBefore(t), r.setEndBefore(t)) : (r.setStartAfter(t), r.setEndAfter(t)) : (r.setStart(t, 0), r.setEnd(t, 0));
                e.selection.setRng(r), ym(e, r)
            }
        }, zx = function (e, t) {
            var n, r, o = e.getRoot();
            for (n = t; n !== o && "false" !== e.getContentEditable(n);) "true" === e.getContentEditable(n) && (r = n), n = n.parentNode;
            return n !== o ? r : o
        }, Ex = LC, Nx = function (e) {
            return LC(e).fold($(""), function (e) {
                return e.nodeName.toUpperCase()
            })
        }, Sx = function (e) {
            return LC(e).filter(function (e) {
                return lr(at.fromDom(e))
            }).isSome()
        }, kx = function (e, t, n, r, o) {
            var i = e.dom, a = e.selection.getRng();
            if (n !== e.getBody()) {
                !function (e) {
                    return IC(e) && IC(e.parentNode)
                }(n) || (o = "LI");
                var u = o ? t(o) : i.create("BR");
                if (UC(n, r, !0) && UC(n, r, !1)) VC(n, "LI") ? i.insertAfter(u, FC(n)) : i.replace(u, n); else if (UC(n, r, !0)) VC(n, "LI") ? (i.insertAfter(u, FC(n)), u.appendChild(i.doc.createTextNode(" ")), u.appendChild(n)) : n.parentNode.insertBefore(u, n); else if (UC(n, r, !1)) i.insertAfter(u, FC(n)); else {
                    n = FC(n);
                    var c = a.cloneRange();
                    c.setStartAfter(r), c.setEndAfter(n);
                    var s = c.extractContents();
                    "LI" === o && function (e, t) {
                        return e.firstChild && e.firstChild.nodeName === t
                    }(s, "LI") ? (u = s.firstChild, i.insertAfter(s, n)) : (i.insertAfter(s, n), i.insertAfter(u, n))
                }
                i.remove(r), xx(e, u)
            }
        }, Tx = function (a, e) {
            function t(e) {
                var t, n, r, o = c, i = b.getTextInlineElements();
                if (r = t = e || "TABLE" === m || "HR" === m ? y.create(e || p) : s.cloneNode(!1), !1 === fs(a)) y.setAttrib(t, "style", null), y.setAttrib(t, "class", null); else do {
                    if (i[o.nodeName]) {
                        if (lc(o) || Xl(o)) continue;
                        n = o.cloneNode(!1), y.setAttrib(n, "id", ""), t.hasChildNodes() ? n.appendChild(t.firstChild) : r = n, t.appendChild(n)
                    }
                } while ((o = o.parentNode) && o !== u);
                return YC(a, t), jC(r), t
            }

            function n(e) {
                var t, n, r = WC(e, c, i);
                if (en.isText(c) && (e ? 0 < r : r < c.nodeValue.length)) return !1;
                if (c.parentNode === s && v && !e) return !0;
                if (e && en.isElement(c) && c === s.firstChild) return !0;
                if (qC(c, "TABLE") || qC(c, "HR")) return v && !e || !v && e;
                var o = new Ui(c, s);
                for (en.isText(c) && (e && 0 === r ? o.prev() : e || r !== c.nodeValue.length || o.next()); t = o.current();) {
                    if (en.isElement(t)) {
                        if (!t.getAttribute("data-mce-bogus") && (n = t.nodeName.toLowerCase(), C[n] && "br" !== n)) return !1
                    } else if (en.isText(t) && !/^[ \t\r\n]*$/.test(t.nodeValue)) return !1;
                    e ? o.prev() : o.next()
                }
                return !0
            }

            function r() {
                f = /^(H[1-6]|PRE|FIGURE)$/.test(m) && "HGROUP" !== g ? t(p) : t(), ds(a) && $C(y, h) && y.isEmpty(s) ? f = y.split(h, s) : y.insertAfter(f, s), xx(a, f)
            }

            var o, u, c, i, s, l, f, d, h, m, g, p, v, y = a.dom, b = a.schema,
                C = b.getNonEmptyElements(), w = a.selection.getRng();
            Vm(y, w).each(function (e) {
                w.setStart(e.startContainer, e.startOffset), w.setEnd(e.endContainer, e.endOffset)
            }), c = w.startContainer, i = w.startOffset, p = us(a), l = !(!e || !e.shiftKey);
            var x = !(!e || !e.ctrlKey);
            en.isElement(c) && c.hasChildNodes() && (v = i > c.childNodes.length - 1, c = c.childNodes[Math.min(i, c.childNodes.length - 1)] || c, i = v && en.isText(c) ? c.nodeValue.length : 0), (u = KC(y, c)) && ((p && !l || !p && l) && (c = function (e, t, n, r, o) {
                var i, a, u, c, s, l, f = t || "P", d = e.dom, h = KC(d, r);
                if (!(a = d.getParent(r, d.isBlock)) || !$C(d, a)) {
                    if (l = (a = a || h) === e.getBody() || function (e) {
                        return e && /^(TD|TH|CAPTION)$/.test(e.nodeName)
                    }(a) ? a.nodeName.toLowerCase() : a.parentNode.nodeName.toLowerCase(), !a.hasChildNodes()) return i = d.create(f), YC(e, i), a.appendChild(i), n.setStart(i, 0), n.setEnd(i, 0), i;
                    for (c = r; c.parentNode !== a;) c = c.parentNode;
                    for (; c && !d.isBlock(c);) c = (u = c).previousSibling;
                    if (u && e.schema.isValidChild(l, f.toLowerCase())) {
                        for (i = d.create(f), YC(e, i), u.parentNode.insertBefore(i, u), c = u; c && !d.isBlock(c);) s = c.nextSibling, i.appendChild(c), c = s;
                        n.setStart(r, o), n.setEnd(r, o)
                    }
                }
                return r
            }(a, p, w, c, i)), s = y.getParent(c, y.isBlock), h = s ? y.getParent(s.parentNode, y.isBlock) : null, m = s ? s.nodeName.toUpperCase() : "", "LI" !== (g = h ? h.nodeName.toUpperCase() : "") || x || (h = (s = h).parentNode, m = g), /^(LI|DT|DD)$/.test(m) && y.isEmpty(s) ? kx(a, t, h, s, p) : p && s === a.getBody() || (p = p || "P", Pa(s) ? (f = qa(s), y.isEmpty(s) && jC(s), YC(a, f), xx(a, f)) : n() ? r() : n(!0) ? (f = s.parentNode.insertBefore(t(), s), xx(a, qC(s, "HR") ? f : s)) : ((o = function (e) {
                var t = e.cloneRange();
                return t.setStart(e.startContainer, WC(!0, e.startContainer, e.startOffset)), t.setEnd(e.endContainer, WC(!1, e.endContainer, e.endOffset)), t
            }(w).cloneRange()).setEndAfter(s), function (e) {
                U(za(at.fromDom(e), Vt), function (e) {
                    var t = e.dom();
                    t.nodeValue = gu.trim(t.nodeValue)
                })
            }(d = o.extractContents()), function (e) {
                for (; en.isText(e) && (e.nodeValue = e.nodeValue.replace(/^[\r\n]+/, "")), e = e.firstChild;) ;
            }(d), f = d.firstChild, y.insertAfter(d, s), function (e, t, n) {
                var r, o = n, i = [];
                if (o) {
                    for (; o = o.firstChild;) {
                        if (e.isBlock(o)) return;
                        en.isElement(o) && !t[o.nodeName.toLowerCase()] && i.push(o)
                    }
                    for (r = i.length; r--;) !(o = i[r]).hasChildNodes() || o.firstChild === o.lastChild && "" === o.firstChild.nodeValue ? e.remove(o) : (a = e, (u = o) && "A" === u.nodeName && a.isEmpty(u) && e.remove(o));
                    var a, u
                }
            }(y, C, f), function (e, t) {
                var n;
                t.normalize(), (n = t.lastChild) && !/^(left|right)$/gi.test(e.getStyle(n, "float", !0)) || e.add(t, "br")
            }(y, s), y.isEmpty(s) && jC(s), f.normalize(), y.isEmpty(f) ? (y.remove(f), r()) : (YC(a, f), xx(a, f))), y.setAttrib(f, "id", ""), a.fire("NewBlock", {newBlock: f})))
        }, Ax = function (e, t) {
            return !!function (e) {
                return en.isBr(e.getNode())
            }(Ic.after(t)) || ql.nextPosition(e, Ic.after(t)).map(function (e) {
                return en.isBr(e.getNode())
            }).getOr(!1)
        }, Mx = function (e, t) {
            var n = function (e) {
                var t = d(hy.isInlineTarget, e),
                    n = Ic.fromRangeStart(e.selection.getRng());
                return vy(t, e.getBody(), n).filter(nw)
            }(e);
            n.isSome() ? n.each(d(rw, e)) : JC(e, t)
        }, Rx = function (e) {
            return ow(e, ss(e))
        }, Dx = function (e) {
            return ow(e, ls(e))
        }, _x = vd([{br: []}, {block: []}, {none: []}]), Ox = function (e, t) {
            return my([mw([iw], _x.none()), mw([cw("summary", !0)], _x.br()), mw([sw(!0), lw(!1), dw], _x.br()), mw([sw(!0), lw(!1)], _x.block()), mw([sw(!0), lw(!0), dw], _x.block()), mw([sw(!0), lw(!0)], _x.br()), mw([uw(!0), dw], _x.br()), mw([uw(!0)], _x.block()), mw([aw(!0), dw, hw], _x.block()), mw([aw(!0)], _x.br()), mw([fw], _x.br()), mw([aw(!1), dw], _x.br()), mw([hw], _x.block())], [e, !(!t || !t.shiftKey)]).getOr(_x.none())
        }, Hx = function (e, t) {
            Ox(e, t).fold(function () {
                Mx(e, t)
            }, function () {
                Tx(e, t)
            }, u)
        }, Bx = function (t) {
            t.on("keydown", function (e) {
                e.keyCode === ph.ENTER && function (e, t) {
                    t.isDefaultPrevented() || (t.preventDefault(), function (e) {
                        e.typing && (e.typing = !1, e.add())
                    }(e.undoManager), e.undoManager.transact(function () {
                        !1 === e.selection.isCollapsed() && e.execCommand("Delete"), Hx(e, t)
                    }))
                }(t, e)
            })
        }, Px = d(gw, $r), Lx = d(gw, " "), Vx = function (t) {
            t.on("keydown", function (e) {
                !1 === e.isDefaultPrevented() && function (e, t) {
                    $w([{
                        keyCode: ph.SPACEBAR,
                        action: qw(Mw, e)
                    }], t).each(function (e) {
                        t.preventDefault()
                    })
                }(t, e)
            })
        }, Ix = function (e) {
            e.on("keyup compositionstart", d(Dw, e))
        }, Fx = de().browser, Ux = function (t) {
            t.on("keydown", function (e) {
                !1 === e.isDefaultPrevented() && function (e, t) {
                    $w([{keyCode: ph.END, action: hb(e, !0)}, {
                        keyCode: ph.HOME,
                        action: hb(e, !1)
                    }], t).each(function (e) {
                        t.preventDefault()
                    })
                }(t, e)
            })
        }, jx = function (e) {
            var t = xy.setupSelectedState(e);
            Ix(e), Ww(e, t), wx(e, t), Bx(e), Vx(e), _w(e), Ux(e)
        }, qx = ($x.prototype.nodeChanged = function (e) {
            var t, n, r, o = this.editor.selection;
            this.editor.initialized && o && !this.editor.settings.disable_nodechange && !this.editor.mode.isReadOnly() && (r = this.editor.getBody(), (t = o.getStart(!0) || r).ownerDocument === this.editor.getDoc() && this.editor.dom.isChildOf(t, r) || (t = r), n = [], this.editor.dom.getParent(t, function (e) {
                if (e === r) return !0;
                n.push(e)
            }), (e = e || {}).element = t, e.parents = n, this.editor.fire("NodeChange", e))
        }, $x.prototype.isSameElementPath = function (e) {
            var t, n;
            if ((n = this.editor.$(e).parentsUntil(this.editor.getBody()).add(e)).length === this.lastPath.length) {
                for (t = n.length; 0 <= t && n[t] === this.lastPath[t]; t--) ;
                if (-1 === t) return this.lastPath = n, !0
            }
            return this.lastPath = n, !1
        }, $x);

    function $x(r) {
        var o;
        this.lastPath = [], this.editor = r;
        var t = this;
        "onselectionchange" in r.getDoc() || r.on("NodeChange click mouseup keyup focus", function (e) {
            var t, n;
            n = {
                startContainer: (t = r.selection.getRng()).startContainer,
                startOffset: t.startOffset,
                endContainer: t.endContainer,
                endOffset: t.endOffset
            }, "nodechange" !== e.type && Lm(n, o) || r.fire("SelectionChange"), o = n
        }), r.on("contextmenu", function () {
            r.fire("SelectionChange")
        }), r.on("SelectionChange", function () {
            var e = r.selection.getStart(!0);
            !e || !Kn.range && r.selection.isCollapsed() || Ih(r) && !t.isSameElementPath(e) && r.dom.isChildOf(e, r.getBody()) && r.nodeChanged({selectionChange: !0})
        }), r.on("mouseup", function (e) {
            !e.isDefaultPrevented() && Ih(r) && ("IMG" === r.selection.getNode().nodeName ? Ln.setEditorTimeout(r, function () {
                r.nodeChanged()
            }) : r.nodeChanged())
        })
    }

    function Wx(e) {
        !function (t) {
            t.on("click", function (e) {
                t.dom.getParent(e.target, "details") && e.preventDefault()
            })
        }(e), function (e) {
            e.parser.addNodeFilter("details", function (e) {
                U(e, function (e) {
                    e.attr("data-mce-open", e.attr("open")), e.attr("open", "open")
                })
            }), e.serializer.addNodeFilter("details", function (e) {
                U(e, function (e) {
                    var t = e.attr("data-mce-open");
                    e.attr("open", K(t) ? t : null), e.attr("data-mce-open", null)
                })
            })
        }(e)
    }

    function Kx(e) {
        return en.isElement(e) && cr(at.fromDom(e))
    }

    function Xx(t) {
        t.on("click", function (e) {
            3 <= e.detail && function (e) {
                var t = e.selection.getRng(), n = Ku.fromRangeStart(t),
                    r = Ku.fromRangeEnd(t);
                if (Ku.isElementPosition(n)) {
                    var o = n.container();
                    Kx(o) && ql.firstPositionIn(o).each(function (e) {
                        return t.setStart(e.container(), e.offset())
                    })
                }
                if (Ku.isElementPosition(r)) {
                    o = n.container();
                    Kx(o) && ql.lastPositionIn(o).each(function (e) {
                        return t.setEnd(e.container(), e.offset())
                    })
                }
                e.selection.setRng(Vp(t))
            }(t)
        })
    }

    function Yx(e) {
        var t, n, r, o;
        return o = e.getBoundingClientRect(), n = (t = e.ownerDocument).documentElement, r = t.defaultView, {
            top: o.top + r.pageYOffset - n.clientTop,
            left: o.left + r.pageXOffset - n.clientLeft
        }
    }

    function Gx(e) {
        e && e.parentNode && e.parentNode.removeChild(e)
    }

    function Zx(i, a) {
        return function (e) {
            if (function (e) {
                return 0 === e.button
            }(e)) {
                var t = g(a.dom.getParents(e.target), _u(Az, Mz)).getOr(null);
                if (function (e, t) {
                    return Az(t) && t !== e
                }(a.getBody(), t)) {
                    var n = a.dom.getPos(t), r = a.getBody(),
                        o = a.getDoc().documentElement;
                    i.element = t, i.screenX = e.screenX, i.screenY = e.screenY, i.maxX = (a.inline ? r.scrollWidth : o.offsetWidth) - 2, i.maxY = (a.inline ? r.scrollHeight : o.offsetHeight) - 2, i.relX = e.pageX - n.x, i.relY = e.pageY - n.y, i.width = t.offsetWidth, i.height = t.offsetHeight, i.ghost = function (e, t, n, r) {
                        var o = t.cloneNode(!0);
                        e.dom.setStyles(o, {
                            width: n,
                            height: r
                        }), e.dom.setAttrib(o, "data-mce-selected", null);
                        var i = e.dom.create("div", {
                            "class": "mce-drag-container",
                            "data-mce-bogus": "all",
                            unselectable: "on",
                            contenteditable: "false"
                        });
                        return e.dom.setStyles(i, {
                            position: "absolute",
                            opacity: .5,
                            overflow: "hidden",
                            border: 0,
                            padding: 0,
                            margin: 0,
                            width: n,
                            height: r
                        }), e.dom.setStyles(o, {
                            margin: 0,
                            boxSizing: "border-box"
                        }), i.appendChild(o), i
                    }(a, t, i.width, i.height)
                }
            }
        }
    }

    function Jx(r, o) {
        return function (e) {
            if (r.dragging && function (e, t, n) {
                return t !== n && !e.dom.isChildOf(t, n) && !Az(t)
            }(o, function (e) {
                var t = e.getSel().getRangeAt(0).startContainer;
                return 3 === t.nodeType ? t.parentNode : t
            }(o.selection), r.element)) {
                var t = function (e) {
                    var t = e.cloneNode(!0);
                    return t.removeAttribute("data-mce-selected"), t
                }(r.element), n = o.fire("drop", {
                    targetClone: t,
                    clientX: e.clientX,
                    clientY: e.clientY
                });
                n.isDefaultPrevented() || (t = n.targetClone, o.undoManager.transact(function () {
                    Gx(r.element), o.insertContent(o.dom.getOuterHTML(t)), o._selectionOverrides.hideFakeCaret()
                }))
            }
            Rz(r)
        }
    }

    function Qx(e) {
        var t, n, r, o, i, a, u = {};
        t = ea.DOM, a = j.document, n = Zx(u, e), r = function (r, o) {
            var i = Ln.throttle(function (e, t) {
                o._selectionOverrides.hideFakeCaret(), o.selection.placeCaretAt(e, t)
            }, 0);
            return function (e) {
                var t = Math.max(Math.abs(e.screenX - r.screenX), Math.abs(e.screenY - r.screenY));
                if (function (e) {
                    return e.element
                }(r) && !r.dragging && 10 < t) {
                    if (o.fire("dragstart", {target: r.element}).isDefaultPrevented()) return;
                    r.dragging = !0, o.focus()
                }
                if (r.dragging) {
                    var n = function (e, t) {
                        return {pageX: t.pageX - e.relX, pageY: t.pageY + 5}
                    }(r, Tz(o, e));
                    !function (e, t) {
                        e.parentNode !== t && t.appendChild(e)
                    }(r.ghost, o.getBody()), function (e, t, n, r, o, i) {
                        var a = 0, u = 0;
                        e.style.left = t.pageX + "px", e.style.top = t.pageY + "px", t.pageX + n > o && (a = t.pageX + n - o), t.pageY + r > i && (u = t.pageY + r - i), e.style.width = n - a + "px", e.style.height = r - u + "px"
                    }(r.ghost, n, r.width, r.height, r.maxX, r.maxY), i(e.clientX, e.clientY)
                }
            }
        }(u, e), o = Jx(u, e), i = function (e, t) {
            return function () {
                e.dragging && t.fire("dragend"), Rz(e)
            }
        }(u, e), e.on("mousedown", n), e.on("mousemove", r), e.on("mouseup", o), t.bind(a, "mousemove", r), t.bind(a, "mouseup", i), e.on("remove", function () {
            t.unbind(a, "mousemove", r), t.unbind(a, "mouseup", i)
        })
    }

    function ez(e, t) {
        for (var n = e.getBody(); t && t !== n;) {
            if (Oz(t) || Hz(t)) return t;
            t = t.parentNode
        }
        return null
    }

    function tz(g) {
        function a(e) {
            e && g.selection.setRng(e)
        }

        function r() {
            return g.selection.getRng()
        }

        function p(e, t, n, r) {
            return void 0 === r && (r = !0), g.fire("ShowCaret", {
                target: t,
                direction: e,
                before: n
            }).isDefaultPrevented() ? null : (r && g.selection.scrollIntoView(t, -1 === e), o.show(n, t))
        }

        function t(e) {
            return Va(e) || yu(e) || bu(e)
        }

        var v, y = g.getBody(), o = Cc(g, y, function (e) {
            return g.dom.isBlock(e)
        }, function () {
            return Bd(g)
        }), b = "sel-" + g.dom.uniqueId(), C = function (e) {
            return t(e.startContainer) || t(e.endContainer)
        }, u = function (e) {
            var t = g.schema.getShortEndedElements(), n = g.dom.createRng(),
                r = e.startContainer, o = e.startOffset, i = e.endContainer,
                a = e.endOffset;
            return te(t, r.nodeName.toLowerCase()) ? 0 === o ? n.setStartBefore(r) : n.setStartAfter(r) : n.setStart(r, o), te(t, i.nodeName.toLowerCase()) ? 0 === a ? n.setEndBefore(i) : n.setEndAfter(i) : n.setEnd(i, a), n
        }, c = function (e, t) {
            var n, r, o, i, a, u, c, s, l, f, d = g.$, h = g.dom;
            if (!e) return null;
            if (e.collapsed) {
                if (!C(e)) if (!1 === t) {
                    if (s = Oc(-1, y, e), xc(s.getNode(!0))) return p(-1, s.getNode(!0), !1, !1);
                    if (xc(s.getNode())) return p(-1, s.getNode(), !s.isAtEnd(), !1)
                } else {
                    if (s = Oc(1, y, e), xc(s.getNode())) return p(1, s.getNode(), !s.isAtEnd(), !1);
                    if (xc(s.getNode(!0))) return p(1, s.getNode(!0), !1, !1)
                }
                return null
            }
            if (i = e.startContainer, a = e.startOffset, u = e.endOffset, 3 === i.nodeType && 0 === a && Hz(i.parentNode) && (i = i.parentNode, a = h.nodeIndex(i), i = i.parentNode), 1 !== i.nodeType) return null;
            if (u === a + 1 && i === e.endContainer && (n = i.childNodes[a]), !Hz(n)) return null;
            if (l = f = n.cloneNode(!0), (c = g.fire("ObjectSelected", {
                target: n,
                targetClone: l
            })).isDefaultPrevented()) return null;
            r = Ta(at.fromDom(g.getBody()), "#" + b).fold(function () {
                return d([])
            }, function (e) {
                return d([e.dom()])
            }), l = c.targetClone, 0 === r.length && (r = d('<div data-mce-bogus="all" class="mce-offscreen-selection"></div>').attr("id", b)).appendTo(g.getBody()), e = g.dom.createRng(), l === f && Kn.ie ? (r.empty().append('<p style="font-size: 0" data-mce-bogus="all">\xa0</p>').append(l), e.setStartAfter(r[0].firstChild.firstChild), e.setEndAfter(l)) : (r.empty().append($r).append(l).append($r), e.setStart(r[0].firstChild, 1), e.setEnd(r[0].lastChild, 0)), r.css({top: h.getPos(n, g.getBody()).y}), r[0].focus(), (o = g.selection.getSel()).removeAllRanges(), o.addRange(e);
            var m = at.fromDom(n);
            return U(wa(at.fromDom(g.getBody()), "*[data-mce-selected]"), function (e) {
                ve(m, e) || Ge(e, "data-mce-selected")
            }), g.dom.getAttrib(n, "data-mce-selected") || n.setAttribute("data-mce-selected", "1"), v = n, w(), e
        }, s = function () {
            v && (v.removeAttribute("data-mce-selected"), Ta(at.fromDom(g.getBody()), "#" + b).each(Pt), v = null), Ta(at.fromDom(g.getBody()), "#" + b).each(Pt), v = null
        }, w = function () {
            o.hide()
        };
        return Kn.ceFalse && function () {
            g.on("mouseup", function (e) {
                var t = r();
                t.collapsed && Qd(g, e.clientX, e.clientY) && a(Oy(g, t, !1))
            }), g.on("click", function (e) {
                var t;
                (t = ez(g, e.target)) && (Hz(t) && (e.preventDefault(), g.focus()), Oz(t) && g.dom.isChildOf(t, g.selection.getNode()) && s())
            }), g.on("blur NewBlock", function () {
                s()
            }), g.on("ResizeWindow FullscreenStateChanged", function () {
                return o.reposition()
            });

            function i(e, t) {
                var n = g.dom.getParent(e, g.dom.isBlock),
                    r = g.dom.getParent(t, g.dom.isBlock);
                return !(!n || !g.dom.isChildOf(n, r) || !1 !== Hz(ez(g, n))) || n && !function (e, t) {
                    return g.dom.getParent(e, g.dom.isBlock) === g.dom.getParent(t, g.dom.isBlock)
                }(n, r) && function (e) {
                    var t = Ys(e);
                    if (!e.firstChild) return !1;
                    var n = Ic.before(e.firstChild), r = t.next(n);
                    return r && !tb(r) && !nb(r)
                }(n)
            }

            var n;
            (n = g).on("tap", function (e) {
                var t = ez(n, e.target);
                Hz(t) && (e.preventDefault(), c(_y(n, t)))
            }, !0), g.on("mousedown", function (e) {
                var t, n = e.target;
                if ((n === y || "HTML" === n.nodeName || g.dom.isChildOf(n, y)) && !1 !== Qd(g, e.clientX, e.clientY)) if (t = ez(g, n)) Hz(t) ? (e.preventDefault(), c(_y(g, t))) : (s(), Oz(t) && e.shiftKey || gh(e.clientX, e.clientY, g.selection.getRng()) || (w(), g.selection.placeCaretAt(e.clientX, e.clientY))); else if (!1 === xc(n)) {
                    s(), w();
                    var r = Ry(y, e.clientX, e.clientY);
                    if (r && !i(e.target, r.node)) {
                        e.preventDefault();
                        var o = p(1, r.node, r.before, !1);
                        g.getBody().focus(), a(o)
                    }
                }
            }), g.on("keypress", function (e) {
                ph.modifierPressed(e) || (e.keyCode, Hz(g.selection.getNode()) && e.preventDefault())
            }), g.on("GetSelectionRange", function (e) {
                var t = e.range;
                if (v) {
                    if (!v.parentNode) return void (v = null);
                    (t = t.cloneRange()).selectNode(v), e.range = t
                }
            }), g.on("SetSelectionRange", function (e) {
                e.range = u(e.range);
                var t = c(e.range, e.forward);
                t && (e.range = t)
            });
            g.on("AfterSetSelectionRange", function (e) {
                var t = e.range;
                C(t) || function (e) {
                    return "mcepastebin" === e.id
                }(t.startContainer.parentNode) || w(), function (e) {
                    return g.dom.hasClass(e, "mce-offscreen-selection")
                }(t.startContainer.parentNode) || s()
            }), g.on("copy", function (e) {
                var t = e.clipboardData;
                if (!e.isDefaultPrevented() && e.clipboardData && !Kn.ie) {
                    var n = function () {
                        var e = g.dom.get(b);
                        return e ? e.getElementsByTagName("*")[0] : e
                    }();
                    n && (e.preventDefault(), t.clearData(), t.setData("text/html", n.outerHTML), t.setData("text/plain", n.outerText))
                }
            }), Dz(g), _z(g)
        }(), {
            showCaret: p, showBlockCaretContainer: function (e) {
                e.hasAttribute("data-mce-caret") && (qa(e), a(r()), g.selection.scrollIntoView(e))
            }, hideFakeCaret: w, destroy: function () {
                o.destroy(), v = null
            }
        }
    }

    function nz(a) {
        function e(e, t) {
            try {
                a.getDoc().execCommand(e, !1, t)
            } catch (n) {
            }
        }

        function u(e) {
            return e.isDefaultPrevented()
        }

        function t() {
            a.shortcuts.add("meta+a", null, "SelectAll")
        }

        function n() {
            a.on("keydown", function (e) {
                if (!u(e) && e.keyCode === i && l.isCollapsed() && 0 === l.getRng().startOffset) {
                    var t = l.getNode().previousSibling;
                    if (t && t.nodeName && "table" === t.nodeName.toLowerCase()) return e.preventDefault(), !1
                }
            })
        }

        function r() {
            a.inline || (a.contentStyles.push("body {min-height: 150px}"), a.on("click", function (e) {
                var t;
                if ("HTML" === e.target.nodeName) {
                    if (11 < Kn.ie) return void a.getBody().focus();
                    t = a.selection.getRng(), a.getBody().focus(), a.selection.setRng(t), a.selection.normalize(), a.nodeChanged()
                }
            }))
        }

        var o = Jn.each, i = ph.BACKSPACE, c = ph.DELETE, s = a.dom,
            l = a.selection, f = a.settings, d = a.parser, h = Kn.gecko,
            m = Kn.ie, g = Kn.webkit, p = "data:text/mce-internal,",
            v = m ? "Text" : "URL";

        function y(e) {
            var t = s.create("body"), n = e.cloneContents();
            return t.appendChild(n), l.serializer.serialize(t, {format: "html"})
        }

        function b() {
            var e = s.getAttribs(l.getStart().cloneNode(!1));
            return function () {
                var t = l.getStart();
                t !== a.getBody() && (s.setAttrib(t, "style", null), o(e, function (e) {
                    t.setAttributeNode(e.cloneNode(!0))
                }))
            }
        }

        function C() {
            return !l.isCollapsed() && s.getParent(l.getStart(), s.isBlock) !== s.getParent(l.getEnd(), s.isBlock)
        }

        return a.on("keydown", function (e) {
            var t, n, r, o, i;
            if (!u(e) && e.keyCode === ph.BACKSPACE && (n = (t = l.getRng()).startContainer, r = t.startOffset, o = s.getRoot(), i = n, t.collapsed && 0 === r)) {
                for (; i && i.parentNode && i.parentNode.firstChild === i && i.parentNode !== o;) i = i.parentNode;
                "BLOCKQUOTE" === i.tagName && (a.formatter.toggle("blockquote", null, i), (t = s.createRng()).setStart(n, 0), t.setEnd(n, 0), l.setRng(t))
            }
        }), a.on("keydown", function (e) {
            var t, n, r = e.keyCode;
            if (!u(e) && (r === c || r === i)) {
                if (t = a.selection.isCollapsed(), n = a.getBody(), t && !s.isEmpty(n)) return;
                if (!t && !function (e) {
                    var t = y(e), n = s.createRng();
                    return n.selectNode(a.getBody()), t === y(n)
                }(a.selection.getRng())) return;
                e.preventDefault(), a.setContent(""), n.firstChild && s.isBlock(n.firstChild) ? a.selection.setCursorLocation(n.firstChild, 0) : a.selection.setCursorLocation(n, 0), a.nodeChanged()
            }
        }), Kn.windowsPhone || a.on("keyup focusin mouseup", function (e) {
            ph.modifierPressed(e) || l.normalize()
        }, !0), g && (a.inline || s.bind(a.getDoc(), "mousedown mouseup", function (e) {
            var t;
            if (e.target === a.getDoc().documentElement) if (t = l.getRng(), a.getBody().focus(), "mousedown" === e.type) {
                if (Va(t.startContainer)) return;
                l.placeCaretAt(e.clientX, e.clientY)
            } else l.setRng(t)
        }), a.on("click", function (e) {
            var t = e.target;
            /^(IMG|HR)$/.test(t.nodeName) && "false" !== s.getContentEditableParent(t) && (e.preventDefault(), a.selection.select(t), a.nodeChanged()), "A" === t.nodeName && s.hasClass(t, "mce-item-anchor") && (e.preventDefault(), l.select(t))
        }), f.forced_root_block && a.on("init", function () {
            e("DefaultParagraphSeparator", us(a))
        }), a.on("init", function () {
            a.dom.bind(a.getBody(), "submit", function (e) {
                e.preventDefault()
            })
        }), n(), d.addNodeFilter("br", function (e) {
            for (var t = e.length; t--;) "Apple-interchange-newline" === e[t].attr("class") && e[t].remove()
        }), Kn.iOS ? (a.inline || a.on("keydown", function () {
            j.document.activeElement === j.document.body && a.getWin().focus()
        }), r(), a.on("click", function (e) {
            var t = e.target;
            do {
                if ("A" === t.tagName) return void e.preventDefault()
            } while (t = t.parentNode)
        }), a.contentStyles.push(".mce-content-body {-webkit-touch-callout: none}")) : t()), 11 <= Kn.ie && (r(), n()), Kn.ie && (t(), e("AutoUrlDetect", !1), a.on("dragstart", function (e) {
            !function (e) {
                var t, n;
                e.dataTransfer && (a.selection.isCollapsed() && "IMG" === e.target.tagName && l.select(e.target), 0 < (t = a.selection.getContent()).length && (n = p + escape(a.id) + "," + escape(t), e.dataTransfer.setData(v, n)))
            }(e)
        }), a.on("drop", function (e) {
            if (!u(e)) {
                var t = function (e) {
                    var t;
                    return e.dataTransfer && (t = e.dataTransfer.getData(v)) && 0 <= t.indexOf(p) ? (t = t.substr(p.length).split(","), {
                        id: unescape(t[0]),
                        html: unescape(t[1])
                    }) : null
                }(e);
                if (t && t.id !== a.id) {
                    e.preventDefault();
                    var n = bm(e.x, e.y, a.getDoc());
                    l.setRng(n), function (e, t) {
                        a.queryCommandSupported("mceInsertClipboardContent") ? a.execCommand("mceInsertClipboardContent", !1, {
                            content: e,
                            internal: t
                        }) : a.execCommand("mceInsertContent", !1, e)
                    }(t.html, !0)
                }
            }
        })), h && (a.on("keydown", function (e) {
            if (!u(e) && e.keyCode === i) {
                if (!a.getBody().getElementsByTagName("hr").length) return;
                if (l.isCollapsed() && 0 === l.getRng().startOffset) {
                    var t = l.getNode(), n = t.previousSibling;
                    if ("HR" === t.nodeName) return s.remove(t), void e.preventDefault();
                    n && n.nodeName && "hr" === n.nodeName.toLowerCase() && (s.remove(n), e.preventDefault())
                }
            }
        }), j.Range.prototype.getClientRects || a.on("mousedown", function (e) {
            if (!u(e) && "HTML" === e.target.nodeName) {
                var t = a.getBody();
                t.blur(), Ln.setEditorTimeout(a, function () {
                    t.focus()
                })
            }
        }), a.on("keypress", function (e) {
            var t;
            if (!u(e) && (8 === e.keyCode || 46 === e.keyCode) && C()) return t = b(), a.getDoc().execCommand("delete", !1, null), t(), e.preventDefault(), !1
        }), s.bind(a.getDoc(), "cut", function (e) {
            var t;
            !u(e) && C() && (t = b(), Ln.setEditorTimeout(a, function () {
                t()
            }))
        }), f.readonly || a.on("BeforeExecCommand mousedown", function () {
            e("StyleWithCSS", !1), e("enableInlineTableEditing", !1), f.object_resizing || e("enableObjectResizing", !1)
        }), a.on("SetContent ExecCommand", function (e) {
            "setcontent" !== e.type && "mceInsertLink" !== e.command || o(s.select("a"), function (e) {
                var t = e.parentNode, n = s.getRoot();
                if (t.lastChild === e) {
                    for (; t && !s.isBlock(t);) {
                        if (t.parentNode.lastChild !== t || t === n) return;
                        t = t.parentNode
                    }
                    s.add(t, "br", {"data-mce-bogus": 1})
                }
            })
        }), a.contentStyles.push("img:-moz-broken {-moz-force-broken-image-icon:1;min-width:24px;min-height:24px}"), Kn.mac && a.on("keydown", function (e) {
            !ph.metaKeyPressed(e) || e.shiftKey || 37 !== e.keyCode && 39 !== e.keyCode || (e.preventDefault(), a.selection.getSel().modify("move", 37 === e.keyCode ? "backward" : "forward", "lineboundary"))
        }), n()), {
            refreshContentEditable: function () {
            }, isHidden: function () {
                var e;
                return !(!h || a.removed) && (!(e = a.selection.getSel()) || !e.rangeCount || 0 === e.rangeCount)
            }
        }
    }

    function rz(e) {
        e.bindPendingEventDelegates(), e.initialized = !0, function (e) {
            e.fire("Init")
        }(e), e.focus(!0), function (r) {
            var e = r.dom.getRoot();
            r.inline || Ih(r) && r.selection.getStart(!0) !== e || ql.firstPositionIn(e).each(function (e) {
                var t = e.getNode(),
                    n = en.isTable(t) ? ql.firstPositionIn(t).getOr(e) : e;
                Kn.browser.isIE() ? Nd(r, n.toRange()) : r.selection.setRng(n.toRange())
            })
        }(e), e.nodeChanged({initial: !0}), e.execCallback("init_instance_callback", e), function (t) {
            t.settings.auto_focus && Ln.setEditorTimeout(t, function () {
                var e;
                (e = !0 === t.settings.auto_focus ? t : t.editorManager.get(t.settings.auto_focus)).destroyed || e.focus()
            }, 100)
        }(e)
    }

    function oz(e, t) {
        var n = e.editorManager.translate("Rich Text Area. Press ALT-0 for help."),
            r = function (e, t, n, r) {
                var o = at.fromTag("iframe");
                return Xe(o, r), Xe(o, {
                    id: e + "_ifr",
                    frameBorder: "0",
                    allowTransparency: "true",
                    title: t
                }), ya(o, "tox-edit-area__iframe"), o
            }(e.id, n, t.height, es(e)).dom();
        r.onload = function () {
            r.onload = null, e.fire("load")
        };
        var o = function (e, t) {
            if (j.document.domain !== j.window.location.hostname && Kn.browser.isIE()) {
                var n = Qg("mce");
                e[n] = function () {
                    Pz(e)
                };
                var r = 'javascript:(function(){document.open();document.domain="' + j.document.domain + '";var ed = window.parent.tinymce.get("' + e.id + '");document.write(ed.iframeHTML);document.close();ed.' + n + "(true);})()";
                return Lz.setAttrib(t, "src", r), !0
            }
            return !1
        }(e, r);
        return e.contentAreaContainer = t.iframeContainer, e.iframeElement = r, e.iframeHTML = function (e) {
            var t, n, r;
            return r = ts(e) + "<html><head>", ns(e) !== e.documentBaseUrl && (r += '<base href="' + e.documentBaseURI.getURI() + '" />'), r += '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />', t = rs(e), n = os(e), is(e) && (r += '<meta http-equiv="Content-Security-Policy" content="' + is(e) + '" />'), r += '</head><body id="' + t + '" class="mce-content-body ' + n + '" data-id="' + e.id + '"><br></body></html>'
        }(e), Lz.add(t.iframeContainer, r), o
    }

    function iz(e) {
        return e.replace(/^\-/, "")
    }

    function az(e) {
        return {editorContainer: e, iframeContainer: e}
    }

    function uz(e) {
        var t = e.getElement();
        return e.inline ? az(null) : function (e) {
            var t = Iz.create("div");
            return Iz.insertAfter(t, e), az(t)
        }(t)
    }

    function cz(e) {
        return "-" === e.charAt(0)
    }

    function sz(t, n) {
        (function (e) {
            return D.from(ps(e)).filter(function (e) {
                return 0 < e.length
            }).map(function (e) {
                return {url: e, name: D.none()}
            })
        })(n).orThunk(function () {
            return function (t) {
                return D.from(gs(t)).filter(function (e) {
                    return 0 < e.length && !Xd.has(e)
                }).map(function (e) {
                    return {
                        url: t.editorManager.baseURL + "/icons/" + e + "/icons.js",
                        name: D.some(e)
                    }
                })
            }(n)
        }).each(function (e) {
            t.add(e.url, u, undefined, function () {
                fh.iconsLoadError(n, e.url, e.name.getOrUndefined())
            })
        })
    }

    function lz(e, t) {
        var n = oa.ScriptLoader;
        !function (e, t, n, r) {
            var o = t.settings, i = o.theme;
            if (K(i)) {
                if (!cz(i) && !rh.urls.hasOwnProperty(i)) {
                    var a = o.theme_url;
                    a ? rh.load(i, t.documentBaseURI.toAbsolute(a)) : rh.load(i, "themes/" + i + "/theme" + n + ".js")
                }
                e.loadQueue(function () {
                    rh.waitFor(i, r)
                })
            } else r()
        }(n, e, t, function () {
            !function (e, t) {
                var n = ks(t), r = Ts(t);
                if (!1 === la.hasCode(n) && "en" !== n) {
                    var o = "" !== r ? r : t.editorManager.baseURL + "/langs/" + n + ".js";
                    e.add(o, u, undefined, function () {
                        fh.languageLoadError(t, o, n)
                    })
                }
            }(n, e), sz(n, e), function (r, n, o) {
                O(n.plugins) && (n.plugins = n.plugins.join(" ")), Jn.each(n.external_plugins, function (e, t) {
                    nh.load(t, e, u, undefined, function () {
                        fh.pluginLoadError(r, e, t)
                    }), n.plugins += " " + t
                }), Jn.each(n.plugins.split(/[ ,]/), function (e) {
                    if ((e = Jn.trim(e)) && !nh.urls[e]) if (cz(e)) {
                        e = e.substr(1, e.length);
                        var t = nh.dependencies(e);
                        Jn.each(t, function (e) {
                            var t = {
                                prefix: "plugins/",
                                resource: e,
                                suffix: "/plugin" + o + ".js"
                            }, n = nh.createUrl(t, e);
                            nh.load(n.resource, n, u, undefined, function () {
                                fh.pluginLoadError(r, n.prefix + n.resource + n.suffix, n.resource)
                            })
                        })
                    } else {
                        var n = {
                            prefix: "plugins/",
                            resource: e,
                            suffix: "/plugin" + o + ".js"
                        };
                        nh.load(e, n, u, undefined, function () {
                            fh.pluginLoadError(r, n.prefix + n.resource + n.suffix, e)
                        })
                    }
                })
            }(e, e.settings, t), n.loadQueue(function () {
                e.removed || Uz(e)
            }, e, function () {
                e.removed || Uz(e)
            })
        })
    }

    function fz(e, t) {
        return e.getBlockElements()[t.name] && function (e) {
            return e.firstChild && e.firstChild === e.lastChild
        }(t) && function (e) {
            return "br" === e.name || e.value === $r
        }(t.firstChild)
    }

    function dz(e) {
        return Jn.grep(e.childNodes, function (e) {
            return "LI" === e.nodeName
        })
    }

    function hz(e) {
        return e && e.firstChild && e.firstChild === e.lastChild && function (e) {
            return e.data === $r || en.isBr(e)
        }(e.firstChild)
    }

    function mz(e) {
        return 0 < e.length && function (e) {
            return !e.firstChild || hz(e)
        }(e[e.length - 1]) ? e.slice(0, -1) : e
    }

    function gz(e, t) {
        var n = e.getParent(t, e.isBlock);
        return n && "LI" === n.nodeName ? n : null
    }

    function pz(e, t) {
        var n = Ic.after(e), r = Ys(t).prev(n);
        return r ? r.toRange() : null
    }

    function vz(t, e, n) {
        var r = t.parentNode;
        return Jn.each(e, function (e) {
            r.insertBefore(e, t)
        }), function (e, t) {
            var n = Ic.before(e), r = Ys(t).next(n);
            return r ? r.toRange() : null
        }(t, n)
    }

    function yz(e, t) {
        var n = e.selection.getRng(), r = n.startContainer, o = n.startOffset;
        n.collapsed && function (e, t) {
            return en.isText(e) && e.nodeValue[t - 1] === $r
        }(r, o) && en.isText(r) && (r.insertData(o - 1, " "), r.deleteData(o, 1), n.setStart(r, o), n.setEnd(r, o), e.selection.setRng(n)), e.selection.setContent(t)
    }

    function bz(e, t, n) {
        var r, o, i, a, u, c, s, l, f, d, h, m = e.selection, g = e.dom;
        if (/^ | $/.test(t) && (t = function (e, t) {
            var n, r;
            n = e.startContainer, r = e.startOffset;

            function o(e) {
                return n[e] && 3 === n[e].nodeType
            }

            return 3 === n.nodeType && (0 < r ? t = t.replace(/^&nbsp;/, " ") : o("previousSibling") || (t = t.replace(/^ /, "&nbsp;")), r < n.length ? t = t.replace(/&nbsp;(<br>|)$/, " ") : o("nextSibling") || (t = t.replace(/(&nbsp;| )(<br>|)$/, "&nbsp;"))), t
        }(m.getRng(), t)), r = e.parser, h = n.merge, o = zf({validate: e.settings.validate}, e.schema), d = '<span id="mce_marker" data-mce-type="bookmark">&#xFEFF;&#x200B;</span>', c = {
            content: t,
            format: "html",
            selection: !0,
            paste: n.paste
        }, (c = e.fire("BeforeSetContent", c)).isDefaultPrevented()) e.fire("SetContent", {
            content: c.content,
            format: "html",
            selection: !0,
            paste: n.paste
        }); else {
            -1 === (t = c.content).indexOf("{$caret}") && (t += "{$caret}"), t = t.replace(/\{\$caret\}/, d);
            var p = (l = m.getRng()).startContainer || (l.parentElement ? l.parentElement() : null),
                v = e.getBody();
            p === v && m.isCollapsed() && g.isBlock(v.firstChild) && function (e, t) {
                return t && !e.schema.getShortEndedElements()[t.nodeName]
            }(e, v.firstChild) && g.isEmpty(v.firstChild) && ((l = g.createRng()).setStart(v.firstChild, 0), l.setEnd(v.firstChild, 0), m.setRng(l)), m.isCollapsed() || (e.selection.setRng(Vp(e.selection.getRng())), e.getDoc().execCommand("Delete", !1, null), t = function (e, t) {
                var n, r;
                return n = e.startContainer, r = e.startOffset, 3 === n.nodeType && e.collapsed && (n.data[r] === $r ? (n.deleteData(r, 1), /[\u00a0| ]$/.test(t) || (t += " ")) : n.data[r - 1] === $r && (n.deleteData(r - 1, 1), /[\u00a0| ]$/.test(t) || (t = " " + t))), t
            }(e.selection.getRng(), t));
            var y = {
                context: (i = m.getNode()).nodeName.toLowerCase(),
                data: n.data,
                insert: !0
            };
            if (u = r.parse(t, y), !0 === n.paste && $z(e.schema, u) && Kz(g, i)) return l = Wz(o, g, e.selection.getRng(), u), e.selection.setRng(l), void e.fire("SetContent", c);
            if (function (e) {
                for (var t = e; t = t.walk();) 1 === t.type && t.attr("data-mce-fragment", "1")
            }(u), "mce_marker" === (f = u.lastChild).attr("id")) for (f = (s = f).prev; f; f = f.walk(!0)) if (3 === f.type || !g.isBlock(f.name)) {
                e.schema.isValidChild(f.parent.name, "span") && f.parent.insert(s, f, "br" === f.name);
                break
            }
            if (e._selectionOverrides.showBlockCaretContainer(i), y.invalid) {
                for (yz(e, d), i = m.getNode(), a = e.getBody(), 9 === i.nodeType ? i = f = a : f = i; f !== a;) f = (i = f).parentNode;
                t = i === a ? a.innerHTML : g.getOuterHTML(i), t = o.serialize(r.parse(t.replace(/<span (id="mce_marker"|id=mce_marker).+?<\/span>/i, function () {
                    return o.serialize(u)
                }))), i === a ? g.setHTML(a, t) : g.setOuterHTML(i, t)
            } else !function (e, t, n) {
                if ("all" === n.getAttribute("data-mce-bogus")) n.parentNode.insertBefore(e.dom.createFragment(t), n); else {
                    var r = n.firstChild, o = n.lastChild;
                    !r || r === o && "BR" === r.nodeName ? e.dom.setHTML(n, t) : yz(e, t)
                }
            }(e, t = o.serialize(u), i);
            !function (e, t) {
                var n = e.schema.getTextInlineElements(), r = e.dom;
                if (t) {
                    var o = e.getBody(), i = new gp(r);
                    Jn.each(r.select("*[data-mce-fragment]"), function (e) {
                        for (var t = e.parentNode; t && t !== o; t = t.parentNode) n[e.nodeName.toLowerCase()] && i.compare(t, e) && r.remove(e, !0)
                    })
                }
            }(e, h), function (n, e) {
                var t, r, o, i, a, u = n.dom, c = n.selection;
                if (e) {
                    if (n.selection.scrollIntoView(e), t = function (e) {
                        for (var t = n.getBody(); e && e !== t; e = e.parentNode) if ("false" === n.dom.getContentEditable(e)) return e;
                        return null
                    }(e)) return u.remove(e), c.select(t);
                    var s = u.createRng();
                    (i = e.previousSibling) && 3 === i.nodeType ? (s.setStart(i, i.nodeValue.length), Kn.ie || (a = e.nextSibling) && 3 === a.nodeType && (i.appendData(a.data), a.parentNode.removeChild(a))) : (s.setStartBefore(e), s.setEndBefore(e));
                    r = u.getParent(e, u.isBlock), u.remove(e), r && u.isEmpty(r) && (n.$(r).empty(), s.setStart(r, 0), s.setEnd(r, 0), Xz(r) || function (e) {
                        return !!e.getAttribute("data-mce-fragment")
                    }(r) || !(o = function (e) {
                        var t = Ic.fromRangeStart(e);
                        if (t = Ys(n.getBody()).next(t)) return t.toRange()
                    }(s)) ? u.add(r, u.create("br", {"data-mce-bogus": "1"})) : (s = o, u.remove(r))), c.setRng(s)
                }
            }(e, g.get("mce_marker")), function (e) {
                Jn.each(e.getElementsByTagName("*"), function (e) {
                    e.removeAttribute("data-mce-fragment")
                })
            }(e.getBody()), function (e, t) {
                D.from(e.getParent(t, "td,th")).map(at.fromDom).each(np)
            }(e.dom, e.selection.getStart()), e.fire("SetContent", c), e.addVisual()
        }
    }

    function Cz(e, t) {
        e.getDoc().execCommand(t, !1, null)
    }

    function wz(e, t, n) {
        return t(e).orThunk(function () {
            return n(e) ? D.none() : function (e, t, n) {
                for (var r = e.dom(), o = P(n) ? n : $(!1); r.parentNode;) {
                    r = r.parentNode;
                    var i = at.fromDom(r), a = t(i);
                    if (a.isSome()) return a;
                    if (o(i)) break
                }
                return D.none()
            }(e, t, n)
        })
    }

    function xz(e, t, n) {
        function r(t) {
            return Je(t, e).orThunk(function () {
                return "font" === He(t) ? M(Jz, e).bind(function (e) {
                    return function (e, t) {
                        return D.from(Ye(e, t))
                    }(t, e)
                }) : D.none()
            })
        }

        return wz(at.fromDom(n), function (e) {
            return r(e)
        }, function (e) {
            return ve(at.fromDom(t), e)
        })
    }

    function zz(n) {
        return function (t, e) {
            return D.from(e).map(at.fromDom).filter(Lt).bind(function (e) {
                return xz(n, t, e.dom()).or(function (e, t) {
                    return D.from(ea.DOM.getStyle(t, e, !0))
                }(n, e.dom()))
            }).getOr("")
        }
    }

    function Ez(e) {
        return ql.firstPositionIn(e.getBody()).map(function (e) {
            var t = e.container();
            return en.isText(t) ? t.parentNode : t
        })
    }

    function Nz(t) {
        return D.from(t.selection.getRng()).bind(function (e) {
            return function (e, t) {
                return e.startContainer === t && 0 === e.startOffset
            }(e, t.getBody()) ? D.none() : D.from(t.selection.getStart(!0))
        })
    }

    function Sz(e, t) {
        if (/^[0-9\.]+$/.test(t)) {
            var n = parseInt(t, 10);
            if (1 <= n && n <= 7) {
                var r = hs(e), o = ms(e);
                return o ? o[n - 1] || t : r[n - 1] || t
            }
            return t
        }
        return t
    }

    function kz(e, t) {
        var n = Sz(e, t);
        e.formatter.toggle("fontname", {
            value: function (e) {
                var t = e.split(/\s*,\s*/);
                return X(t, function (e) {
                    return -1 === e.indexOf(" ") || ce(e, '"') || ce(e, "'") ? e : "'" + e + "'"
                }).join(",")
            }(n)
        }), e.nodeChanged()
    }

    var Tz = function (e, t) {
            return function (e, t, n) {
                return {
                    pageX: n.left - e.left + t.left,
                    pageY: n.top - e.top + t.top
                }
            }(function (e) {
                return e.inline ? Yx(e.getBody()) : {left: 0, top: 0}
            }(e), function (e) {
                var t = e.getBody();
                return e.inline ? {left: t.scrollLeft, top: t.scrollTop} : {
                    left: 0,
                    top: 0
                }
            }(e), function (e, t) {
                if (t.target.ownerDocument === e.getDoc()) return {
                    left: t.pageX,
                    top: t.pageY
                };
                var n = Yx(e.getContentAreaContainer()), r = function (e) {
                    var t = e.getBody(), n = e.getDoc().documentElement,
                        r = {left: t.scrollLeft, top: t.scrollTop}, o = {
                            left: t.scrollLeft || n.scrollLeft,
                            top: t.scrollTop || n.scrollTop
                        };
                    return e.inline ? r : o
                }(e);
                return {
                    left: t.pageX - n.left + r.left,
                    top: t.pageY - n.top + r.top
                }
            }(e, t))
        }, Az = en.isContentEditableFalse, Mz = en.isContentEditableTrue,
        Rz = function (e) {
            e.dragging = !1, e.element = null, Gx(e.ghost)
        }, Dz = function (e) {
            Qx(e), function (n) {
                n.on("drop", function (e) {
                    var t = "undefined" != typeof e.clientX ? n.getDoc().elementFromPoint(e.clientX, e.clientY) : null;
                    (Az(t) || Az(n.dom.getContentEditableParent(t))) && e.preventDefault()
                })
            }(e)
        }, _z = function (t) {
            var e = da(function () {
                if (!t.removed && t.getBody().contains(j.document.activeElement) && t.selection.getRng().collapsed) {
                    var e = Hy(t, t.selection.getRng(), !1);
                    t.selection.setRng(e)
                }
            }, 0);
            t.on("focus", function () {
                e.throttle()
            }), t.on("blur", function () {
                e.cancel()
            })
        }, Oz = en.isContentEditableTrue, Hz = en.isContentEditableFalse,
        Bz = ea.DOM, Pz = function (t, e) {
            var n, r, o = t.settings, i = t.getElement(), a = t.getDoc();
            o.inline || (t.getElement().style.visibility = t.orgVisibility), e || t.inline || (a.open(), a.write(t.iframeHTML), a.close()), t.inline && (t.on("remove", function () {
                var e = this.getBody();
                Bz.removeClass(e, "mce-content-body"), Bz.removeClass(e, "mce-edit-focus"), Bz.setAttrib(e, "contentEditable", null)
            }), Bz.addClass(i, "mce-content-body"), t.contentDocument = a = j.document, t.contentWindow = j.window, t.bodyElement = i, t.contentAreaContainer = i, o.root_name = i.nodeName.toLowerCase()), (n = t.getBody()).disabled = !0, t.readonly = !!o.readonly, t.readonly || (t.inline && "static" === Bz.getStyle(n, "position", !0) && (n.style.position = "relative"), n.contentEditable = t.getParam("content_editable_state", !0)), n.disabled = !1, t.editorUpload = pg(t), t.schema = Lr(o), t.dom = ea(a, {
                keep_values: !0,
                url_converter: t.convertURL,
                url_converter_scope: t,
                hex_colors: o.force_hex_style_colors,
                update_styles: !0,
                root_element: t.inline ? t.getBody() : null,
                collect: function () {
                    return t.inline
                },
                schema: t.schema,
                contentCssCors: Ns(t),
                referrerPolicy: Ss(t),
                onSetAttrib: function (e) {
                    t.fire("SetAttrib", e)
                }
            }), t.parser = function (u) {
                var e = Xm(u.settings, u.schema);
                return e.addAttributeFilter("src,href,style,tabindex", function (e, t) {
                    for (var n, r, o = e.length, i = u.dom, a = "data-mce-" + t; o--;) if ((r = (n = e[o]).attr(t)) && !n.attr(a)) {
                        if (0 === r.indexOf("data:") || 0 === r.indexOf("blob:")) continue;
                        "style" === t ? ((r = i.serializeStyle(i.parseStyle(r), n.name)).length || (r = null), n.attr(a, r), n.attr(t, r)) : "tabindex" === t ? (n.attr(a, r), n.attr(t, null)) : n.attr(a, u.convertURL(r, t, n.name))
                    }
                }), e.addNodeFilter("script", function (e) {
                    for (var t, n, r = e.length; r--;) 0 !== (n = (t = e[r]).attr("type") || "no/type").indexOf("mce-") && t.attr("type", "mce-" + n)
                }), u.settings.preserve_cdata && e.addNodeFilter("#cdata", function (e) {
                    for (var t, n = e.length; n--;) (t = e[n]).type = 8, t.name = "#comment", t.value = "[CDATA[" + u.dom.encode(t.value) + "]]"
                }), e.addNodeFilter("p,h1,h2,h3,h4,h5,h6,div", function (e) {
                    for (var t, n = e.length, r = u.schema.getNonEmptyElements(); n--;) (t = e[n]).isEmpty(r) && 0 === t.getAll("br").length && (t.append(new gf("br", 1)).shortEnded = !0)
                }), e
            }(t), t.serializer = Jm(o, t), t.selection = jm(t.dom, t.getWin(), t.serializer, t), t.annotator = sf(t), t.formatter = Yp(t), t.undoManager = iv(t), t._nodeChangeDispatcher = new qx(t), t._selectionOverrides = tz(t), ay(t), Wx(t), Xx(t), jx(t), uy(t), cv(t), function (e) {
                e.fire("PreInit")
            }(t), o.browser_spellcheck || o.gecko_spellcheck || (a.body.spellcheck = !1, Bz.setAttrib(n, "spellcheck", "false")), t.quirks = nz(t), function (e) {
                e.fire("PostRender")
            }(t);
            var u = Ds(t);
            u !== undefined && (n.dir = u), o.protect && t.on("BeforeSetContent", function (t) {
                Jn.each(o.protect, function (e) {
                    t.content = t.content.replace(e, function (e) {
                        return "\x3c!--mce:protected " + escape(e) + "--\x3e"
                    })
                })
            }), t.on("SetContent", function () {
                t.addVisual(t.getBody())
            }), t.load({
                initial: !0,
                format: "html"
            }), t.startContent = t.getContent({format: "raw"}), t.on("compositionstart compositionend", function (e) {
                t.composing = "compositionstart" === e.type
            }), 0 < t.contentStyles.length && (r = "", Jn.each(t.contentStyles, function (e) {
                r += e + "\r\n"
            }), t.dom.addStyle(r)), function (e) {
                return e.inline ? Bz.styleSheetLoader : e.dom.styleSheetLoader
            }(t).loadAll(t.contentCSS, function (e) {
                rz(t)
            }, function (e) {
                rz(t)
            }), o.content_style && function (e, t) {
                var n = at.fromDom(e.getDoc().head), r = at.fromTag("style");
                tn(r, "type", "text/css"), Bt(r, at.fromText(t)), Bt(n, r)
            }(t, o.content_style)
        }, Lz = ea.DOM, Vz = function (e, t) {
            var n = oz(e, t);
            t.editorContainer && (Lz.get(t.editorContainer).style.display = e.orgDisplay, e.hidden = Lz.isHidden(t.editorContainer)), e.getElement().style.display = "none", Lz.setAttrib(e.id, "aria-hidden", "true"), n || Pz(e)
        }, Iz = ea.DOM, Fz = function (t, n, e) {
            var r = nh.get(e),
                o = nh.urls[e] || t.documentBaseUrl.replace(/\/$/, "");
            if (e = Jn.trim(e), r && -1 === Jn.inArray(n, e)) {
                if (Jn.each(nh.dependencies(e), function (e) {
                    Fz(t, n, e)
                }), t.plugins[e]) return;
                try {
                    var i = new r(t, o, t.$);
                    (t.plugins[e] = i).init && (i.init(t, o), n.push(e))
                } catch (VN) {
                    fh.pluginInitError(t, e, VN)
                }
            }
        }, Uz = function (e) {
            e.fire("ScriptsLoaded"), function (n) {
                var e = Jn.trim(n.settings.icons), r = n.ui.registry.getAll().icons,
                    t = ne(ne({}, {
                        "accessibility-check": '<svg width="24" height="24"><path d="M12 2a2 2 0 0 1 2 2 2 2 0 0 1-2 2 2 2 0 0 1-2-2c0-1.1.9-2 2-2zm8 7h-5v12c0 .6-.4 1-1 1a1 1 0 0 1-1-1v-5c0-.6-.4-1-1-1a1 1 0 0 0-1 1v5c0 .6-.4 1-1 1a1 1 0 0 1-1-1V9H4a1 1 0 1 1 0-2h16c.6 0 1 .4 1 1s-.4 1-1 1z" fill-rule="nonzero"/></svg>',
                        "action-next": '<svg width="24" height="24"><path fill-rule="nonzero" d="M5.7 7.3a1 1 0 0 0-1.4 1.4l7.7 7.7 7.7-7.7a1 1 0 1 0-1.4-1.4L12 13.6 5.7 7.3z"/></svg>',
                        "action-prev": '<svg width="24" height="24"><path fill-rule="nonzero" d="M18.3 15.7a1 1 0 0 0 1.4-1.4L12 6.6l-7.7 7.7a1 1 0 0 0 1.4 1.4L12 9.4l6.3 6.3z"/></svg>',
                        "align-center": '<svg width="24" height="24"><path d="M5 5h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 1 1 0-2zm3 4h8c.6 0 1 .4 1 1s-.4 1-1 1H8a1 1 0 1 1 0-2zm0 8h8c.6 0 1 .4 1 1s-.4 1-1 1H8a1 1 0 0 1 0-2zm-3-4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 0 1 0-2z" fill-rule="evenodd"/></svg>',
                        "align-justify": '<svg width="24" height="24"><path d="M5 5h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 1 1 0-2zm0 4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 1 1 0-2zm0 4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 0 1 0-2zm0 4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 0 1 0-2z" fill-rule="evenodd"/></svg>',
                        "align-left": '<svg width="24" height="24"><path d="M5 5h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 1 1 0-2zm0 4h8c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 1 1 0-2zm0 8h8c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 0 1 0-2zm0-4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 0 1 0-2z" fill-rule="evenodd"/></svg>',
                        "align-none": '<svg width="24" height="24"><path d="M14.2 5L13 7H5a1 1 0 1 1 0-2h9.2zm4 0h.8a1 1 0 0 1 0 2h-2l1.2-2zm-6.4 4l-1.2 2H5a1 1 0 0 1 0-2h6.8zm4 0H19a1 1 0 0 1 0 2h-4.4l1.2-2zm-6.4 4l-1.2 2H5a1 1 0 0 1 0-2h4.4zm4 0H19a1 1 0 0 1 0 2h-6.8l1.2-2zM7 17l-1.2 2H5a1 1 0 0 1 0-2h2zm4 0h8a1 1 0 0 1 0 2H9.8l1.2-2zm5.2-13.5l1.3.7-9.7 16.3-1.3-.7 9.7-16.3z" fill-rule="evenodd"/></svg>',
                        "align-right": '<svg width="24" height="24"><path d="M5 5h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 1 1 0-2zm6 4h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 0 1 0-2zm0 8h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 0 1 0-2zm-6-4h14c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 0 1 0-2z" fill-rule="evenodd"/></svg>',
                        "arrow-left": '<svg width="24" height="24"><path d="M5.6 13l12 6a1 1 0 0 0 1.4-1V6a1 1 0 0 0-1.4-.9l-12 6a1 1 0 0 0 0 1.8z" fill-rule="evenodd"/></svg>',
                        "arrow-right": '<svg width="24" height="24"><path d="M18.5 13l-12 6A1 1 0 0 1 5 18V6a1 1 0 0 1 1.4-.9l12 6a1 1 0 0 1 0 1.8z" fill-rule="evenodd"/></svg>',
                        bold: '<svg width="24" height="24"><path d="M7.8 19c-.3 0-.5 0-.6-.2l-.2-.5V5.7c0-.2 0-.4.2-.5l.6-.2h5c1.5 0 2.7.3 3.5 1 .7.6 1.1 1.4 1.1 2.5a3 3 0 0 1-.6 1.9c-.4.6-1 1-1.6 1.2.4.1.9.3 1.3.6s.8.7 1 1.2c.4.4.5 1 .5 1.6 0 1.3-.4 2.3-1.3 3-.8.7-2.1 1-3.8 1H7.8zm5-8.3c.6 0 1.2-.1 1.6-.5.4-.3.6-.7.6-1.3 0-1.1-.8-1.7-2.3-1.7H9.3v3.5h3.4zm.5 6c.7 0 1.3-.1 1.7-.4.4-.4.6-.9.6-1.5s-.2-1-.7-1.4c-.4-.3-1-.4-2-.4H9.4v3.8h4z" fill-rule="evenodd"/></svg>',
                        bookmark: '<svg width="24" height="24"><path d="M6 4v17l6-4 6 4V4c0-.6-.4-1-1-1H7a1 1 0 0 0-1 1z" fill-rule="nonzero"/></svg>',
                        "border-width": '<svg width="24" height="24"><path d="M5 14.8h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2zm-.5 3.7h15c.3 0 .5.2.5.5s-.2.5-.5.5h-15a.5.5 0 1 1 0-1zm.5-8.3h14c.6 0 1 .4 1 1v1c0 .5-.4 1-1 1H5a1 1 0 0 1-1-1v-1c0-.6.4-1 1-1zm0-5.7h14c.6 0 1 .4 1 1v2c0 .6-.4 1-1 1H5a1 1 0 0 1-1-1v-2c0-.6.4-1 1-1z" fill-rule="evenodd"/></svg>',
                        brightness: '<svg width="24" height="24"><path d="M12 17c.3 0 .5.1.7.3.2.2.3.4.3.7v1c0 .3-.1.5-.3.7a1 1 0 0 1-.7.3 1 1 0 0 1-.7-.3 1 1 0 0 1-.3-.7v-1c0-.3.1-.5.3-.7.2-.2.4-.3.7-.3zm0-10a1 1 0 0 1-.7-.3A1 1 0 0 1 11 6V5c0-.3.1-.5.3-.7.2-.2.4-.3.7-.3.3 0 .5.1.7.3.2.2.3.4.3.7v1c0 .3-.1.5-.3.7a1 1 0 0 1-.7.3zm7 4c.3 0 .5.1.7.3.2.2.3.4.3.7 0 .3-.1.5-.3.7a1 1 0 0 1-.7.3h-1a1 1 0 0 1-.7-.3 1 1 0 0 1-.3-.7c0-.3.1-.5.3-.7.2-.2.4-.3.7-.3h1zM7 12c0 .3-.1.5-.3.7a1 1 0 0 1-.7.3H5a1 1 0 0 1-.7-.3A1 1 0 0 1 4 12c0-.3.1-.5.3-.7.2-.2.4-.3.7-.3h1c.3 0 .5.1.7.3.2.2.3.4.3.7zm10 3.5l.7.8c.2.1.3.4.3.6 0 .3-.1.6-.3.8a1 1 0 0 1-.8.3 1 1 0 0 1-.6-.3l-.8-.7a1 1 0 0 1-.3-.8c0-.2.1-.5.3-.7a1 1 0 0 1 1.4 0zm-10-7l-.7-.8a1 1 0 0 1-.3-.6c0-.3.1-.6.3-.8.2-.2.5-.3.8-.3.2 0 .5.1.7.3l.7.7c.2.2.3.5.3.8 0 .2-.1.5-.3.7a1 1 0 0 1-.7.3 1 1 0 0 1-.8-.3zm10 0a1 1 0 0 1-.8.3 1 1 0 0 1-.7-.3 1 1 0 0 1-.3-.7c0-.3.1-.6.3-.8l.8-.7c.1-.2.4-.3.6-.3.3 0 .6.1.8.3.2.2.3.5.3.8 0 .2-.1.5-.3.7l-.7.7zm-10 7c.2-.2.5-.3.8-.3.2 0 .5.1.7.3a1 1 0 0 1 0 1.4l-.8.8a1 1 0 0 1-.6.3 1 1 0 0 1-.8-.3 1 1 0 0 1-.3-.8c0-.2.1-.5.3-.6l.7-.8zM12 8a4 4 0 0 1 3.7 2.4 4 4 0 0 1 0 3.2A4 4 0 0 1 12 16a4 4 0 0 1-3.7-2.4 4 4 0 0 1 0-3.2A4 4 0 0 1 12 8zm0 6.5c.7 0 1.3-.2 1.8-.7.5-.5.7-1.1.7-1.8s-.2-1.3-.7-1.8c-.5-.5-1.1-.7-1.8-.7s-1.3.2-1.8.7c-.5.5-.7 1.1-.7 1.8s.2 1.3.7 1.8c.5.5 1.1.7 1.8.7z" fill-rule="evenodd"/></svg>',
                        browse: '<svg width="24" height="24"><path d="M19 4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4v-2h4V8H5v10h4v2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h14zm-8 9.4l-2.3 2.3a1 1 0 1 1-1.4-1.4l4-4a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1-1.4 1.4L13 13.4V20a1 1 0 0 1-2 0v-6.6z" fill-rule="nonzero"/></svg>',
                        cancel: '<svg width="24" height="24"><path d="M12 4.6a7.4 7.4 0 1 1 0 14.8 7.4 7.4 0 0 1 0-14.8zM12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18zm0 8L14.8 8l1 1.1-2.7 2.8 2.7 2.7-1.1 1.1-2.7-2.7-2.7 2.7-1-1.1 2.6-2.7-2.7-2.7 1-1.1 2.8 2.7z" fill-rule="nonzero"/></svg>',
                        "change-case": '<svg width="24" height="24"><path d="M18.4 18.2v-.6c-.5.8-1.3 1.2-2.4 1.2-2.2 0-3.3-1.6-3.3-4.8 0-3.1 1-4.7 3.3-4.7 1.1 0 1.8.3 2.4 1.1v-.6c0-.5.4-.8.8-.8s.8.3.8.8v8.4c0 .5-.4.8-.8.8a.8.8 0 0 1-.8-.8zm-2-7.4c-1.3 0-1.8.9-1.8 3.2 0 2.4.5 3.3 1.7 3.3 1.3 0 1.8-.9 1.8-3.2 0-2.4-.5-3.3-1.7-3.3zM10 15.7H5.5l-.8 2.6a1 1 0 0 1-1 .7h-.2a.7.7 0 0 1-.7-1l4-12a1 1 0 1 1 2 0l4 12a.7.7 0 0 1-.8 1h-.2a1 1 0 0 1-1-.7l-.8-2.6zm-.3-1.5l-2-6.5-1.9 6.5h3.9z" fill-rule="evenodd"/></svg>',
                        "character-count": '<svg width="24" height="24"><path d="M4 11.5h16v1H4v-1zm4.8-6.8V10H7.7V5.8h-1v-1h2zM11 8.3V9h2v1h-3V7.7l2-1v-.9h-2v-1h3v2.4l-2 1zm6.3-3.4V10h-3.1V9h2.1V8h-2.1V6.8h2.1v-1h-2.1v-1h3.1zM5.8 16.4c0-.5.2-.8.5-1 .2-.2.6-.3 1.2-.3l.8.1c.2 0 .4.2.5.3l.4.4v2.8l.2.3H8.2v-.1-.2l-.6.3H7c-.4 0-.7 0-1-.2a1 1 0 0 1-.3-.9c0-.3 0-.6.3-.8.3-.2.7-.4 1.2-.4l.6-.2h.3v-.2l-.1-.2a.8.8 0 0 0-.5-.1 1 1 0 0 0-.4 0l-.3.4h-1zm2.3.8h-.2l-.2.1-.4.1a1 1 0 0 0-.4.2l-.2.2.1.3.5.1h.4l.4-.4v-.6zm2-3.4h1.2v1.7l.5-.3h.5c.5 0 .9.1 1.2.5.3.4.5.8.5 1.4 0 .6-.2 1.1-.5 1.5-.3.4-.7.6-1.3.6l-.6-.1-.4-.4v.4h-1.1v-5.4zm1.1 3.3c0 .3 0 .6.2.8a.7.7 0 0 0 1.2 0l.2-.8c0-.4 0-.6-.2-.8a.7.7 0 0 0-.6-.3l-.6.3-.2.8zm6.1-.5c0-.2 0-.3-.2-.4a.8.8 0 0 0-.5-.2c-.3 0-.5.1-.6.3l-.2.9c0 .3 0 .6.2.8.1.2.3.3.6.3.2 0 .4 0 .5-.2l.2-.4h1.1c0 .5-.3.8-.6 1.1a2 2 0 0 1-1.3.4c-.5 0-1-.2-1.3-.6a2 2 0 0 1-.5-1.4c0-.6.1-1.1.5-1.5.3-.4.8-.5 1.4-.5.5 0 1 0 1.2.3.4.3.5.7.5 1.2h-1v-.1z" fill-rule="evenodd"/></svg>',
                        "checklist-rtl": '<svg width="24" height="24"><path d="M5 17h8c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 0 1 0-2zm0-6h8c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 0 1 0-2zm0-6h8c.6 0 1 .4 1 1s-.4 1-1 1H5a1 1 0 1 1 0-2zm14.2 11c.2-.4.6-.5.9-.3.3.2.4.6.2 1L18 20c-.2.3-.7.4-1 0l-1.3-1.3a.7.7 0 0 1 0-1c.3-.2.7-.2 1 0l.7.9 1.7-2.8zm0-6c.2-.4.6-.5.9-.3.3.2.4.6.2 1L18 14c-.2.3-.7.4-1 0l-1.3-1.3a.7.7 0 0 1 0-1c.3-.2.7-.2 1 0l.7.9 1.7-2.8zm0-6c.2-.4.6-.5.9-.3.3.2.4.6.2 1L18 8c-.2.3-.7.4-1 0l-1.3-1.3a.7.7 0 0 1 0-1c.3-.2.7-.2 1 0l.7.9 1.7-2.8z" fill-rule="evenodd"/></svg>',
                        checklist: '<svg width="24" height="24"><path d="M11 17h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 0 1 0-2zm0-6h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 0 1 0-2zm0-6h8a1 1 0 0 1 0 2h-8a1 1 0 0 1 0-2zM7.2 16c.2-.4.6-.5.9-.3.3.2.4.6.2 1L6 20c-.2.3-.7.4-1 0l-1.3-1.3a.7.7 0 0 1 0-1c.3-.2.7-.2 1 0l.7.9 1.7-2.8zm0-6c.2-.4.6-.5.9-.3.3.2.4.6.2 1L6 14c-.2.3-.7.4-1 0l-1.3-1.3a.7.7 0 0 1 0-1c.3-.2.7-.2 1 0l.7.9 1.7-2.8zm0-6c.2-.4.6-.5.9-.3.3.2.4.6.2 1L6 8c-.2.3-.7.4-1 0L3.8 6.9a.7.7 0 0 1 0-1c.3-.2.7-.2 1 0l.7.9 1.7-2.8z" fill-rule="evenodd"/></svg>',
                        checkmark: '<svg width="24" height="24"><path d="M18.2 5.4a1 1 0 0 1 1.6 1.2l-8 12a1 1 0 0 1-1.5.1l-5-5a1 1 0 1 1 1.4-1.4l4.1 4.1 7.4-11z" fill-rule="nonzero"/></svg>',
                        "chevron-down": '<svg width="10" height="10"><path d="M8.7 2.2c.3-.3.8-.3 1 0 .4.4.4.9 0 1.2L5.7 7.8c-.3.3-.9.3-1.2 0L.2 3.4a.8.8 0 0 1 0-1.2c.3-.3.8-.3 1.1 0L5 6l3.7-3.8z" fill-rule="nonzero"/></svg>',
                        "chevron-left": '<svg width="10" height="10"><path d="M7.8 1.3L4 5l3.8 3.7c.3.3.3.8 0 1-.4.4-.9.4-1.2 0L2.2 5.7a.8.8 0 0 1 0-1.2L6.6.2C7 0 7.4 0 7.8.2c.3.3.3.8 0 1.1z" fill-rule="nonzero"/></svg>',
                        "chevron-right": '<svg width="10" height="10"><path d="M2.2 1.3a.8.8 0 0 1 0-1c.4-.4.9-.4 1.2 0l4.4 4.1c.3.4.3.9 0 1.2L3.4 9.8c-.3.3-.8.3-1.2 0a.8.8 0 0 1 0-1.1L6 5 2.2 1.3z" fill-rule="nonzero"/></svg>',
                        "chevron-up": '<svg width="10" height="10"><path d="M8.7 7.8L5 4 1.3 7.8c-.3.3-.8.3-1 0a.8.8 0 0 1 0-1.2l4.1-4.4c.3-.3.9-.3 1.2 0l4.2 4.4c.3.3.3.9 0 1.2-.3.3-.8.3-1.1 0z" fill-rule="nonzero"/></svg>',
                        close: '<svg width="24" height="24"><path d="M17.3 8.2L13.4 12l3.9 3.8a1 1 0 0 1-1.5 1.5L12 13.4l-3.8 3.9a1 1 0 0 1-1.5-1.5l3.9-3.8-3.9-3.8a1 1 0 0 1 1.5-1.5l3.8 3.9 3.8-3.9a1 1 0 0 1 1.5 1.5z" fill-rule="evenodd"/></svg>',
                        "code-sample": '<svg width="24" height="26"><path d="M7.1 11a2.8 2.8 0 0 1-.8 2 2.8 2.8 0 0 1 .8 2v1.7c0 .3.1.6.4.8.2.3.5.4.8.4.3 0 .4.2.4.4v.8c0 .2-.1.4-.4.4-.7 0-1.4-.3-2-.8-.5-.6-.8-1.3-.8-2V15c0-.3-.1-.6-.4-.8-.2-.3-.5-.4-.8-.4a.4.4 0 0 1-.4-.4v-.8c0-.2.2-.4.4-.4.3 0 .6-.1.8-.4.3-.2.4-.5.4-.8V9.3c0-.7.3-1.4.8-2 .6-.5 1.3-.8 2-.8.3 0 .4.2.4.4v.8c0 .2-.1.4-.4.4-.3 0-.6.1-.8.4-.3.2-.4.5-.4.8V11zm9.8 0V9.3c0-.3-.1-.6-.4-.8-.2-.3-.5-.4-.8-.4a.4.4 0 0 1-.4-.4V7c0-.2.1-.4.4-.4.7 0 1.4.3 2 .8.5.6.8 1.3.8 2V11c0 .3.1.6.4.8.2.3.5.4.8.4.2 0 .4.2.4.4v.8c0 .2-.2.4-.4.4-.3 0-.6.1-.8.4-.3.2-.4.5-.4.8v1.7c0 .7-.3 1.4-.8 2-.6.5-1.3.8-2 .8a.4.4 0 0 1-.4-.4v-.8c0-.2.1-.4.4-.4.3 0 .6-.1.8-.4.3-.2.4-.5.4-.8V15a2.8 2.8 0 0 1 .8-2 2.8 2.8 0 0 1-.8-2zm-3.3-.4c0 .4-.1.8-.5 1.1-.3.3-.7.5-1.1.5-.4 0-.8-.2-1.1-.5-.4-.3-.5-.7-.5-1.1 0-.5.1-.9.5-1.2.3-.3.7-.4 1.1-.4.4 0 .8.1 1.1.4.4.3.5.7.5 1.2zM12 13c.4 0 .8.1 1.1.5.4.3.5.7.5 1.1 0 1-.1 1.6-.5 2a3 3 0 0 1-1.1 1c-.4.3-.8.4-1.1.4a.5.5 0 0 1-.5-.5V17a3 3 0 0 0 1-.2l.6-.6c-.6 0-1-.2-1.3-.5-.2-.3-.3-.7-.3-1 0-.5.1-1 .5-1.2.3-.4.7-.5 1.1-.5z" fill-rule="evenodd"/></svg>',
                        "color-levels": '<svg width="24" height="24"><path d="M17.5 11.4A9 9 0 0 1 18 14c0 .5 0 1-.2 1.4 0 .4-.3.9-.5 1.3a6.2 6.2 0 0 1-3.7 3 5.7 5.7 0 0 1-3.2 0A5.9 5.9 0 0 1 7.6 18a6.2 6.2 0 0 1-1.4-2.6 6.7 6.7 0 0 1 0-2.8c0-.4.1-.9.3-1.3a13.6 13.6 0 0 1 2.3-4A20 20 0 0 1 12 4a26.4 26.4 0 0 1 3.2 3.4 18.2 18.2 0 0 1 2.3 4zm-2 4.5c.4-.7.5-1.4.5-2a7.3 7.3 0 0 0-1-3.2c.2.6.2 1.2.2 1.9a4.5 4.5 0 0 1-1.3 3 5.3 5.3 0 0 1-2.3 1.5 4.9 4.9 0 0 1-2 .1 4.3 4.3 0 0 0 2.4.8 4 4 0 0 0 2-.6 4 4 0 0 0 1.5-1.5z" fill-rule="evenodd"/></svg>',
                        "color-picker": '<svg width="24" height="24"><path d="M12 3a9 9 0 0 0 0 18 1.5 1.5 0 0 0 1.1-2.5c-.2-.3-.4-.6-.4-1 0-.8.7-1.5 1.5-1.5H16a5 5 0 0 0 5-5c0-4.4-4-8-9-8zm-5.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm3-4a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm3 4a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" fill-rule="nonzero"/></svg>',
                        "color-swatch-remove-color": '<svg width="24" height="24"><path stroke="#000" stroke-width="2" d="M21 3L3 21" fill-rule="evenodd"/></svg>',
                        "color-swatch": '<svg width="24" height="24"><rect x="3" y="3" width="18" height="18" rx="1" fill-rule="evenodd"/></svg>',
                        "comment-add": '<svg width="24" height="24"><g fill-rule="nonzero"><path d="M9 19l3-2h7c.6 0 1-.4 1-1V6c0-.6-.4-1-1-1H5a1 1 0 0 0-1 1v10c0 .6.4 1 1 1h4v2zm-2 4v-4H5a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-6.4L7 23z"/><path d="M13 10h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2H9a1 1 0 0 1 0-2h2V8a1 1 0 0 1 2 0v2z"/></g></svg>',
                        comment: '<svg width="24" height="24"><path fill-rule="nonzero" d="M9 19l3-2h7c.6 0 1-.4 1-1V6c0-.6-.4-1-1-1H5a1 1 0 0 0-1 1v10c0 .6.4 1 1 1h4v2zm-2 4v-4H5a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-6.4L7 23z"/></svg>',
                        contrast: '<svg width="24" height="24"><path d="M12 4a7.8 7.8 0 0 1 5.7 2.3A8 8 0 1 1 12 4zm-6 8a6 6 0 0 0 6 6V6a6 6 0 0 0-6 6z" fill-rule="evenodd"/></svg>',
                        copy: '<svg width="24" height="24"><path d="M16 3H6a2 2 0 0 0-2 2v11h2V5h10V3zm1 4a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9c0-1.2.9-2 2-2h7zm0 12V9h-7v10h7z" fill-rule="nonzero"/></svg>',
                        crop: '<svg width="24" height="24"><path d="M17 8v7h2c.6 0 1 .4 1 1s-.4 1-1 1h-2v2c0 .6-.4 1-1 1a1 1 0 0 1-1-1v-2H7V9H5a1 1 0 1 1 0-2h2V5c0-.6.4-1 1-1s1 .4 1 1v2h7l3-3 1 1-3 3zM9 9v5l5-5H9zm1 6h5v-5l-5 5z" fill-rule="evenodd"/></svg>',
                        cut: '<svg width="24" height="24"><path d="M18 15c.6.7 1 1.4 1 2.3 0 .8-.2 1.5-.7 2l-.8.5-1 .2c-.4 0-.8 0-1.2-.3a3.9 3.9 0 0 1-2.1-2.2c-.2-.5-.3-1-.2-1.5l-1-1-1 1c0 .5 0 1-.2 1.5-.1.5-.4 1-.9 1.4-.3.4-.7.6-1.2.8l-1.2.3c-.4 0-.7 0-1-.2-.3 0-.6-.3-.8-.5-.5-.5-.8-1.2-.7-2 0-.9.4-1.6 1-2.2A3.7 3.7 0 0 1 8.6 14H9l1-1-4-4-.5-1a3.3 3.3 0 0 1 0-2c0-.4.3-.7.5-1l6 6 6-6 .5 1a3.3 3.3 0 0 1 0 2c0 .4-.3.7-.5 1l-4 4 1 1h.5c.4 0 .8 0 1.2.3.5.2.9.4 1.2.8zm-8.5 2.2l.1-.4v-.3-.4a1 1 0 0 0-.2-.5 1 1 0 0 0-.4-.2 1.6 1.6 0 0 0-.8 0 2.6 2.6 0 0 0-.8.3 2.5 2.5 0 0 0-.9 1.1l-.1.4v.7l.2.5.5.2h.7a2.5 2.5 0 0 0 .8-.3 2.8 2.8 0 0 0 1-1zm2.5-2.8c.4 0 .7-.1 1-.4.3-.3.4-.6.4-1s-.1-.7-.4-1c-.3-.3-.6-.4-1-.4s-.7.1-1 .4c-.3.3-.4.6-.4 1s.1.7.4 1c.3.3.6.4 1 .4zm5.4 4l.2-.5v-.4-.3a2.6 2.6 0 0 0-.3-.8 2.4 2.4 0 0 0-.7-.7 2.5 2.5 0 0 0-.8-.3 1.5 1.5 0 0 0-.8 0 1 1 0 0 0-.4.2 1 1 0 0 0-.2.5 1.5 1.5 0 0 0 0 .7v.4l.3.4.3.4a2.8 2.8 0 0 0 .8.5l.4.1h.7l.5-.2z" fill-rule="evenodd"/></svg>',
                        "document-properties": '<svg width="24" height="24"><path d="M14.4 3H7a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h10a2 2 0 0 0 2-2V7.6L14.4 3zM17 19H7V5h6v4h4v10z" fill-rule="nonzero"/></svg>',
                        drag: '<svg width="24" height="24"><path d="M13 5h2v2h-2V5zm0 4h2v2h-2V9zM9 9h2v2H9V9zm4 4h2v2h-2v-2zm-4 0h2v2H9v-2zm0 4h2v2H9v-2zm4 0h2v2h-2v-2zM9 5h2v2H9V5z" fill-rule="evenodd"/></svg>',
                        duplicate: '<svg width="24" height="24"><g fill-rule="nonzero"><path d="M16 3v2H6v11H4V5c0-1.1.9-2 2-2h10zm3 8h-2V9h-7v10h9a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9c0-1.2.9-2 2-2h7a2 2 0 0 1 2 2v2z"/><path d="M17 14h1a1 1 0 0 1 0 2h-1v1a1 1 0 0 1-2 0v-1h-1a1 1 0 0 1 0-2h1v-1a1 1 0 0 1 2 0v1z"/></g></svg>',
                        "edit-block": '<svg width="24" height="24"><path fill-rule="nonzero" d="M19.8 8.8l-9.4 9.4c-.2.2-.5.4-.9.4l-5.4 1.2 1.2-5.4.5-.8 9.4-9.4c.7-.7 1.8-.7 2.5 0l2.1 2.1c.7.7.7 1.8 0 2.5zm-2-.2l1-.9v-.3l-2.2-2.2a.3.3 0 0 0-.3 0l-1 1L18 8.5zm-1 1l-2.5-2.4-6 6 2.5 2.5 6-6zm-7 7.1l-2.6-2.4-.3.3-.1.2-.7 3 3.1-.6h.1l.4-.5z"/></svg>',
                        "edit-image": '<svg width="24" height="24"><path d="M18 16h2V7a2 2 0 0 0-2-2H7v2h11v9zM6 17h15a1 1 0 0 1 0 2h-1v1a1 1 0 0 1-2 0v-1H6a2 2 0 0 1-2-2V7H3a1 1 0 1 1 0-2h1V4a1 1 0 1 1 2 0v13zm3-5.3l1.3 2 3-4.7 3.7 6H7l2-3.3z" fill-rule="nonzero"/></svg>',
                        "embed-page": '<svg width="24" height="24"><path d="M19 6V5H5v14h2A13 13 0 0 1 19 6zm0 1.4c-.8.8-1.6 2.4-2.2 4.6H19V7.4zm0 5.6h-2.4c-.4 1.8-.6 3.8-.6 6h3v-6zm-4 6c0-2.2.2-4.2.6-6H13c-.7 1.8-1.1 3.8-1.1 6h3zm-4 0c0-2.2.4-4.2 1-6H9.6A12 12 0 0 0 8 19h3zM4 3h16c.6 0 1 .4 1 1v16c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1V4c0-.6.4-1 1-1zm11.8 9c.4-1.9 1-3.4 1.8-4.5a9.2 9.2 0 0 0-4 4.5h2.2zm-3.4 0a12 12 0 0 1 2.8-4 12 12 0 0 0-5 4h2.2z" fill-rule="nonzero"/></svg>',
                        embed: '<svg width="24" height="24"><path d="M4 3h16c.6 0 1 .4 1 1v16c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1V4c0-.6.4-1 1-1zm1 2v14h14V5H5zm4.8 2.6l5.6 4a.5.5 0 0 1 0 .8l-5.6 4A.5.5 0 0 1 9 16V8a.5.5 0 0 1 .8-.4z" fill-rule="nonzero"/></svg>',
                        emoji: '<svg width="24" height="24"><path d="M9 11c.6 0 1-.4 1-1s-.4-1-1-1a1 1 0 0 0-1 1c0 .6.4 1 1 1zm6 0c.6 0 1-.4 1-1s-.4-1-1-1a1 1 0 0 0-1 1c0 .6.4 1 1 1zm-3 5.5c2.1 0 4-1.5 4.4-3.5H7.6c.5 2 2.3 3.5 4.4 3.5zM12 4a8 8 0 1 0 0 16 8 8 0 0 0 0-16zm0 14.5a6.5 6.5 0 1 1 0-13 6.5 6.5 0 0 1 0 13z" fill-rule="nonzero"/></svg>',
                        fill: '<svg width="24" height="26"><path d="M16.6 12l-9-9-1.4 1.4 2.4 2.4-5.2 5.1c-.5.6-.5 1.6 0 2.2L9 19.6a1.5 1.5 0 0 0 2.2 0l5.5-5.5c.5-.6.5-1.6 0-2.2zM5.2 13L10 8.2l4.8 4.8H5.2zM19 14.5s-2 2.2-2 3.5c0 1.1.9 2 2 2a2 2 0 0 0 2-2c0-1.3-2-3.5-2-3.5z" fill-rule="nonzero"/></svg>',
                        "flip-horizontally": '<svg width="24" height="24"><path d="M14 19h2v-2h-2v2zm4-8h2V9h-2v2zM4 7v10c0 1.1.9 2 2 2h3v-2H6V7h3V5H6a2 2 0 0 0-2 2zm14-2v2h2a2 2 0 0 0-2-2zm-7 16h2V3h-2v18zm7-6h2v-2h-2v2zm-4-8h2V5h-2v2zm4 12a2 2 0 0 0 2-2h-2v2z" fill-rule="nonzero"/></svg>',
                        "flip-vertically": '<svg width="24" height="24"><path d="M5 14v2h2v-2H5zm8 4v2h2v-2h-2zm4-14H7a2 2 0 0 0-2 2v3h2V6h10v3h2V6a2 2 0 0 0-2-2zm2 14h-2v2a2 2 0 0 0 2-2zM3 11v2h18v-2H3zm6 7v2h2v-2H9zm8-4v2h2v-2h-2zM5 18c0 1.1.9 2 2 2v-2H5z" fill-rule="nonzero"/></svg>',
                        "format-painter": '<svg width="24" height="24"><path d="M18 5V4c0-.5-.4-1-1-1H5a1 1 0 0 0-1 1v4c0 .6.5 1 1 1h12c.6 0 1-.4 1-1V7h1v4H9v9c0 .6.4 1 1 1h2c.6 0 1-.4 1-1v-7h8V5h-3z" fill-rule="nonzero"/></svg>',
                        format: '<svg width="24" height="24"><path fill-rule="evenodd" d="M17 5a1 1 0 0 1 0 2h-4v11a1 1 0 0 1-2 0V7H7a1 1 0 1 1 0-2h10z"/></svg>',
                        fullscreen: '<svg width="24" height="24"><path d="M15.3 10l-1.2-1.3 2.9-3h-2.3a.9.9 0 1 1 0-1.7H19c.5 0 .9.4.9.9v4.4a.9.9 0 1 1-1.8 0V7l-2.9 3zm0 4l3 3v-2.3a.9.9 0 1 1 1.7 0V19c0 .5-.4.9-.9.9h-4.4a.9.9 0 1 1 0-1.8H17l-3-2.9 1.3-1.2zM10 15.4l-2.9 3h2.3a.9.9 0 1 1 0 1.7H5a.9.9 0 0 1-.9-.9v-4.4a.9.9 0 1 1 1.8 0V17l2.9-3 1.2 1.3zM8.7 10L5.7 7v2.3a.9.9 0 0 1-1.7 0V5c0-.5.4-.9.9-.9h4.4a.9.9 0 0 1 0 1.8H7l3 2.9-1.3 1.2z" fill-rule="nonzero"/></svg>',
                        gallery: '<svg width="24" height="24"><path fill-rule="nonzero" d="M5 15.7l2.3-2.2c.3-.3.7-.3 1 0L11 16l5.1-5c.3-.4.8-.4 1 0l2 1.9V8H5v7.7zM5 18V19h3l1.8-1.9-2-2L5 17.9zm14-3l-2.5-2.4-6.4 6.5H19v-4zM4 6h16c.6 0 1 .4 1 1v13c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1V7c0-.6.4-1 1-1zm6 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4zM4.5 4h15a.5.5 0 1 1 0 1h-15a.5.5 0 0 1 0-1zm2-2h11a.5.5 0 1 1 0 1h-11a.5.5 0 0 1 0-1z"/></svg>',
                        gamma: '<svg width="24" height="24"><path d="M4 3h16c.6 0 1 .4 1 1v16c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1V4c0-.6.4-1 1-1zm1 2v14h14V5H5zm6.5 11.8V14L9.2 8.7a5.1 5.1 0 0 0-.4-.8l-.1-.2H8 8v-1l.3-.1.3-.1h.7a1 1 0 0 1 .6.5l.1.3a8.5 8.5 0 0 1 .3.6l1.9 4.6 2-5.2a1 1 0 0 1 1-.6.5.5 0 0 1 .5.6L13 14v2.8a.7.7 0 0 1-1.4 0z" fill-rule="nonzero"/></svg>',
                        help: '<svg width="24" height="24"><g fill-rule="evenodd"><path d="M12 5.5a6.5 6.5 0 0 0-6 9 6.3 6.3 0 0 0 1.4 2l1 1a6.3 6.3 0 0 0 3.6 1 6.5 6.5 0 0 0 6-9 6.3 6.3 0 0 0-1.4-2l-1-1a6.3 6.3 0 0 0-3.6-1zM12 4a7.8 7.8 0 0 1 5.7 2.3A8 8 0 1 1 12 4z"/><path d="M9.6 9.7a.7.7 0 0 1-.7-.8c0-1.1 1.5-1.8 3.2-1.8 1.8 0 3.2.8 3.2 2.4 0 1.4-.4 2.1-1.5 2.8-.2 0-.3.1-.3.2a2 2 0 0 0-.8.8.8.8 0 0 1-1.4-.6c.3-.7.8-1 1.3-1.5l.4-.2c.7-.4.8-.6.8-1.5 0-.5-.6-.9-1.7-.9-.5 0-1 .1-1.4.3-.2 0-.3.1-.3.2v-.2c0 .4-.4.8-.8.8z" fill-rule="nonzero"/><circle cx="12" cy="16" r="1"/></g></svg>',
                        "highlight-bg-color": '<svg width="24" height="24"><g fill-rule="evenodd"><path id="tox-icon-highlight-bg-color__color" d="M3 18h18v3H3z"/><path fill-rule="nonzero" d="M7.7 16.7H3l3.3-3.3-.7-.8L10.2 8l4 4.1-4 4.2c-.2.2-.6.2-.8 0l-.6-.7-1.1 1.1zm5-7.5L11 7.4l3-2.9a2 2 0 0 1 2.6 0L18 6c.7.7.7 2 0 2.7l-2.9 2.9-1.8-1.8-.5-.6"/></g></svg>',
                        home: '<svg width="24" height="24"><path fill-rule="nonzero" d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>',
                        "horizontal-rule": '<svg width="24" height="24"><path d="M4 11h16v2H4z" fill-rule="evenodd"/></svg>',
                        "image-options": '<svg width="24" height="24"><path d="M6 10a2 2 0 0 0-2 2c0 1.1.9 2 2 2a2 2 0 0 0 2-2 2 2 0 0 0-2-2zm12 0a2 2 0 0 0-2 2c0 1.1.9 2 2 2a2 2 0 0 0 2-2 2 2 0 0 0-2-2zm-6 0a2 2 0 0 0-2 2c0 1.1.9 2 2 2a2 2 0 0 0 2-2 2 2 0 0 0-2-2z" fill-rule="nonzero"/></svg>',
                        image: '<svg width="24" height="24"><path d="M5 15.7l3.3-3.2c.3-.3.7-.3 1 0L12 15l4.1-4c.3-.4.8-.4 1 0l2 1.9V5H5v10.7zM5 18V19h3l2.8-2.9-2-2L5 17.9zm14-3l-2.5-2.4-6.4 6.5H19v-4zM4 3h16c.6 0 1 .4 1 1v16c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1V4c0-.6.4-1 1-1zm6 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" fill-rule="nonzero"/></svg>',
                        indent: '<svg width="24" height="24"><path d="M7 5h12c.6 0 1 .4 1 1s-.4 1-1 1H7a1 1 0 1 1 0-2zm5 4h7c.6 0 1 .4 1 1s-.4 1-1 1h-7a1 1 0 0 1 0-2zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1h-7a1 1 0 0 1 0-2zm-5 4h12a1 1 0 0 1 0 2H7a1 1 0 0 1 0-2zm-2.6-3.8L6.2 12l-1.8-1.2a1 1 0 0 1 1.2-1.6l3 2a1 1 0 0 1 0 1.6l-3 2a1 1 0 1 1-1.2-1.6z" fill-rule="evenodd"/></svg>',
                        info: '<svg width="24" height="24"><path d="M12 4a7.8 7.8 0 0 1 5.7 2.3A8 8 0 1 1 12 4zm-1 3v2h2V7h-2zm3 10v-1h-1v-5h-3v1h1v4h-1v1h4z" fill-rule="evenodd"/></svg>',
                        "insert-character": '<svg width="24" height="24"><path d="M15 18h4l1-2v4h-6v-3.3l1.4-1a6 6 0 0 0 1.8-2.9 6.3 6.3 0 0 0-.1-4.1 5.8 5.8 0 0 0-3-3.2c-.6-.3-1.3-.5-2.1-.5a5.1 5.1 0 0 0-3.9 1.8 6.3 6.3 0 0 0-1.3 6 6.2 6.2 0 0 0 1.8 3l1.4.9V20H4v-4l1 2h4v-.5l-2-1L5.4 15A6.5 6.5 0 0 1 4 11c0-1 .2-1.9.6-2.7A7 7 0 0 1 6.3 6C7.1 5.4 8 5 9 4.5c1-.3 2-.5 3.1-.5a8.8 8.8 0 0 1 5.7 2 7 7 0 0 1 1.7 2.3 6 6 0 0 1 .2 4.8c-.2.7-.6 1.3-1 1.9a7.6 7.6 0 0 1-3.6 2.5v.5z" fill-rule="evenodd"/></svg>',
                        "insert-time": '<svg width="24" height="24"><g fill-rule="nonzero"><path d="M12 19a7 7 0 1 0 0-14 7 7 0 0 0 0 14zm0 2a9 9 0 1 1 0-18 9 9 0 0 1 0 18z"/><path d="M16 12h-3V7c0-.6-.4-1-1-1a1 1 0 0 0-1 1v7h5c.6 0 1-.4 1-1s-.4-1-1-1z"/></g></svg>',
                        invert: '<svg width="24" height="24"><path d="M18 19.3L16.5 18a5.8 5.8 0 0 1-3.1 1.9 6.1 6.1 0 0 1-5.5-1.6A5.8 5.8 0 0 1 6 14v-.3l.1-1.2A13.9 13.9 0 0 1 7.7 9l-3-3 .7-.8 2.8 2.9 9 8.9 1.5 1.6-.7.6zm0-5.5v.3l-.1 1.1-.4 1-1.2-1.2a4.3 4.3 0 0 0 .2-1v-.2c0-.4 0-.8-.2-1.3l-.5-1.4a14.8 14.8 0 0 0-3-4.2L12 6a26.1 26.1 0 0 0-2.2 2.5l-1-1a20.9 20.9 0 0 1 2.9-3.3L12 4l1 .8a22.2 22.2 0 0 1 4 5.4c.6 1.2 1 2.4 1 3.6z" fill-rule="evenodd"/></svg>',
                        italic: '<svg width="24" height="24"><path d="M16.7 4.7l-.1.9h-.3c-.6 0-1 0-1.4.3-.3.3-.4.6-.5 1.1l-2.1 9.8v.6c0 .5.4.8 1.4.8h.2l-.2.8H8l.2-.8h.2c1.1 0 1.8-.5 2-1.5l2-9.8.1-.5c0-.6-.4-.8-1.4-.8h-.3l.2-.9h5.8z" fill-rule="evenodd"/></svg>',
                        line: '<svg width="24" height="24"><path d="M15 9l-8 8H4v-3l8-8 3 3zm1-1l-3-3 1-1h1c-.2 0 0 0 0 0l2 2s0 .2 0 0v1l-1 1zM4 18h16v2H4v-2z" fill-rule="evenodd"/></svg>',
                        link: '<svg width="24" height="24"><path d="M6.2 12.3a1 1 0 0 1 1.4 1.4l-2.1 2a2 2 0 1 0 2.7 2.8l4.8-4.8a1 1 0 0 0 0-1.4 1 1 0 1 1 1.4-1.3 2.9 2.9 0 0 1 0 4L9.6 20a3.9 3.9 0 0 1-5.5-5.5l2-2zm11.6-.6a1 1 0 0 1-1.4-1.4l2-2a2 2 0 1 0-2.6-2.8L11 10.3a1 1 0 0 0 0 1.4A1 1 0 1 1 9.6 13a2.9 2.9 0 0 1 0-4L14.4 4a3.9 3.9 0 0 1 5.5 5.5l-2 2z" fill-rule="nonzero"/></svg>',
                        "list-bull-circle": '<svg width="48" height="48"><g fill-rule="evenodd"><path d="M11 16a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 1 0-6 3 3 0 0 1 0 6zM11 26a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 1 0-6 3 3 0 0 1 0 6zM11 36a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" fill-rule="nonzero"/><path opacity=".2" d="M18 12h22v4H18zM18 22h22v4H18zM18 32h22v4H18z"/></g></svg>',
                        "list-bull-default": '<svg width="48" height="48"><g fill-rule="evenodd"><circle cx="11" cy="14" r="3"/><circle cx="11" cy="24" r="3"/><circle cx="11" cy="34" r="3"/><path opacity=".2" d="M18 12h22v4H18zM18 22h22v4H18zM18 32h22v4H18z"/></g></svg>',
                        "list-bull-square": '<svg width="48" height="48"><g fill-rule="evenodd"><path d="M8 11h6v6H8zM8 21h6v6H8zM8 31h6v6H8z"/><path opacity=".2" d="M18 12h22v4H18zM18 22h22v4H18zM18 32h22v4H18z"/></g></svg>',
                        "list-num-default-rtl": '<svg width="48" height="48"><g fill-rule="evenodd"><path opacity=".2" d="M8 12h22v4H8zM8 22h22v4H8zM8 32h22v4H8z"/><path d="M37.4 17v-4.8l-1.6 1v-1.1l1.6-1h1.2V17zM33.3 17.1c-.5 0-.8-.3-.8-.7 0-.4.3-.7.8-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7zm1.7 5.7c0-1.2 1-2 2.2-2 1.3 0 2.1.8 2.1 1.8 0 .7-.3 1.2-1.3 2.2l-1.2 1v.2h2.6v1h-4.3v-.9l2-1.9c.8-.8 1-1.1 1-1.5 0-.5-.4-.8-1-.8-.5 0-.9.3-.9.9H35zm-1.7 4.3c-.5 0-.8-.3-.8-.7 0-.4.3-.7.8-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7zm3.2 7.3v-1h.7c.6 0 1-.3 1-.8 0-.4-.4-.7-1-.7s-1 .3-1 .8H35c0-1.1 1-1.8 2.2-1.8 1.2 0 2.1.6 2.1 1.6 0 .7-.4 1.2-1 1.3v.1c.7.1 1.3.7 1.3 1.4 0 1-1 1.9-2.4 1.9-1.3 0-2.2-.8-2.3-2h1.2c0 .6.5 1 1.1 1 .6 0 1-.4 1-1 0-.5-.3-.8-1-.8h-.7zm-3.3 2.7c-.4 0-.7-.3-.7-.7 0-.4.3-.7.7-.7.5 0 .8.3.8.7 0 .4-.3.7-.8.7z"/></g></svg>',
                        "list-num-default": '<svg width="48" height="48"><g fill-rule="evenodd"><path opacity=".2" d="M18 12h22v4H18zM18 22h22v4H18zM18 32h22v4H18z"/><path d="M10 17v-4.8l-1.5 1v-1.1l1.6-1h1.2V17h-1.2zm3.6.1c-.4 0-.7-.3-.7-.7 0-.4.3-.7.7-.7.5 0 .7.3.7.7 0 .4-.2.7-.7.7zm-5 5.7c0-1.2.8-2 2.1-2s2.1.8 2.1 1.8c0 .7-.3 1.2-1.4 2.2l-1.1 1v.2h2.6v1H8.6v-.9l2-1.9c.8-.8 1-1.1 1-1.5 0-.5-.4-.8-1-.8-.5 0-.9.3-.9.9H8.5zm6.3 4.3c-.5 0-.7-.3-.7-.7 0-.4.2-.7.7-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7zM10 34.4v-1h.7c.6 0 1-.3 1-.8 0-.4-.4-.7-1-.7s-1 .3-1 .8H8.6c0-1.1 1-1.8 2.2-1.8 1.3 0 2.1.6 2.1 1.6 0 .7-.4 1.2-1 1.3v.1c.8.1 1.3.7 1.3 1.4 0 1-1 1.9-2.4 1.9-1.3 0-2.2-.8-2.3-2h1.2c0 .6.5 1 1.1 1 .7 0 1-.4 1-1 0-.5-.3-.8-1-.8h-.7zm4.7 2.7c-.4 0-.7-.3-.7-.7 0-.4.3-.7.7-.7.5 0 .8.3.8.7 0 .4-.3.7-.8.7z"/></g></svg>',
                        "list-num-lower-alpha-rtl": '<svg width="48" height="48"><g fill-rule="evenodd"><path opacity=".2" d="M8 12h22v4H8zM8 22h22v4H8zM8 32h22v4H8z"/><path d="M36.5 16c-.9 0-1.5-.5-1.5-1.3s.6-1.3 1.8-1.4h1v-.4c0-.4-.2-.6-.7-.6-.4 0-.7.1-.8.4h-1.1c0-.8.8-1.4 2-1.4S39 12 39 13V16h-1.2v-.6c-.3.4-.8.7-1.4.7zm.4-.8c.6 0 1-.4 1-.9V14h-1c-.5.1-.7.3-.7.6 0 .4.3.6.7.6zM33.1 16.1c-.4 0-.7-.3-.7-.7 0-.4.3-.7.7-.7.5 0 .8.3.8.7 0 .4-.3.7-.8.7zM37.7 26c-.7 0-1.2-.2-1.5-.7v.7H35v-6.3h1.2v2.5c.3-.5.8-.9 1.5-.9 1.1 0 1.8 1 1.8 2.4 0 1.5-.7 2.4-1.8 2.4zm-.5-3.6c-.6 0-1 .5-1 1.3s.4 1.4 1 1.4c.7 0 1-.6 1-1.4 0-.8-.3-1.3-1-1.3zM33.2 26.1c-.4 0-.7-.3-.7-.7 0-.4.3-.7.7-.7.5 0 .8.3.8.7 0 .4-.3.7-.8.7zm6 7h-1c-.1-.5-.4-.8-1-.8s-1 .5-1 1.4c0 1 .4 1.4 1 1.4.5 0 .9-.2 1-.7h1c0 1-.8 1.7-2 1.7-1.4 0-2.2-.9-2.2-2.4s.8-2.4 2.2-2.4c1.2 0 2 .7 2 1.7zm-6.1 3c-.5 0-.7-.3-.7-.7 0-.4.2-.7.7-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7z"/></g></svg>',
                        "list-num-lower-alpha": '<svg width="48" height="48"><g fill-rule="evenodd"><path opacity=".2" d="M18 12h22v4H18zM18 22h22v4H18zM18 32h22v4H18z"/><path d="M10.3 15.2c.5 0 1-.4 1-.9V14h-1c-.5.1-.8.3-.8.6 0 .4.3.6.8.6zm-.4.9c-1 0-1.5-.6-1.5-1.4 0-.8.6-1.3 1.7-1.4h1.1v-.4c0-.4-.2-.6-.7-.6-.5 0-.8.1-.9.4h-1c0-.8.8-1.4 2-1.4 1.1 0 1.8.6 1.8 1.6V16h-1.1v-.6h-.1c-.2.4-.7.7-1.3.7zm4.6 0c-.5 0-.7-.3-.7-.7 0-.4.2-.7.7-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7zm-3.2 10c-.6 0-1.2-.3-1.4-.8v.7H8.5v-6.3H10v2.5c.3-.5.8-.9 1.4-.9 1.2 0 1.9 1 1.9 2.4 0 1.5-.7 2.4-1.9 2.4zm-.4-3.7c-.7 0-1 .5-1 1.3s.3 1.4 1 1.4c.6 0 1-.6 1-1.4 0-.8-.4-1.3-1-1.3zm4 3.7c-.5 0-.7-.3-.7-.7 0-.4.2-.7.7-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7zm-2.2 7h-1.2c0-.5-.4-.8-.9-.8-.6 0-1 .5-1 1.4 0 1 .4 1.4 1 1.4.5 0 .8-.2 1-.7h1c0 1-.8 1.7-2 1.7-1.4 0-2.2-.9-2.2-2.4s.8-2.4 2.2-2.4c1.2 0 2 .7 2 1.7zm1.8 3c-.5 0-.8-.3-.8-.7 0-.4.3-.7.8-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7z"/></g></svg>',
                        "list-num-lower-greek-rtl": '<svg width="48" height="48"><g fill-rule="evenodd"><path opacity=".2" d="M8 12h22v4H8zM8 22h22v4H8zM8 32h22v4H8z"/><path d="M37.4 16c-1.2 0-2-.8-2-2.3 0-1.5.8-2.4 2-2.4.6 0 1 .4 1.3 1v-.9H40v3.2c0 .4.1.5.4.5h.2v.9h-.6c-.6 0-1-.2-1-.7h-.2c-.2.4-.7.8-1.3.8zm.3-1c.6 0 1-.5 1-1.3s-.4-1.3-1-1.3-1 .5-1 1.3.4 1.4 1 1.4zM33.3 16.1c-.5 0-.8-.3-.8-.7 0-.4.3-.7.8-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7zM36 21.9c0-1.5.8-2.3 2.1-2.3 1.2 0 2 .6 2 1.6 0 .6-.3 1-.9 1.3.9.3 1.3.8 1.3 1.7 0 1.2-.7 1.9-1.8 1.9-.6 0-1.1-.3-1.4-.8v2.2H36V22zm1.8 1.2v-1h.3c.5 0 .9-.2.9-.7 0-.5-.3-.8-.9-.8-.5 0-.8.3-.8 1v2.2c0 .8.4 1.3 1 1.3s1-.4 1-1-.4-1-1.2-1h-.3zM33.3 26.1c-.5 0-.8-.3-.8-.7 0-.4.3-.7.8-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7zM37.1 34.6L34.8 30h1.4l1.7 3.5 1.7-3.5h1.1l-2.2 4.6v.1c.5.8.7 1.4.7 1.8 0 .4-.2.8-.4 1-.2.2-.6.3-1 .3-.9 0-1.3-.4-1.3-1.2 0-.5.2-1 .5-1.7l.1-.2zm.7 1a2 2 0 0 0-.4.9c0 .3.1.4.4.4.3 0 .4-.1.4-.4 0-.2-.1-.6-.4-1zM33.3 36.1c-.5 0-.8-.3-.8-.7 0-.4.3-.7.8-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7z"/></g></svg>',
                        "list-num-lower-greek": '<svg width="48" height="48"><g fill-rule="evenodd"><path opacity=".2" d="M18 12h22v4H18zM18 22h22v4H18zM18 32h22v4H18z"/><path d="M10.5 15c.7 0 1-.5 1-1.3s-.3-1.3-1-1.3c-.5 0-.9.5-.9 1.3s.4 1.4 1 1.4zm-.3 1c-1.1 0-1.8-.8-1.8-2.3 0-1.5.7-2.4 1.8-2.4.7 0 1.1.4 1.3 1h.1v-.9h1.2v3.2c0 .4.1.5.4.5h.2v.9h-.6c-.6 0-1-.2-1.1-.7h-.1c-.2.4-.7.8-1.4.8zm5 .1c-.5 0-.8-.3-.8-.7 0-.4.3-.7.7-.7.5 0 .8.3.8.7 0 .4-.3.7-.8.7zm-4.9 7v-1h.3c.6 0 1-.2 1-.7 0-.5-.4-.8-1-.8-.5 0-.8.3-.8 1v2.2c0 .8.4 1.3 1.1 1.3.6 0 1-.4 1-1s-.5-1-1.3-1h-.3zM8.6 22c0-1.5.7-2.3 2-2.3 1.2 0 2 .6 2 1.6 0 .6-.3 1-.8 1.3.8.3 1.3.8 1.3 1.7 0 1.2-.8 1.9-1.9 1.9-.6 0-1.1-.3-1.3-.8v2.2H8.5V22zm6.2 4.2c-.4 0-.7-.3-.7-.7 0-.4.3-.7.7-.7.5 0 .7.3.7.7 0 .4-.2.7-.7.7zm-4.5 8.5L8 30h1.4l1.7 3.5 1.7-3.5h1.1l-2.2 4.6v.1c.5.8.7 1.4.7 1.8 0 .4-.1.8-.4 1-.2.2-.6.3-1 .3-.9 0-1.3-.4-1.3-1.2 0-.5.2-1 .5-1.7l.1-.2zm.7 1a2 2 0 0 0-.4.9c0 .3.1.4.4.4.3 0 .4-.1.4-.4 0-.2-.1-.6-.4-1zm4.5.5c-.5 0-.8-.3-.8-.7 0-.4.3-.7.8-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7z"/></g></svg>',
                        "list-num-lower-roman-rtl": '<svg width="48" height="48"><g fill-rule="evenodd"><path opacity=".2" d="M8 12h22v4H8zM8 22h22v4H8zM8 32h22v4H8z"/><path d="M32.9 16v-1.2h-1.3V16H33zm0 10v-1.2h-1.3V26H33zm0 10v-1.2h-1.3V36H33z"/><path fill-rule="nonzero" d="M36 21h-1.5v5H36zM36 31h-1.5v5H36zM39 21h-1.5v5H39zM39 31h-1.5v5H39zM42 31h-1.5v5H42zM36 11h-1.5v5H36zM36 19h-1.5v1H36zM36 29h-1.5v1H36zM39 19h-1.5v1H39zM39 29h-1.5v1H39zM42 29h-1.5v1H42zM36 9h-1.5v1H36z"/></g></svg>',
                        "list-num-lower-roman": '<svg width="48" height="48"><g fill-rule="evenodd"><path opacity=".2" d="M18 12h22v4H18zM18 22h22v4H18zM18 32h22v4H18z"/><path d="M15.1 16v-1.2h1.3V16H15zm0 10v-1.2h1.3V26H15zm0 10v-1.2h1.3V36H15z"/><path fill-rule="nonzero" d="M12 21h1.5v5H12zM12 31h1.5v5H12zM9 21h1.5v5H9zM9 31h1.5v5H9zM6 31h1.5v5H6zM12 11h1.5v5H12zM12 19h1.5v1H12zM12 29h1.5v1H12zM9 19h1.5v1H9zM9 29h1.5v1H9zM6 29h1.5v1H6zM12 9h1.5v1H12z"/></g></svg>',
                        "list-num-upper-alpha-rtl": '<svg width="48" height="48"><g fill-rule="evenodd"><path opacity=".2" d="M8 12h22v4H8zM8 22h22v4H8zM8 32h22v4H8z"/><path d="M39.3 17l-.5-1.4h-2l-.5 1.4H35l2-6h1.6l2 6h-1.3zm-1.6-4.7l-.7 2.3h1.6l-.8-2.3zM33.4 17c-.4 0-.7-.3-.7-.7 0-.4.3-.7.7-.7.5 0 .7.3.7.7 0 .4-.2.7-.7.7zm4.7 9.9h-2.7v-6H38c1.2 0 1.9.6 1.9 1.5 0 .6-.5 1.2-1 1.3.7.1 1.3.7 1.3 1.5 0 1-.8 1.7-2 1.7zm-1.4-5v1.5h1c.6 0 1-.3 1-.8 0-.4-.4-.7-1-.7h-1zm0 4h1.1c.7 0 1.1-.3 1.1-.8 0-.6-.4-.9-1.1-.9h-1.1V26zM33 27.1c-.5 0-.8-.3-.8-.7 0-.4.3-.7.8-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7zm4.9 10c-1.8 0-2.8-1.1-2.8-3.1s1-3.1 2.8-3.1c1.4 0 2.5.9 2.6 2.2h-1.3c0-.7-.6-1.1-1.3-1.1-1 0-1.6.7-1.6 2s.6 2 1.6 2c.7 0 1.2-.4 1.4-1h1.2c-.1 1.3-1.2 2.2-2.6 2.2zm-4.5 0c-.5 0-.8-.3-.8-.7 0-.4.3-.7.8-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7z"/></g></svg>',
                        "list-num-upper-alpha": '<svg width="48" height="48"><g fill-rule="evenodd"><path opacity=".2" d="M18 12h22v4H18zM18 22h22v4H18zM18 32h22v4H18z"/><path d="M12.6 17l-.5-1.4h-2L9.5 17H8.3l2-6H12l2 6h-1.3zM11 12.3l-.7 2.3h1.6l-.8-2.3zm4.7 4.8c-.4 0-.7-.3-.7-.7 0-.4.3-.7.7-.7.5 0 .7.3.7.7 0 .4-.2.7-.7.7zM11.4 27H8.7v-6h2.6c1.2 0 1.9.6 1.9 1.5 0 .6-.5 1.2-1 1.3.7.1 1.3.7 1.3 1.5 0 1-.8 1.7-2 1.7zM10 22v1.5h1c.6 0 1-.3 1-.8 0-.4-.4-.7-1-.7h-1zm0 4H11c.7 0 1.1-.3 1.1-.8 0-.6-.4-.9-1.1-.9H10V26zm5.4 1.1c-.5 0-.8-.3-.8-.7 0-.4.3-.7.8-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7zm-4.1 10c-1.8 0-2.8-1.1-2.8-3.1s1-3.1 2.8-3.1c1.4 0 2.5.9 2.6 2.2h-1.3c0-.7-.6-1.1-1.3-1.1-1 0-1.6.7-1.6 2s.6 2 1.6 2c.7 0 1.2-.4 1.4-1h1.2c-.1 1.3-1.2 2.2-2.6 2.2zm4.5 0c-.5 0-.8-.3-.8-.7 0-.4.3-.7.8-.7.4 0 .7.3.7.7 0 .4-.3.7-.7.7z"/></g></svg>',
                        "list-num-upper-roman-rtl": '<svg width="48" height="48"><g fill-rule="evenodd"><path opacity=".2" d="M8 12h22v4H8zM8 22h22v4H8zM8 32h22v4H8z"/><path d="M31.6 17v-1.2H33V17h-1.3zm0 10v-1.2H33V27h-1.3zm0 10v-1.2H33V37h-1.3z"/><path fill-rule="nonzero" d="M34.5 20H36v7h-1.5zM34.5 30H36v7h-1.5zM37.5 20H39v7h-1.5zM37.5 30H39v7h-1.5zM40.5 30H42v7h-1.5zM34.5 10H36v7h-1.5z"/></g></svg>',
                        "list-num-upper-roman": '<svg width="48" height="48"><g fill-rule="evenodd"><path opacity=".2" d="M18 12h22v4H18zM18 22h22v4H18zM18 32h22v4H18z"/><path d="M15.1 17v-1.2h1.3V17H15zm0 10v-1.2h1.3V27H15zm0 10v-1.2h1.3V37H15z"/><path fill-rule="nonzero" d="M12 20h1.5v7H12zM12 30h1.5v7H12zM9 20h1.5v7H9zM9 30h1.5v7H9zM6 30h1.5v7H6zM12 10h1.5v7H12z"/></g></svg>',
                        lock: '<svg width="24" height="24"><path d="M16.3 11c.2 0 .3 0 .5.2l.2.6v7.4c0 .3 0 .4-.2.6l-.6.2H7.8c-.3 0-.4 0-.6-.2a.7.7 0 0 1-.2-.6v-7.4c0-.3 0-.4.2-.6l.5-.2H8V8c0-.8.3-1.5.9-2.1.6-.6 1.3-.9 2.1-.9h2c.8 0 1.5.3 2.1.9.6.6.9 1.3.9 2.1v3h.3zM10 8v3h4V8a1 1 0 0 0-.3-.7A1 1 0 0 0 13 7h-2a1 1 0 0 0-.7.3 1 1 0 0 0-.3.7z" fill-rule="evenodd"/></svg>',
                        ltr: '<svg width="24" height="24"><path d="M11 5h7a1 1 0 0 1 0 2h-1v11a1 1 0 0 1-2 0V7h-2v11a1 1 0 0 1-2 0v-6c-.5 0-1 0-1.4-.3A3.4 3.4 0 0 1 7.8 10a3.3 3.3 0 0 1 0-2.8 3.4 3.4 0 0 1 1.8-1.8L11 5zM4.4 16.2L6.2 15l-1.8-1.2a1 1 0 0 1 1.2-1.6l3 2a1 1 0 0 1 0 1.6l-3 2a1 1 0 1 1-1.2-1.6z" fill-rule="evenodd"/></svg>',
                        "more-drawer": '<svg width="24" height="24"><path d="M6 10a2 2 0 0 0-2 2c0 1.1.9 2 2 2a2 2 0 0 0 2-2 2 2 0 0 0-2-2zm12 0a2 2 0 0 0-2 2c0 1.1.9 2 2 2a2 2 0 0 0 2-2 2 2 0 0 0-2-2zm-6 0a2 2 0 0 0-2 2c0 1.1.9 2 2 2a2 2 0 0 0 2-2 2 2 0 0 0-2-2z" fill-rule="nonzero"/></svg>',
                        "new-document": '<svg width="24" height="24"><path d="M14.4 3H7a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h10a2 2 0 0 0 2-2V7.6L14.4 3zM17 19H7V5h6v4h4v10z" fill-rule="nonzero"/></svg>',
                        "new-tab": '<svg width="24" height="24"><path d="M15 13l2-2v8H5V7h8l-2 2H7v8h8v-4zm4-8v5.5l-2-2-5.6 5.5H10v-1.4L15.5 7l-2-2H19z" fill-rule="evenodd"/></svg>',
                        "non-breaking": '<svg width="24" height="24"><path d="M11 11H8a1 1 0 1 1 0-2h3V6c0-.6.4-1 1-1s1 .4 1 1v3h3c.6 0 1 .4 1 1s-.4 1-1 1h-3v3c0 .6-.4 1-1 1a1 1 0 0 1-1-1v-3zm10 4v5H3v-5c0-.6.4-1 1-1s1 .4 1 1v3h14v-3c0-.6.4-1 1-1s1 .4 1 1z" fill-rule="evenodd"/></svg>',
                        notice: '<svg width="24" height="24"><path d="M17.8 9.8L15.4 4 20 8.5v7L15.5 20h-7L4 15.5v-7L8.5 4h7l2.3 5.8zm0 0l2.2 5.7-2.3-5.8zM13 17v-2h-2v2h2zm0-4V7h-2v6h2z" fill-rule="evenodd"/></svg>',
                        "ordered-list-rtl": '<svg width="24" height="24"><path d="M6 17h8a1 1 0 0 1 0 2H6a1 1 0 0 1 0-2zm0-6h8a1 1 0 0 1 0 2H6a1 1 0 0 1 0-2zm0-6h8a1 1 0 0 1 0 2H6a1 1 0 1 1 0-2zm13-1v3.5a.5.5 0 1 1-1 0V5h-.5a.5.5 0 1 1 0-1H19zm-1 8.8l.2.2h1.3a.5.5 0 1 1 0 1h-1.6a1 1 0 0 1-.9-1V13c0-.4.3-.8.6-1l1.2-.4.2-.3a.2.2 0 0 0-.2-.2h-1.3a.5.5 0 0 1-.5-.5c0-.3.2-.5.5-.5h1.6c.5 0 .9.4.9 1v.1c0 .4-.3.8-.6 1l-1.2.4-.2.3zm2 4.2v2c0 .6-.4 1-1 1h-1.5a.5.5 0 0 1 0-1h1.2a.3.3 0 1 0 0-.6h-1.3a.4.4 0 1 1 0-.8h1.3a.3.3 0 0 0 0-.6h-1.2a.5.5 0 1 1 0-1H19c.6 0 1 .4 1 1z" fill-rule="evenodd"/></svg>',
                        "ordered-list": '<svg width="24" height="24"><path d="M10 17h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 0 1 0-2zm0-6h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 0 1 0-2zm0-6h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 1 1 0-2zM6 4v3.5c0 .3-.2.5-.5.5a.5.5 0 0 1-.5-.5V5h-.5a.5.5 0 0 1 0-1H6zm-1 8.8l.2.2h1.3c.3 0 .5.2.5.5s-.2.5-.5.5H4.9a1 1 0 0 1-.9-1V13c0-.4.3-.8.6-1l1.2-.4.2-.3a.2.2 0 0 0-.2-.2H4.5a.5.5 0 0 1-.5-.5c0-.3.2-.5.5-.5h1.6c.5 0 .9.4.9 1v.1c0 .4-.3.8-.6 1l-1.2.4-.2.3zM7 17v2c0 .6-.4 1-1 1H4.5a.5.5 0 0 1 0-1h1.2c.2 0 .3-.1.3-.3 0-.2-.1-.3-.3-.3H4.4a.4.4 0 1 1 0-.8h1.3c.2 0 .3-.1.3-.3 0-.2-.1-.3-.3-.3H4.5a.5.5 0 1 1 0-1H6c.6 0 1 .4 1 1z" fill-rule="evenodd"/></svg>',
                        orientation: '<svg width="24" height="24"><path d="M7.3 6.4L1 13l6.4 6.5 6.5-6.5-6.5-6.5zM3.7 13l3.6-3.7L11 13l-3.7 3.7-3.6-3.7zM12 6l2.8 2.7c.3.3.3.8 0 1-.3.4-.9.4-1.2 0L9.2 5.7a.8.8 0 0 1 0-1.2L13.6.2c.3-.3.9-.3 1.2 0 .3.3.3.8 0 1.1L12 4h1a9 9 0 1 1-4.3 16.9l1.5-1.5A7 7 0 1 0 13 6h-1z" fill-rule="nonzero"/></svg>',
                        outdent: '<svg width="24" height="24"><path d="M7 5h12c.6 0 1 .4 1 1s-.4 1-1 1H7a1 1 0 1 1 0-2zm5 4h7c.6 0 1 .4 1 1s-.4 1-1 1h-7a1 1 0 0 1 0-2zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1h-7a1 1 0 0 1 0-2zm-5 4h12a1 1 0 0 1 0 2H7a1 1 0 0 1 0-2zm1.6-3.8a1 1 0 0 1-1.2 1.6l-3-2a1 1 0 0 1 0-1.6l3-2a1 1 0 0 1 1.2 1.6L6.8 12l1.8 1.2z" fill-rule="evenodd"/></svg>',
                        "page-break": '<svg width="24" height="24"><g fill-rule="evenodd"><path d="M5 11c.6 0 1 .4 1 1s-.4 1-1 1a1 1 0 0 1 0-2zm3 0h1c.6 0 1 .4 1 1s-.4 1-1 1H8a1 1 0 0 1 0-2zm4 0c.6 0 1 .4 1 1s-.4 1-1 1a1 1 0 0 1 0-2zm3 0h1c.6 0 1 .4 1 1s-.4 1-1 1h-1a1 1 0 0 1 0-2zm4 0c.6 0 1 .4 1 1s-.4 1-1 1a1 1 0 0 1 0-2zM7 3v5h10V3c0-.6.4-1 1-1s1 .4 1 1v7H5V3c0-.6.4-1 1-1s1 .4 1 1zM6 22a1 1 0 0 1-1-1v-7h14v7c0 .6-.4 1-1 1a1 1 0 0 1-1-1v-5H7v5c0 .6-.4 1-1 1z"/></g></svg>',
                        paragraph: '<svg width="24" height="24"><path fill-rule="evenodd" d="M10 5h7a1 1 0 0 1 0 2h-1v11a1 1 0 0 1-2 0V7h-2v11a1 1 0 0 1-2 0v-6c-.5 0-1 0-1.4-.3A3.4 3.4 0 0 1 6.8 10a3.3 3.3 0 0 1 0-2.8 3.4 3.4 0 0 1 1.8-1.8L10 5z"/></svg>',
                        "paste-text": '<svg width="24" height="24"><path d="M18 9V5h-2v1c0 .6-.4 1-1 1H9a1 1 0 0 1-1-1V5H6v13h3V9h9zM9 20H6a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h3.2A3 3 0 0 1 12 1a3 3 0 0 1 2.8 2H18a2 2 0 0 1 2 2v4h1v12H9v-1zm1.5-9.5v9h9v-9h-9zM12 3a1 1 0 0 0-1 1c0 .5.4 1 1 1s1-.5 1-1-.4-1-1-1zm0 9h6v2h-.5l-.5-1h-1v4h.8v1h-3.6v-1h.8v-4h-1l-.5 1H12v-2z" fill-rule="nonzero"/></svg>',
                        paste: '<svg width="24" height="24"><path d="M18 9V5h-2v1c0 .6-.4 1-1 1H9a1 1 0 0 1-1-1V5H6v13h3V9h9zM9 20H6a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h3.2A3 3 0 0 1 12 1a3 3 0 0 1 2.8 2H18a2 2 0 0 1 2 2v4h1v12H9v-1zm1.5-9.5v9h9v-9h-9zM12 3a1 1 0 0 0-1 1c0 .5.4 1 1 1s1-.5 1-1-.4-1-1-1z" fill-rule="nonzero"/></svg>',
                        "permanent-pen": '<svg width="24" height="24"><path d="M10.5 17.5L8 20H3v-3l3.5-3.5a2 2 0 0 1 0-3L14 3l1 1-7.3 7.3a1 1 0 0 0 0 1.4l3.6 3.6c.4.4 1 .4 1.4 0L20 9l1 1-7.6 7.6a2 2 0 0 1-2.8 0l-.1-.1z" fill-rule="nonzero"/></svg>',
                        plus: '<svg width="24" height="24"><path d="M12 4c.5 0 1 .4 1 .9V11h6a1 1 0 0 1 .1 2H13v6a1 1 0 0 1-2 .1V13H5a1 1 0 0 1-.1-2H11V5c0-.6.4-1 1-1z"/></svg>',
                        preferences: '<svg width="24" height="24"><path d="M20.1 13.5l-1.9.2a5.8 5.8 0 0 1-.6 1.5l1.2 1.5c.4.4.3 1 0 1.4l-.7.7a1 1 0 0 1-1.4 0l-1.5-1.2a6.2 6.2 0 0 1-1.5.6l-.2 1.9c0 .5-.5.9-1 .9h-1a1 1 0 0 1-1-.9l-.2-1.9a5.8 5.8 0 0 1-1.5-.6l-1.5 1.2a1 1 0 0 1-1.4 0l-.7-.7a1 1 0 0 1 0-1.4l1.2-1.5a6.2 6.2 0 0 1-.6-1.5l-1.9-.2a1 1 0 0 1-.9-1v-1c0-.5.4-1 .9-1l1.9-.2a5.8 5.8 0 0 1 .6-1.5L5.2 7.3a1 1 0 0 1 0-1.4l.7-.7a1 1 0 0 1 1.4 0l1.5 1.2a6.2 6.2 0 0 1 1.5-.6l.2-1.9c0-.5.5-.9 1-.9h1c.5 0 1 .4 1 .9l.2 1.9a5.8 5.8 0 0 1 1.5.6l1.5-1.2a1 1 0 0 1 1.4 0l.7.7c.3.4.4 1 0 1.4l-1.2 1.5a6.2 6.2 0 0 1 .6 1.5l1.9.2c.5 0 .9.5.9 1v1c0 .5-.4 1-.9 1zM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" fill-rule="evenodd"/></svg>',
                        preview: '<svg width="24" height="24"><path d="M3.5 12.5c.5.8 1.1 1.6 1.8 2.3 2 2 4.2 3.2 6.7 3.2s4.7-1.2 6.7-3.2a16.2 16.2 0 0 0 2.1-2.8 15.7 15.7 0 0 0-2.1-2.8c-2-2-4.2-3.2-6.7-3.2a9.3 9.3 0 0 0-6.7 3.2A16.2 16.2 0 0 0 3.2 12c0 .2.2.3.3.5zm-2.4-1l.7-1.2L4 7.8C6.2 5.4 8.9 4 12 4c3 0 5.8 1.4 8.1 3.8a18.2 18.2 0 0 1 2.8 3.7v1l-.7 1.2-2.1 2.5c-2.3 2.4-5 3.8-8.1 3.8-3 0-5.8-1.4-8.1-3.8a18.2 18.2 0 0 1-2.8-3.7 1 1 0 0 1 0-1zm12-3.3a2 2 0 1 0 2.7 2.6 4 4 0 1 1-2.6-2.6z" fill-rule="nonzero"/></svg>',
                        print: '<svg width="24" height="24"><path d="M18 8H6a3 3 0 0 0-3 3v6h2v3h14v-3h2v-6a3 3 0 0 0-3-3zm-1 10H7v-4h10v4zm.5-5c-.8 0-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5 1.5.7 1.5 1.5-.7 1.5-1.5 1.5zm.5-8H6v2h12V5z" fill-rule="nonzero"/></svg>',
                        quote: '<svg width="24" height="24"><path d="M7.5 17h.9c.4 0 .7-.2.9-.6L11 13V8c0-.6-.4-1-1-1H6a1 1 0 0 0-1 1v4c0 .6.4 1 1 1h2l-1.3 2.7a1 1 0 0 0 .8 1.3zm8 0h.9c.4 0 .7-.2.9-.6L19 13V8c0-.6-.4-1-1-1h-4a1 1 0 0 0-1 1v4c0 .6.4 1 1 1h2l-1.3 2.7a1 1 0 0 0 .8 1.3z" fill-rule="nonzero"/></svg>',
                        redo: '<svg width="24" height="24"><path d="M17.6 10H12c-2.8 0-4.4 1.4-4.9 3.5-.4 2 .3 4 1.4 4.6a1 1 0 1 1-1 1.8c-2-1.2-2.9-4.1-2.3-6.8.6-3 3-5.1 6.8-5.1h5.6l-3.3-3.3a1 1 0 1 1 1.4-1.4l5 5a1 1 0 0 1 0 1.4l-5 5a1 1 0 0 1-1.4-1.4l3.3-3.3z" fill-rule="nonzero"/></svg>',
                        reload: '<svg width="24" height="24"><g fill-rule="nonzero"><path d="M5 22.1l-1.2-4.7v-.2a1 1 0 0 1 1-1l5 .4a1 1 0 1 1-.2 2l-2.2-.2a7.8 7.8 0 0 0 8.4.2 7.5 7.5 0 0 0 3.5-6.4 1 1 0 1 1 2 0 9.5 9.5 0 0 1-4.5 8 9.9 9.9 0 0 1-10.2 0l.4 1.4a1 1 0 1 1-2 .5zM13.6 7.4c0-.5.5-1 1-.9l2.8.2a8 8 0 0 0-9.5-1 7.5 7.5 0 0 0-3.6 7 1 1 0 0 1-2 0 9.5 9.5 0 0 1 4.5-8.6 10 10 0 0 1 10.9.3l-.3-1a1 1 0 0 1 2-.5l1.1 4.8a1 1 0 0 1-1 1.2l-5-.4a1 1 0 0 1-.9-1z"/></g></svg>',
                        "remove-formatting": '<svg width="24" height="24"><path d="M13.2 6a1 1 0 0 1 0 .2l-2.6 10a1 1 0 0 1-1 .8h-.2a.8.8 0 0 1-.8-1l2.6-10H8a1 1 0 1 1 0-2h9a1 1 0 0 1 0 2h-3.8zM5 18h7a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2zm13 1.5L16.5 18 15 19.5a.7.7 0 0 1-1-1l1.5-1.5-1.5-1.5a.7.7 0 0 1 1-1l1.5 1.5 1.5-1.5a.7.7 0 0 1 1 1L17.5 17l1.5 1.5a.7.7 0 0 1-1 1z" fill-rule="evenodd"/></svg>',
                        remove: '<svg width="24" height="24"><path d="M16 7h3a1 1 0 0 1 0 2h-1v9a3 3 0 0 1-3 3H9a3 3 0 0 1-3-3V9H5a1 1 0 1 1 0-2h3V6a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3v1zm-2 0V6c0-.6-.4-1-1-1h-2a1 1 0 0 0-1 1v1h4zm2 2H8v9c0 .6.4 1 1 1h6c.6 0 1-.4 1-1V9zm-7 3a1 1 0 0 1 2 0v4a1 1 0 0 1-2 0v-4zm4 0a1 1 0 0 1 2 0v4a1 1 0 0 1-2 0v-4z" fill-rule="nonzero"/></svg>',
                        "resize-handle": '<svg width="10" height="10"><g fill-rule="nonzero"><path d="M8.1 1.1A.5.5 0 1 1 9 2l-7 7A.5.5 0 1 1 1 8l7-7zM8.1 5.1A.5.5 0 1 1 9 6l-3 3A.5.5 0 1 1 5 8l3-3z"/></g></svg>',
                        resize: '<svg width="24" height="24"><path d="M4 5c0-.3.1-.5.3-.7.2-.2.4-.3.7-.3h6c.3 0 .5.1.7.3.2.2.3.4.3.7 0 .3-.1.5-.3.7a1 1 0 0 1-.7.3H7.4L18 16.6V13c0-.3.1-.5.3-.7.2-.2.4-.3.7-.3.3 0 .5.1.7.3.2.2.3.4.3.7v6c0 .3-.1.5-.3.7a1 1 0 0 1-.7.3h-6a1 1 0 0 1-.7-.3 1 1 0 0 1-.3-.7c0-.3.1-.5.3-.7.2-.2.4-.3.7-.3h3.6L6 7.4V11c0 .3-.1.5-.3.7a1 1 0 0 1-.7.3 1 1 0 0 1-.7-.3A1 1 0 0 1 4 11V5z" fill-rule="evenodd"/></svg>',
                        "restore-draft": '<svg width="24" height="24"><g fill-rule="evenodd"><path d="M17 13c0 .6-.4 1-1 1h-4V8c0-.6.4-1 1-1s1 .4 1 1v4h2c.6 0 1 .4 1 1z"/><path d="M4.7 10H9a1 1 0 0 1 0 2H3a1 1 0 0 1-1-1V5a1 1 0 1 1 2 0v3l2.5-2.4a9.2 9.2 0 0 1 10.8-1.5A9 9 0 0 1 13.4 21c-2.4.1-4.7-.7-6.5-2.2a1 1 0 1 1 1.3-1.5 7.2 7.2 0 0 0 11.6-3.7 7 7 0 0 0-3.5-7.7A7.2 7.2 0 0 0 8 7L4.7 10z" fill-rule="nonzero"/></g></svg>',
                        "rotate-left": '<svg width="24" height="24"><path d="M4.7 10H9a1 1 0 0 1 0 2H3a1 1 0 0 1-1-1V5a1 1 0 1 1 2 0v3l2.5-2.4a9.2 9.2 0 0 1 10.8-1.5A9 9 0 0 1 13.4 21c-2.4.1-4.7-.7-6.5-2.2a1 1 0 1 1 1.3-1.5 7.2 7.2 0 0 0 11.6-3.7 7 7 0 0 0-3.5-7.7A7.2 7.2 0 0 0 8 7L4.7 10z" fill-rule="nonzero"/></svg>',
                        "rotate-right": '<svg width="24" height="24"><path d="M20 8V5a1 1 0 0 1 2 0v6c0 .6-.4 1-1 1h-6a1 1 0 0 1 0-2h4.3L16 7A7.2 7.2 0 0 0 7.7 6a7 7 0 0 0 3 13.1c1.9.1 3.7-.5 5-1.7a1 1 0 0 1 1.4 1.5A9.2 9.2 0 0 1 2.2 14c-.9-3.9 1-8 4.5-9.9 3.5-1.9 8-1.3 10.8 1.5L20 8z" fill-rule="nonzero"/></svg>',
                        rtl: '<svg width="24" height="24"><path d="M8 5h8v2h-2v12h-2V7h-2v12H8v-7c-.5 0-1 0-1.4-.3A3.4 3.4 0 0 1 4.8 10a3.3 3.3 0 0 1 0-2.8 3.4 3.4 0 0 1 1.8-1.8L8 5zm12 11.2a1 1 0 1 1-1 1.6l-3-2a1 1 0 0 1 0-1.6l3-2a1 1 0 1 1 1 1.6L18.4 15l1.8 1.2z" fill-rule="evenodd"/></svg>',
                        save: '<svg width="24" height="24"><path d="M5 16h14a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2c0-1.1.9-2 2-2zm0 2v2h14v-2H5zm10 0h2v2h-2v-2zm-4-6.4L8.7 9.3a1 1 0 1 0-1.4 1.4l4 4c.4.4 1 .4 1.4 0l4-4a1 1 0 1 0-1.4-1.4L13 11.6V4a1 1 0 0 0-2 0v7.6z" fill-rule="nonzero"/></svg>',
                        search: '<svg width="24" height="24"><path d="M16 17.3a8 8 0 1 1 1.4-1.4l4.3 4.4a1 1 0 0 1-1.4 1.4l-4.4-4.3zm-5-.3a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" fill-rule="nonzero"/></svg>',
                        "select-all": '<svg width="24" height="24"><path d="M3 5h2V3a2 2 0 0 0-2 2zm0 8h2v-2H3v2zm4 8h2v-2H7v2zM3 9h2V7H3v2zm10-6h-2v2h2V3zm6 0v2h2a2 2 0 0 0-2-2zM5 21v-2H3c0 1.1.9 2 2 2zm-2-4h2v-2H3v2zM9 3H7v2h2V3zm2 18h2v-2h-2v2zm8-8h2v-2h-2v2zm0 8a2 2 0 0 0 2-2h-2v2zm0-12h2V7h-2v2zm0 8h2v-2h-2v2zm-4 4h2v-2h-2v2zm0-16h2V3h-2v2zM7 17h10V7H7v10zm2-8h6v6H9V9z" fill-rule="nonzero"/></svg>',
                        selected: '<svg width="24" height="24"><path fill-rule="nonzero" d="M6 4h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm3.6 10.9L7 12.3a.7.7 0 0 0-1 1L9.6 17 18 8.6a.7.7 0 0 0 0-1 .7.7 0 0 0-1 0l-7.4 7.3z"/></svg>',
                        settings: '<svg width="24" height="24"><path d="M11 6h8c.6 0 1 .4 1 1s-.4 1-1 1h-8v.3c0 .2 0 .3-.2.5l-.6.2H7.8c-.3 0-.4 0-.6-.2a.7.7 0 0 1-.2-.6V8H5a1 1 0 1 1 0-2h2v-.3c0-.2 0-.3.2-.5l.5-.2h2.5c.3 0 .4 0 .6.2l.2.5V6zM8 8h2V6H8v2zm9 2.8v.2h2c.6 0 1 .4 1 1s-.4 1-1 1h-2v.3c0 .2 0 .3-.2.5l-.6.2h-2.4c-.3 0-.4 0-.6-.2a.7.7 0 0 1-.2-.6V13H5a1 1 0 0 1 0-2h8v-.3c0-.2 0-.3.2-.5l.6-.2h2.4c.3 0 .4 0 .6.2l.2.6zM14 13h2v-2h-2v2zm-3 2.8v.2h8c.6 0 1 .4 1 1s-.4 1-1 1h-8v.3c0 .2 0 .3-.2.5l-.6.2H7.8c-.3 0-.4 0-.6-.2a.7.7 0 0 1-.2-.6V18H5a1 1 0 0 1 0-2h2v-.3c0-.2 0-.3.2-.5l.5-.2h2.5c.3 0 .4 0 .6.2l.2.6zM8 18h2v-2H8v2z" fill-rule="evenodd"/></svg>',
                        sharpen: '<svg width="24" height="24"><path d="M16 6l4 4-8 9-8-9 4-4h8zm-4 10.2l5.5-6.2-.1-.1H12v-.3h5.1l-.2-.2H12V9h4.6l-.2-.2H12v-.3h4.1l-.2-.2H12V8h3.6l-.2-.2H8.7L6.5 10l.1.1H12v.3H6.9l.2.2H12v.3H7.3l.2.2H12v.3H7.7l.3.2h4v.3H8.2l.2.2H12v.3H8.6l.3.2H12v.3H9l.3.2H12v.3H9.5l.2.2H12v.3h-2l.2.2H12v.3h-1.6l.2.2H12v.3h-1.1l.2.2h.9v.3h-.7l.2.2h.5v.3h-.3l.3.2z" fill-rule="evenodd"/></svg>',
                        "sort-asc": '<svg width="24" height="24"><g fill-rule="evenodd"><path d="M4 8h5a1 1 0 1 1 0 2H4a1 1 0 1 1 0-2zm0 8h8a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0-4h7a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/><path fill-rule="nonzero" d="M16 8.4l-2.3 2.3a1 1 0 0 1-1.4-1.4l4-4a1 1 0 0 1 1.4 0l4 4a1 1 0 1 1-1.4 1.4L18 8.4V18a1 1 0 0 1-2 0V8.4z"/></g></svg>',
                        "sort-dsc": '<svg width="24" height="24"><g fill-rule="evenodd"><path d="M4 16h5a1 1 0 0 0 0-2H4a1 1 0 0 0 0 2zm0-8h8a1 1 0 0 0 0-2H4a1 1 0 1 0 0 2zm0 4h7a1 1 0 0 0 0-2H4a1 1 0 0 0 0 2z"/><path fill-rule="nonzero" d="M16 15.6l-2.3-2.3a1 1 0 0 0-1.4 1.4l4 4c.4.4 1 .4 1.4 0l4-4a1 1 0 0 0-1.4-1.4L18 15.6V6a1 1 0 0 0-2 0v9.6z"/></g></svg>',
                        sourcecode: '<svg width="24" height="24"><g fill-rule="nonzero"><path d="M9.8 15.7c.3.3.3.8 0 1-.3.4-.9.4-1.2 0l-4.4-4.1a.8.8 0 0 1 0-1.2l4.4-4.2c.3-.3.9-.3 1.2 0 .3.3.3.8 0 1.1L6 12l3.8 3.7zM14.2 15.7c-.3.3-.3.8 0 1 .4.4.9.4 1.2 0l4.4-4.1c.3-.3.3-.9 0-1.2l-4.4-4.2a.8.8 0 0 0-1.2 0c-.3.3-.3.8 0 1.1L18 12l-3.8 3.7z"/></g></svg>',
                        "spell-check": '<svg width="24" height="24"><path d="M6 8v3H5V5c0-.3.1-.5.3-.7.2-.2.4-.3.7-.3h2c.3 0 .5.1.7.3.2.2.3.4.3.7v6H8V8H6zm0-3v2h2V5H6zm13 0h-3v5h3v1h-3a1 1 0 0 1-.7-.3 1 1 0 0 1-.3-.7V5c0-.3.1-.5.3-.7.2-.2.4-.3.7-.3h3v1zm-5 1.5l-.1.7c-.1.2-.3.3-.6.3.3 0 .5.1.6.3l.1.7V10c0 .3-.1.5-.3.7a1 1 0 0 1-.7.3h-3V4h3c.3 0 .5.1.7.3.2.2.3.4.3.7v1.5zM13 10V8h-2v2h2zm0-3V5h-2v2h2zm3 5l1 1-6.5 7L7 15.5l1.3-1 2.2 2.2L16 12z" fill-rule="evenodd"/></svg>',
                        "strike-through": '<svg width="24" height="24"><g fill-rule="evenodd"><path d="M15.6 8.5c-.5-.7-1-1.1-1.3-1.3-.6-.4-1.3-.6-2-.6-2.7 0-2.8 1.7-2.8 2.1 0 1.6 1.8 2 3.2 2.3 4.4.9 4.6 2.8 4.6 3.9 0 1.4-.7 4.1-5 4.1A6.2 6.2 0 0 1 7 16.4l1.5-1.1c.4.6 1.6 2 3.7 2 1.6 0 2.5-.4 3-1.2.4-.8.3-2-.8-2.6-.7-.4-1.6-.7-2.9-1-1-.2-3.9-.8-3.9-3.6C7.6 6 10.3 5 12.4 5c2.9 0 4.2 1.6 4.7 2.4l-1.5 1.1z"/><path d="M5 11h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2z" fill-rule="nonzero"/></g></svg>',
                        subscript: '<svg width="24" height="24"><path d="M10.4 10l4.6 4.6-1.4 1.4L9 11.4 4.4 16 3 14.6 7.6 10 3 5.4 4.4 4 9 8.6 13.6 4 15 5.4 10.4 10zM21 19h-5v-1l1-.8 1.7-1.6c.3-.4.5-.8.5-1.2 0-.3 0-.6-.2-.7-.2-.2-.5-.3-.9-.3a2 2 0 0 0-.8.2l-.7.3-.4-1.1 1-.6 1.2-.2c.8 0 1.4.3 1.8.7.4.4.6.9.6 1.5s-.2 1.1-.5 1.6a8 8 0 0 1-1.3 1.3l-.6.6h2.6V19z" fill-rule="nonzero"/></svg>',
                        superscript: '<svg width="24" height="24"><path d="M15 9.4L10.4 14l4.6 4.6-1.4 1.4L9 15.4 4.4 20 3 18.6 7.6 14 3 9.4 4.4 8 9 12.6 13.6 8 15 9.4zm5.9 1.6h-5v-1l1-.8 1.7-1.6c.3-.5.5-.9.5-1.3 0-.3 0-.5-.2-.7-.2-.2-.5-.3-.9-.3l-.8.2-.7.4-.4-1.2c.2-.2.5-.4 1-.5.3-.2.8-.2 1.2-.2.8 0 1.4.2 1.8.6.4.4.6 1 .6 1.6 0 .5-.2 1-.5 1.5l-1.3 1.4-.6.5h2.6V11z" fill-rule="nonzero"/></svg>',
                        "table-cell-properties": '<svg width="24" height="24"><path fill-rule="nonzero" d="M19 4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h14zm-8 9H5v5h6v-5zm8 0h-6v5h6v-5zm-8-7H5v5h6V6z"/></svg>',
                        "table-cell-select-all": '<svg width="24" height="24"><g fill-rule="evenodd"><path fill-rule="nonzero" d="M19 4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h14zm0 2H5v12h14V6z"/><path d="M13 6v5h6v2h-6v5h-2v-5H5v-2h6V6h2z" opacity=".2"/></g></svg>',
                        "table-cell-select-inner": '<svg width="24" height="24"><g fill-rule="evenodd"><path fill-rule="nonzero" d="M19 4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h14zm0 2H5v12h14V6z" opacity=".2"/><path d="M13 6v5h6v2h-6v5h-2v-5H5v-2h6V6h2z"/></g></svg>',
                        "table-delete-column": '<svg width="24" height="24"><path fill-rule="nonzero" d="M19 4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h14zm-4 4h-2V6h-2v2H9V6H5v12h4v-2h2v2h2v-2h2v2h4V6h-4v2zm.3.5l1 1.2-3 2.3 3 2.3-1 1.2L12 13l-3.3 2.6-1-1.2 3-2.3-3-2.3 1-1.2L12 11l3.3-2.5z"/></svg>',
                        "table-delete-row": '<svg width="24" height="24"><path fill-rule="nonzero" d="M19 4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h14zm0 2H5v3h2.5v2H5v2h2.5v2H5v3h14v-3h-2.5v-2H19v-2h-2.5V9H19V6zm-4.7 1.8l1.2 1L13 12l2.6 3.3-1.2 1-2.3-3-2.3 3-1.2-1L11 12 8.5 8.7l1.2-1 2.3 3 2.3-3z"/></svg>',
                        "table-delete-table": '<svg width="24" height="24"><g fill-rule="nonzero"><path d="M19 4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h14zM5 6v12h14V6H5z"/><path d="M14.4 8.6l1 1-2.3 2.4 2.3 2.4-1 1-2.4-2.3-2.4 2.3-1-1 2.3-2.4-2.3-2.4 1-1 2.4 2.3z"/></g></svg>',
                        "table-insert-column-after": '<svg width="24" height="24"><path fill-rule="nonzero" d="M20 4c.6 0 1 .4 1 1v2a1 1 0 0 1-2 0V6h-8v12h8v-1a1 1 0 0 1 2 0v2c0 .5-.4 1-.9 1H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h15zM9 13H5v5h4v-5zm7-5c.5 0 1 .4 1 .9V11h2a1 1 0 0 1 .1 2H17v2a1 1 0 0 1-2 .1V13h-2a1 1 0 0 1-.1-2H15V9c0-.6.4-1 1-1zM9 6H5v5h4V6z"/></svg>',
                        "table-insert-column-before": '<svg width="24" height="24"><path fill-rule="nonzero" d="M19 4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a1 1 0 0 1-1-1v-2a1 1 0 0 1 2 0v1h8V6H5v1a1 1 0 1 1-2 0V5c0-.6.4-1 1-1h15zm0 9h-4v5h4v-5zM8 8c.5 0 1 .4 1 .9V11h2a1 1 0 0 1 .1 2H9v2a1 1 0 0 1-2 .1V13H5a1 1 0 0 1-.1-2H7V9c0-.6.4-1 1-1zm11-2h-4v5h4V6z"/></svg>',
                        "table-insert-row-above": '<svg width="24" height="24"><path fill-rule="nonzero" d="M6 4a1 1 0 1 1 0 2H5v6h14V6h-1a1 1 0 0 1 0-2h2c.6 0 1 .4 1 1v13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-.6.4-1 1-1h2zm5 10H5v4h6v-4zm8 0h-6v4h6v-4zM12 3c.5 0 1 .4 1 .9V6h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 .1V8H9a1 1 0 0 1 0-2h2V4c0-.6.4-1 1-1z"/></svg>',
                        "table-insert-row-after": '<svg width="24" height="24"><path fill-rule="nonzero" d="M12 13c.5 0 1 .4 1 .9V16h2a1 1 0 0 1 .1 2H13v2a1 1 0 0 1-2 .1V18H9a1 1 0 0 1-.1-2H11v-2c0-.6.4-1 1-1zm6 7a1 1 0 0 1 0-2h1v-6H5v6h1a1 1 0 0 1 0 2H4a1 1 0 0 1-1-1V6c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v13c0 .5-.4 1-.9 1H18zM11 6H5v4h6V6zm8 0h-6v4h6V6z"/></svg>',
                        "table-left-header": '<svg width="24" height="24"><path d="M19 4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h14zm0 9h-4v5h4v-5zm-6 0H9v5h4v-5zm0-7H9v5h4V6zm6 0h-4v5h4V6z"/></svg>',
                        "table-merge-cells": '<svg width="24" height="24"><path fill-rule="nonzero" d="M19 4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h14zM5 15.5V18h3v-2.5H5zm14-5h-9V18h9v-7.5zM19 6h-4v2.5h4V6zM8 6H5v2.5h3V6zm5 0h-3v2.5h3V6zm-8 7.5h3v-3H5v3z"/></svg>',
                        "table-row-properties": '<svg width="24" height="24"><path fill-rule="nonzero" d="M19 4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h14zM5 15v3h6v-3H5zm14 0h-6v3h6v-3zm0-9h-6v3h6V6zM5 9h6V6H5v3z"/></svg>',
                        "table-split-cells": '<svg width="24" height="24"><path fill-rule="nonzero" d="M19 4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h14zM8 15.5H5V18h3v-2.5zm11-5h-9V18h9v-7.5zm-2.5 1l1 1-2 2 2 2-1 1-2-2-2 2-1-1 2-2-2-2 1-1 2 2 2-2zm-8.5-1H5v3h3v-3zM19 6h-4v2.5h4V6zM8 6H5v2.5h3V6zm5 0h-3v2.5h3V6z"/></svg>',
                        "table-top-header": '<svg width="24" height="24"><path d="M19 4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h14zm-8 11H5v3h6v-3zm8 0h-6v3h6v-3zm0-5h-6v3h6v-3zM5 13h6v-3H5v3z"/></svg>',
                        table: '<svg width="24" height="24"><path fill-rule="nonzero" d="M19 4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h14zM5 14v4h6v-4H5zm14 0h-6v4h6v-4zm0-6h-6v4h6V8zM5 12h6V8H5v4z"/></svg>',
                        template: '<svg width="24" height="24"><path d="M19 19v-1H5v1h14zM9 16v-4a5 5 0 1 1 6 0v4h4a2 2 0 0 1 2 2v3H3v-3c0-1.1.9-2 2-2h4zm4 0v-5l.8-.6a3 3 0 1 0-3.6 0l.8.6v5h2z" fill-rule="nonzero"/></svg>',
                        "temporary-placeholder": '<svg width="24" height="24"><g fill-rule="evenodd"><path d="M9 7.6V6h2.5V4.5a.5.5 0 1 1 1 0V6H15v1.6a8 8 0 1 1-6 0zm-2.6 5.3a.5.5 0 0 0 .3.6c.3 0 .6 0 .6-.3l.1-.2a5 5 0 0 1 3.3-2.8c.3-.1.4-.4.4-.6-.1-.3-.4-.5-.6-.4a6 6 0 0 0-4.1 3.7z"/><circle cx="14" cy="4" r="1"/><circle cx="12" cy="2" r="1"/><circle cx="10" cy="4" r="1"/></g></svg>',
                        "text-color": '<svg width="24" height="24"><g fill-rule="evenodd"><path id="tox-icon-text-color__color" d="M3 18h18v3H3z"/><path d="M8.7 16h-.8a.5.5 0 0 1-.5-.6l2.7-9c.1-.3.3-.4.5-.4h2.8c.2 0 .4.1.5.4l2.7 9a.5.5 0 0 1-.5.6h-.8a.5.5 0 0 1-.4-.4l-.7-2.2c0-.3-.3-.4-.5-.4h-3.4c-.2 0-.4.1-.5.4l-.7 2.2c0 .3-.2.4-.4.4zm2.6-7.6l-.6 2a.5.5 0 0 0 .5.6h1.6a.5.5 0 0 0 .5-.6l-.6-2c0-.3-.3-.4-.5-.4h-.4c-.2 0-.4.1-.5.4z"/></g></svg>',
                        toc: '<svg width="24" height="24"><path d="M5 5c.6 0 1 .4 1 1s-.4 1-1 1a1 1 0 1 1 0-2zm3 0h11c.6 0 1 .4 1 1s-.4 1-1 1H8a1 1 0 1 1 0-2zm-3 8c.6 0 1 .4 1 1s-.4 1-1 1a1 1 0 0 1 0-2zm3 0h11c.6 0 1 .4 1 1s-.4 1-1 1H8a1 1 0 0 1 0-2zm0-4c.6 0 1 .4 1 1s-.4 1-1 1a1 1 0 1 1 0-2zm3 0h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 0 1 0-2zm-3 8c.6 0 1 .4 1 1s-.4 1-1 1a1 1 0 0 1 0-2zm3 0h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 0 1 0-2z" fill-rule="evenodd"/></svg>',
                        translate: '<svg width="24" height="24"><path d="M12.7 14.3l-.3.7-.4.7-2.2-2.2-3.1 3c-.3.4-.8.4-1 0a.7.7 0 0 1 0-1l3.1-3A12.4 12.4 0 0 1 6.7 9H8a10.1 10.1 0 0 0 1.7 2.4c.5-.5 1-1.1 1.4-1.8l.9-2H4.7a.7.7 0 1 1 0-1.5h4.4v-.7c0-.4.3-.8.7-.8.4 0 .7.4.7.8v.7H15c.4 0 .8.3.8.7 0 .4-.4.8-.8.8h-1.4a12.3 12.3 0 0 1-1 2.4 13.5 13.5 0 0 1-1.7 2.3l1.9 1.8zm4.3-3l2.7 7.3a.5.5 0 0 1-.4.7 1 1 0 0 1-1-.7l-.6-1.5h-3.4l-.6 1.5a1 1 0 0 1-1 .7.5.5 0 0 1-.4-.7l2.7-7.4a1 1 0 1 1 2 0zm-2.2 4.4h2.4L16 12.5l-1.2 3.2z" fill-rule="evenodd"/></svg>',
                        underline: '<svg width="24" height="24"><path d="M16 5c.6 0 1 .4 1 1v5.5a4 4 0 0 1-.4 1.8l-1 1.4a5.3 5.3 0 0 1-5.5 1 5 5 0 0 1-1.6-1c-.5-.4-.8-.9-1.1-1.4a4 4 0 0 1-.4-1.8V6c0-.6.4-1 1-1s1 .4 1 1v5.5c0 .3 0 .6.2 1l.6.7a3.3 3.3 0 0 0 2.2.8 3.4 3.4 0 0 0 2.2-.8c.3-.2.4-.5.6-.8l.2-.9V6c0-.6.4-1 1-1zM8 17h8c.6 0 1 .4 1 1s-.4 1-1 1H8a1 1 0 0 1 0-2z" fill-rule="evenodd"/></svg>',
                        undo: '<svg width="24" height="24"><path d="M6.4 8H12c3.7 0 6.2 2 6.8 5.1.6 2.7-.4 5.6-2.3 6.8a1 1 0 0 1-1-1.8c1.1-.6 1.8-2.7 1.4-4.6-.5-2.1-2.1-3.5-4.9-3.5H6.4l3.3 3.3a1 1 0 1 1-1.4 1.4l-5-5a1 1 0 0 1 0-1.4l5-5a1 1 0 0 1 1.4 1.4L6.4 8z" fill-rule="nonzero"/></svg>',
                        unlink: '<svg width="24" height="24"><path d="M6.2 12.3a1 1 0 0 1 1.4 1.4l-2 2a2 2 0 1 0 2.6 2.8l4.8-4.8a1 1 0 0 0 0-1.4 1 1 0 1 1 1.4-1.3 2.9 2.9 0 0 1 0 4L9.6 20a3.9 3.9 0 0 1-5.5-5.5l2-2zm11.6-.6a1 1 0 0 1-1.4-1.4l2.1-2a2 2 0 1 0-2.7-2.8L11 10.3a1 1 0 0 0 0 1.4A1 1 0 1 1 9.6 13a2.9 2.9 0 0 1 0-4L14.4 4a3.9 3.9 0 0 1 5.5 5.5l-2 2zM7.6 6.3a.8.8 0 0 1-1 1.1L3.3 4.2a.7.7 0 1 1 1-1l3.2 3.1zM5.1 8.6a.8.8 0 0 1 0 1.5H3a.8.8 0 0 1 0-1.5H5zm5-3.5a.8.8 0 0 1-1.5 0V3a.8.8 0 0 1 1.5 0V5zm6 11.8a.8.8 0 0 1 1-1l3.2 3.2a.8.8 0 0 1-1 1L16 17zm-2.2 2a.8.8 0 0 1 1.5 0V21a.8.8 0 0 1-1.5 0V19zm5-3.5a.7.7 0 1 1 0-1.5H21a.8.8 0 0 1 0 1.5H19z" fill-rule="nonzero"/></svg>',
                        unlock: '<svg width="24" height="24"><path d="M16 5c.8 0 1.5.3 2.1.9.6.6.9 1.3.9 2.1v3h-2V8a1 1 0 0 0-.3-.7A1 1 0 0 0 16 7h-2a1 1 0 0 0-.7.3 1 1 0 0 0-.3.7v3h.3c.2 0 .3 0 .5.2l.2.6v7.4c0 .3 0 .4-.2.6l-.6.2H4.8c-.3 0-.4 0-.6-.2a.7.7 0 0 1-.2-.6v-7.4c0-.3 0-.4.2-.6l.5-.2H11V8c0-.8.3-1.5.9-2.1.6-.6 1.3-.9 2.1-.9h2z" fill-rule="evenodd"/></svg>',
                        "unordered-list": '<svg width="24" height="24"><path d="M11 5h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 0 1 0-2zm0 6h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 0 1 0-2zm0 6h8c.6 0 1 .4 1 1s-.4 1-1 1h-8a1 1 0 0 1 0-2zM4.5 6c0-.4.1-.8.4-1 .3-.4.7-.5 1.1-.5.4 0 .8.1 1 .4.4.3.5.7.5 1.1 0 .4-.1.8-.4 1-.3.4-.7.5-1.1.5-.4 0-.8-.1-1-.4-.4-.3-.5-.7-.5-1.1zm0 6c0-.4.1-.8.4-1 .3-.4.7-.5 1.1-.5.4 0 .8.1 1 .4.4.3.5.7.5 1.1 0 .4-.1.8-.4 1-.3.4-.7.5-1.1.5-.4 0-.8-.1-1-.4-.4-.3-.5-.7-.5-1.1zm0 6c0-.4.1-.8.4-1 .3-.4.7-.5 1.1-.5.4 0 .8.1 1 .4.4.3.5.7.5 1.1 0 .4-.1.8-.4 1-.3.4-.7.5-1.1.5-.4 0-.8-.1-1-.4-.4-.3-.5-.7-.5-1.1z" fill-rule="evenodd"/></svg>',
                        unselected: '<svg width="24" height="24"><path fill-rule="nonzero" d="M6 4h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm0 1a1 1 0 0 0-1 1v12c0 .6.4 1 1 1h12c.6 0 1-.4 1-1V6c0-.6-.4-1-1-1H6z"/></svg>',
                        upload: '<svg width="24" height="24"><path d="M18 19v-2a1 1 0 0 1 2 0v3c0 .6-.4 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 2 0v2h12zM11 6.4L8.7 8.7a1 1 0 0 1-1.4-1.4l4-4a1 1 0 0 1 1.4 0l4 4a1 1 0 1 1-1.4 1.4L13 6.4V16a1 1 0 0 1-2 0V6.4z" fill-rule="nonzero"/></svg>',
                        user: '<svg width="24" height="24"><path d="M12 24a12 12 0 1 1 0-24 12 12 0 0 1 0 24zm-8.7-5.3a11 11 0 0 0 17.4 0C19.4 16.3 14.6 15 12 15c-2.6 0-7.4 1.3-8.7 3.7zM12 13c2.2 0 4-2 4-4.5S14.2 4 12 4 8 6 8 8.5 9.8 13 12 13z" fill-rule="nonzero"/></svg>',
                        visualblocks: '<svg width="24" height="24"><path d="M9 19v2H7v-2h2zm-4 0v2a2 2 0 0 1-2-2h2zm8 0v2h-2v-2h2zm8 0a2 2 0 0 1-2 2v-2h2zm-4 0v2h-2v-2h2zM15 7a1 1 0 0 1 0 2v7a1 1 0 0 1-2 0V9h-1v7a1 1 0 0 1-2 0v-4a2.5 2.5 0 0 1-.2-5H15zM5 15v2H3v-2h2zm16 0v2h-2v-2h2zM5 11v2H3v-2h2zm16 0v2h-2v-2h2zM5 7v2H3V7h2zm16 0v2h-2V7h2zM5 3v2H3c0-1.1.9-2 2-2zm8 0v2h-2V3h2zm6 0a2 2 0 0 1 2 2h-2V3zM9 3v2H7V3h2zm8 0v2h-2V3h2z" fill-rule="evenodd"/></svg>',
                        visualchars: '<svg width="24" height="24"><path d="M10 5h7a1 1 0 0 1 0 2h-1v11a1 1 0 0 1-2 0V7h-2v11a1 1 0 0 1-2 0v-6c-.5 0-1 0-1.4-.3A3.4 3.4 0 0 1 6.8 10a3.3 3.3 0 0 1 0-2.8 3.4 3.4 0 0 1 1.8-1.8L10 5z" fill-rule="evenodd"/></svg>',
                        warning: '<svg width="24" height="24"><path d="M19.8 18.3c.2.5.3.9 0 1.2-.1.3-.5.5-1 .5H5.2c-.5 0-.9-.2-1-.5-.3-.3-.2-.7 0-1.2L11 4.7l.5-.5.5-.2c.2 0 .3 0 .5.2.2 0 .3.3.5.5l6.8 13.6zM12 18c.3 0 .5-.1.7-.3.2-.2.3-.4.3-.7a1 1 0 0 0-.3-.7 1 1 0 0 0-.7-.3 1 1 0 0 0-.7.3 1 1 0 0 0-.3.7c0 .3.1.5.3.7.2.2.4.3.7.3zm.7-3l.3-4a1 1 0 0 0-.3-.7 1 1 0 0 0-.7-.3 1 1 0 0 0-.7.3 1 1 0 0 0-.3.7l.3 4h1.4z" fill-rule="evenodd"/></svg>',
                        "zoom-in": '<svg width="24" height="24"><path d="M16 17.3a8 8 0 1 1 1.4-1.4l4.3 4.4a1 1 0 0 1-1.4 1.4l-4.4-4.3zm-5-.3a6 6 0 1 0 0-12 6 6 0 0 0 0 12zm-1-9a1 1 0 0 1 2 0v6a1 1 0 0 1-2 0V8zm-2 4a1 1 0 0 1 0-2h6a1 1 0 0 1 0 2H8z" fill-rule="nonzero"/></svg>',
                        "zoom-out": '<svg width="24" height="24"><path d="M16 17.3a8 8 0 1 1 1.4-1.4l4.3 4.4a1 1 0 0 1-1.4 1.4l-4.4-4.3zm-5-.3a6 6 0 1 0 0-12 6 6 0 0 0 0 12zm-3-5a1 1 0 0 1 0-2h6a1 1 0 0 1 0 2H8z" fill-rule="nonzero"/></svg>'
                    }), Xd.get(e).icons);
                N(t, function (e, t) {
                    te(r, t) || n.ui.registry.addIcon(t, e)
                })
            }(e), function (e) {
                var t = e.settings.theme;
                if (K(t)) {
                    e.settings.theme = iz(t);
                    var n = rh.get(t);
                    e.theme = new n(e, rh.urls[t]), e.theme.init && e.theme.init(e, rh.urls[t] || e.documentBaseUrl.replace(/\/$/, ""), e.$)
                } else e.theme = {}
            }(e), function (t) {
                var n = [];
                Jn.each(t.settings.plugins.split(/[ ,]/), function (e) {
                    Fz(t, n, iz(e))
                })
            }(e);
            var t = function (e) {
                var t = e.getElement();
                return e.orgDisplay = t.style.display, K(e.settings.theme) ? function (e) {
                    return e.theme.renderUI()
                }(e) : P(e.settings.theme) ? function (e) {
                    var t = e.getElement(), n = (0, e.settings.theme)(e, t);
                    return n.editorContainer.nodeType && (n.editorContainer.id = n.editorContainer.id || e.id + "_parent"), n.iframeContainer && n.iframeContainer.nodeType && (n.iframeContainer.id = n.iframeContainer.id || e.id + "_iframecontainer"), n.height = n.iframeHeight ? n.iframeHeight : t.offsetHeight, n
                }(e) : uz(e)
            }(e);
            return e.editorContainer = t.editorContainer ? t.editorContainer : null, sh(e), e.inline ? Pz(e) : Vz(e, t)
        }, jz = ea.DOM, qz = function (t) {
            var e = t.settings, n = t.id;
            la.setCode(ks(t));
            var r = function () {
                jz.unbind(j.window, "ready", r), t.render()
            };
            if (Zr.Event.domLoaded) {
                if (t.getElement() && Kn.contentEditable) {
                    e.inline ? t.inline = !0 : (t.orgVisibility = t.getElement().style.visibility, t.getElement().style.visibility = "hidden");
                    var o = t.getElement().form || jz.getParent(n, "form");
                    o && (t.formElement = o, e.hidden_input && !en.isTextareaOrInput(t.getElement()) && (jz.insertAfter(jz.create("input", {
                        type: "hidden",
                        name: n
                    }), n), t.hasHiddenInput = !0), t.formEventDelegate = function (e) {
                        t.fire(e.type, e)
                    }, jz.bind(o, "submit reset", t.formEventDelegate), t.on("reset", function () {
                        t.resetContent()
                    }), !e.submit_patch || o.submit.nodeType || o.submit.length || o._mceOldSubmit || (o._mceOldSubmit = o.submit, o.submit = function () {
                        return t.editorManager.triggerSave(), t.setDirty(!1), o._mceOldSubmit(o)
                    })), t.windowManager = oh(t), t.notificationManager = th(t), "xml" === e.encoding && t.on("GetContent", function (e) {
                        e.save && (e.content = jz.encode(e.content))
                    }), e.add_form_submit_trigger && t.on("submit", function () {
                        t.initialized && t.save()
                    }), e.add_unload_trigger && (t._beforeUnload = function () {
                        !t.initialized || t.destroyed || t.isHidden() || t.save({
                            format: "raw",
                            no_events: !0,
                            set_dirty: !1
                        })
                    }, t.editorManager.on("BeforeUnload", t._beforeUnload)), t.editorManager.add(t), lz(t, t.suffix)
                }
            } else jz.bind(j.window, "ready", r)
        }, $z = function (e, t) {
            var n = t.firstChild, r = t.lastChild;
            return n && "meta" === n.name && (n = n.next), r && "mce_marker" === r.attr("id") && (r = r.prev), function (e, t) {
                var n = e.getNonEmptyElements();
                return t && (t.isEmpty(n) || fz(e, t))
            }(e, r) && (r = r.prev), !(!n || n !== r) && ("ul" === n.name || "ol" === n.name)
        }, Wz = function (e, o, i, t) {
            function n(e) {
                var t = Ic.fromRangeStart(i), n = Ys(o.getRoot()),
                    r = 1 === e ? n.prev(t) : n.next(t);
                return !r || gz(o, r.getNode()) !== a
            }

            var r = function (e, t, n) {
                    var r = t.serialize(n);
                    return function (e) {
                        var t = e.firstChild, n = e.lastChild;
                        return t && "META" === t.nodeName && t.parentNode.removeChild(t), n && "mce_marker" === n.id && n.parentNode.removeChild(n), e
                    }(e.createFragment(r))
                }(o, e, t), a = gz(o, i.startContainer), u = mz(dz(r.firstChild)),
                c = o.getRoot();
            return n(1) ? vz(a, u, c) : n(2) ? function (e, t, n, r) {
                return r.insertAfter(t.reverse(), e), pz(t[0], n)
            }(a, u, c, o) : function (t, e, n, r) {
                var o = function (e, t) {
                    var n = t.cloneRange(), r = t.cloneRange();
                    return n.setStartBefore(e), r.setEndAfter(e), [n.cloneContents(), r.cloneContents()]
                }(t, r), i = t.parentNode;
                return i.insertBefore(o[0], t), Jn.each(e, function (e) {
                    i.insertBefore(e, t)
                }), i.insertBefore(o[1], t), i.removeChild(t), pz(e[e.length - 1], n)
            }(a, u, c, i)
        }, Kz = function (e, t) {
            return !!gz(e, t)
        }, Xz = en.matchNodeNames(["td", "th"]), Yz = function (e, t) {
            var n = function (e) {
                var t;
                return "string" != typeof e ? (t = Jn.extend({
                    paste: e.paste,
                    data: {paste: e.paste}
                }, e), {content: e.content, details: t}) : {content: e, details: {}}
            }(t);
            bz(e, n.content, n.details)
        }, Gz = function (e) {
            Cx(e, !1) || ox(e, !1) || ax(e, !1) || ux(e, !1) || Jw(e, !1) || hx(e) || Qw(e, !1) || cx(e, !1) || (Cz(e, "Delete"), Xw(e))
        }, Zz = function (e) {
            ox(e, !0) || ax(e, !0) || ux(e, !0) || Jw(e, !0) || hx(e) || Qw(e, !0) || cx(e, !0) || Cz(e, "ForwardDelete")
        }, Jz = {"font-size": "size", "font-family": "face"}, Qz = {
            getFontSize: zz("font-size"), getFontFamily: q(function (e) {
                return e.replace(/[\'\"\\]/g, "").replace(/,\s+/g, ",")
            }, zz("font-family")), toPt: function (e, t) {
                return /[0-9.]+px$/.test(e) ? function (e, t) {
                    var n = Math.pow(10, t);
                    return Math.round(e * n) / n
                }(72 * parseInt(e, 10) / 96, t || 0) + "pt" : e
            }
        }, eE = Jn.each, tE = Jn.map, nE = Jn.inArray,
        rE = (oE.prototype.execCommand = function (t, n, r, e) {
            var o, i, a = !1, u = this;
            if (!u.editor.removed) {
                if (/^(mceAddUndoLevel|mceEndUndoLevel|mceBeginUndoLevel|mceRepaint)$/.test(t) || e && e.skip_focus ? Sd(u.editor) : u.editor.focus(), (e = u.editor.fire("BeforeExecCommand", {
                    command: t,
                    ui: n,
                    value: r
                })).isDefaultPrevented()) return !1;
                if (i = t.toLowerCase(), o = u.commands.exec[i]) return o(i, n, r), u.editor.fire("ExecCommand", {
                    command: t,
                    ui: n,
                    value: r
                }), !0;
                if (eE(this.editor.plugins, function (e) {
                    if (e.execCommand && e.execCommand(t, n, r)) return u.editor.fire("ExecCommand", {
                        command: t,
                        ui: n,
                        value: r
                    }), !(a = !0)
                }), a) return a;
                if (u.editor.theme && u.editor.theme.execCommand && u.editor.theme.execCommand(t, n, r)) return u.editor.fire("ExecCommand", {
                    command: t,
                    ui: n,
                    value: r
                }), !0;
                try {
                    a = u.editor.getDoc().execCommand(t, n, r)
                } catch (c) {
                }
                return !!a && (u.editor.fire("ExecCommand", {
                    command: t,
                    ui: n,
                    value: r
                }), !0)
            }
        }, oE.prototype.queryCommandState = function (e) {
            var t;
            if (!this.editor.quirks.isHidden() && !this.editor.removed) {
                if (e = e.toLowerCase(), t = this.commands.state[e]) return t(e);
                try {
                    return this.editor.getDoc().queryCommandState(e)
                } catch (n) {
                }
                return !1
            }
        }, oE.prototype.queryCommandValue = function (e) {
            var t;
            if (!this.editor.quirks.isHidden() && !this.editor.removed) {
                if (e = e.toLowerCase(), t = this.commands.value[e]) return t(e);
                try {
                    return this.editor.getDoc().queryCommandValue(e)
                } catch (n) {
                }
            }
        }, oE.prototype.addCommands = function (e, n) {
            var r = this;
            n = n || "exec", eE(e, function (t, e) {
                eE(e.toLowerCase().split(","), function (e) {
                    r.commands[n][e] = t
                })
            })
        }, oE.prototype.addCommand = function (e, o, i) {
            var a = this;
            e = e.toLowerCase(), this.commands.exec[e] = function (e, t, n, r) {
                return o.call(i || a.editor, t, n, r)
            }
        }, oE.prototype.queryCommandSupported = function (e) {
            if (e = e.toLowerCase(), this.commands.exec[e]) return !0;
            try {
                return this.editor.getDoc().queryCommandSupported(e)
            } catch (t) {
            }
            return !1
        }, oE.prototype.addQueryStateHandler = function (e, t, n) {
            var r = this;
            e = e.toLowerCase(), this.commands.state[e] = function () {
                return t.call(n || r.editor)
            }
        }, oE.prototype.addQueryValueHandler = function (e, t, n) {
            var r = this;
            e = e.toLowerCase(), this.commands.value[e] = function () {
                return t.call(n || r.editor)
            }
        }, oE.prototype.hasCustomCommand = function (e) {
            return e = e.toLowerCase(), !!this.commands.exec[e]
        }, oE.prototype.execNativeCommand = function (e, t, n) {
            return t === undefined && (t = !1), n === undefined && (n = null), this.editor.getDoc().execCommand(e, t, n)
        }, oE.prototype.isFormatMatch = function (e) {
            return this.editor.formatter.match(e)
        }, oE.prototype.toggleFormat = function (e, t) {
            this.editor.formatter.toggle(e, t ? {value: t} : undefined), this.editor.nodeChanged()
        }, oE.prototype.storeSelection = function (e) {
            this.selectionBookmark = this.editor.selection.getBookmark(e)
        }, oE.prototype.restoreSelection = function () {
            this.editor.selection.moveToBookmark(this.selectionBookmark)
        }, oE.prototype.setupCommands = function (i) {
            var a = this;

            function e(n) {
                return function () {
                    var e = i.selection.isCollapsed() ? [i.dom.getParent(i.selection.getNode(), i.dom.isBlock)] : i.selection.getSelectedBlocks(),
                        t = tE(e, function (e) {
                            return !!i.formatter.matchNode(e, n)
                        });
                    return -1 !== nE(t, !0)
                }
            }

            this.addCommands({
                "mceResetDesignMode,mceBeginUndoLevel": function () {
                },
                "mceEndUndoLevel,mceAddUndoLevel": function () {
                    i.undoManager.add()
                },
                "Cut,Copy,Paste": function (e) {
                    var t, n = i.getDoc();
                    try {
                        a.execNativeCommand(e)
                    } catch (o) {
                        t = !0
                    }
                    if ("paste" !== e || n.queryCommandEnabled(e) || (t = !0), t || !n.queryCommandSupported(e)) {
                        var r = i.translate("Your browser doesn't support direct access to the clipboard. Please use the Ctrl+X/C/V keyboard shortcuts instead.");
                        Kn.mac && (r = r.replace(/Ctrl\+/g, "\u2318+")), i.notificationManager.open({
                            text: r,
                            type: "error"
                        })
                    }
                },
                unlink: function () {
                    if (i.selection.isCollapsed()) {
                        var e = i.dom.getParent(i.selection.getStart(), "a");
                        e && i.dom.remove(e, !0)
                    } else i.formatter.remove("link")
                },
                "JustifyLeft,JustifyCenter,JustifyRight,JustifyFull,JustifyNone": function (e) {
                    var t = e.substring(7);
                    "full" === t && (t = "justify"), eE("left,center,right,justify".split(","), function (e) {
                        t !== e && i.formatter.remove("align" + e)
                    }), "none" !== t && a.toggleFormat("align" + t)
                },
                "InsertUnorderedList,InsertOrderedList": function (e) {
                    var t, n;
                    a.execNativeCommand(e), (t = i.dom.getParent(i.selection.getNode(), "ol,ul")) && (n = t.parentNode, /^(H[1-6]|P|ADDRESS|PRE)$/.test(n.nodeName) && (a.storeSelection(), i.dom.split(n, t), a.restoreSelection()))
                },
                "Bold,Italic,Underline,Strikethrough,Superscript,Subscript": function (e) {
                    a.toggleFormat(e)
                },
                "ForeColor,HiliteColor": function (e, t, n) {
                    a.toggleFormat(e, n)
                },
                FontName: function (e, t, n) {
                    kz(i, n)
                },
                FontSize: function (e, t, n) {
                    !function (e, t) {
                        e.formatter.toggle("fontsize", {value: Sz(e, t)}), e.nodeChanged()
                    }(i, n)
                },
                RemoveFormat: function (e) {
                    i.formatter.remove(e)
                },
                mceBlockQuote: function () {
                    a.toggleFormat("blockquote")
                },
                FormatBlock: function (e, t, n) {
                    return a.toggleFormat(n || "p")
                },
                mceCleanup: function () {
                    var e = i.selection.getBookmark();
                    i.setContent(i.getContent()), i.selection.moveToBookmark(e)
                },
                mceRemoveNode: function (e, t, n) {
                    var r = n || i.selection.getNode();
                    r !== i.getBody() && (a.storeSelection(), i.dom.remove(r, !0), a.restoreSelection())
                },
                mceSelectNodeDepth: function (e, t, n) {
                    var r = 0;
                    i.dom.getParent(i.selection.getNode(), function (e) {
                        if (1 === e.nodeType && r++ === n) return i.selection.select(e), !1
                    }, i.getBody())
                },
                mceSelectNode: function (e, t, n) {
                    i.selection.select(n)
                },
                mceInsertContent: function (e, t, n) {
                    Yz(i, n)
                },
                mceInsertRawHTML: function (e, t, n) {
                    i.selection.setContent("tiny_mce_marker");
                    var r = i.getContent();
                    i.setContent(r.replace(/tiny_mce_marker/g, function () {
                        return n
                    }))
                },
                mceInsertNewLine: function (e, t, n) {
                    Hx(i, n)
                },
                mceToggleFormat: function (e, t, n) {
                    a.toggleFormat(n)
                },
                mceSetContent: function (e, t, n) {
                    i.setContent(n)
                },
                "Indent,Outdent": function (e) {
                    _C(i, e)
                },
                mceRepaint: function () {
                },
                InsertHorizontalRule: function () {
                    i.execCommand("mceInsertContent", !1, "<hr />")
                },
                mceToggleVisualAid: function () {
                    i.hasVisual = !i.hasVisual, i.addVisual()
                },
                mceReplaceContent: function (e, t, n) {
                    i.execCommand("mceInsertContent", !1, n.replace(/\{\$selection\}/g, i.selection.getContent({format: "text"})))
                },
                mceInsertLink: function (e, t, n) {
                    var r;
                    "string" == typeof n && (n = {href: n}), r = i.dom.getParent(i.selection.getNode(), "a"), n.href = n.href.replace(/ /g, "%20"), r && n.href || i.formatter.remove("link"), n.href && i.formatter.apply("link", n, r)
                },
                selectAll: function () {
                    var e = i.dom.getParent(i.selection.getStart(), en.isContentEditableTrue);
                    if (e) {
                        var t = i.dom.createRng();
                        t.selectNodeContents(e), i.selection.setRng(t)
                    }
                },
                "delete": function () {
                    Gz(i)
                },
                forwardDelete: function () {
                    Zz(i)
                },
                mceNewDocument: function () {
                    i.setContent("")
                },
                InsertLineBreak: function (e, t, n) {
                    return Mx(i, n), !0
                }
            }), a.addCommands({
                JustifyLeft: e("alignleft"),
                JustifyCenter: e("aligncenter"),
                JustifyRight: e("alignright"),
                JustifyFull: e("alignjustify"),
                "Bold,Italic,Underline,Strikethrough,Superscript,Subscript": function (e) {
                    return a.isFormatMatch(e)
                },
                mceBlockQuote: function () {
                    return a.isFormatMatch("blockquote")
                },
                Outdent: function () {
                    return RC(i)
                },
                "InsertUnorderedList,InsertOrderedList": function (e) {
                    var t = i.dom.getParent(i.selection.getNode(), "ul,ol");
                    return t && ("insertunorderedlist" === e && "UL" === t.tagName || "insertorderedlist" === e && "OL" === t.tagName)
                }
            }, "state"), a.addCommands({
                Undo: function () {
                    i.undoManager.undo()
                }, Redo: function () {
                    i.undoManager.redo()
                }
            }), a.addQueryValueHandler("FontName", function () {
                return function (t) {
                    return Nz(t).fold(function () {
                        return Ez(t).map(function (e) {
                            return Qz.getFontFamily(t.getBody(), e)
                        }).getOr("")
                    }, function (e) {
                        return Qz.getFontFamily(t.getBody(), e)
                    })
                }(i)
            }, this), a.addQueryValueHandler("FontSize", function () {
                return function (t) {
                    return Nz(t).fold(function () {
                        return Ez(t).map(function (e) {
                            return Qz.getFontSize(t.getBody(), e)
                        }).getOr("")
                    }, function (e) {
                        return Qz.getFontSize(t.getBody(), e)
                    })
                }(i)
            }, this)
        }, oE);

    function oE(e) {
        this.commands = {
            state: {},
            exec: {},
            value: {}
        }, this.editor = e, this.setupCommands(e)
    }

    var iE = Jn.makeMap("focus blur focusin focusout click dblclick mousedown mouseup mousemove mouseover beforepaste paste cut copy selectionchange mouseout mouseenter mouseleave wheel keydown keypress keyup input beforeinput contextmenu dragstart dragend dragover draggesture dragdrop drop drag submit compositionstart compositionend compositionupdate touchstart touchmove touchend touchcancel", " "),
        aE = (uE.isNative = function (e) {
            return !!iE[e.toLowerCase()]
        }, uE.prototype.fire = function (e, t) {
            var n, r, o, i;
            if (e = e.toLowerCase(), (t = t || {}).type = e, t.target || (t.target = this.scope), t.preventDefault || (t.preventDefault = function () {
                t.isDefaultPrevented = a
            }, t.stopPropagation = function () {
                t.isPropagationStopped = a
            }, t.stopImmediatePropagation = function () {
                t.isImmediatePropagationStopped = a
            }, t.isDefaultPrevented = s, t.isPropagationStopped = s, t.isImmediatePropagationStopped = s), this.settings.beforeFire && this.settings.beforeFire(t), n = this.bindings[e]) for (r = 0, o = n.length; r < o; r++) {
                if ((i = n[r]).once && this.off(e, i.func), t.isImmediatePropagationStopped()) return t.stopPropagation(), t;
                if (!1 === i.func.call(this.scope, t)) return t.preventDefault(), t
            }
            return t
        }, uE.prototype.on = function (e, t, n, r) {
            var o, i, a;
            if (!1 === t && (t = s), t) {
                var u = {func: t};
                for (r && Jn.extend(u, r), a = (i = e.toLowerCase().split(" ")).length; a--;) e = i[a], (o = this.bindings[e]) || (o = this.bindings[e] = [], this.toggleEvent(e, !0)), n ? o.unshift(u) : o.push(u)
            }
            return this
        }, uE.prototype.off = function (e, t) {
            var n, r, o, i, a;
            if (e) for (n = (i = e.toLowerCase().split(" ")).length; n--;) {
                if (e = i[n], r = this.bindings[e], !e) {
                    for (o in this.bindings) this.toggleEvent(o, !1), delete this.bindings[o];
                    return this
                }
                if (r) {
                    if (t) for (a = r.length; a--;) r[a].func === t && (r = r.slice(0, a).concat(r.slice(a + 1)), this.bindings[e] = r); else r.length = 0;
                    r.length || (this.toggleEvent(e, !1), delete this.bindings[e])
                }
            } else {
                for (e in this.bindings) this.toggleEvent(e, !1);
                this.bindings = {}
            }
            return this
        }, uE.prototype.once = function (e, t, n) {
            return this.on(e, t, n, {once: !0})
        }, uE.prototype.has = function (e) {
            return e = e.toLowerCase(), !(!this.bindings[e] || 0 === this.bindings[e].length)
        }, uE);

    function uE(e) {
        this.bindings = {}, this.settings = e || {}, this.scope = this.settings.scope || this, this.toggleEvent = this.settings.toggleEvent || s
    }

    function cE(n) {
        return n._eventDispatcher || (n._eventDispatcher = new aE({
            scope: n,
            toggleEvent: function (e, t) {
                aE.isNative(e) && n.toggleNativeEvent && n.toggleNativeEvent(e, t)
            }
        })), n._eventDispatcher
    }

    function sE(e, t, n) {
        Ca(e, t) && !1 === n ? function (e, t) {
            ga(e) ? e.dom().classList.remove(t) : va(e, t);
            ba(e)
        }(e, t) : n && ya(e, t)
    }

    function lE(e, t, n) {
        try {
            e.getDoc().execCommand(t, !1, n)
        } catch (r) {
        }
    }

    function fE(e, t) {
        e.dom().contentEditable = t ? "true" : "false"
    }

    function dE(e, t) {
        var n = at.fromDom(e.getBody());
        sE(n, "mce-content-readonly", t), t ? (e.selection.controlSelection.hideResizeRect(), e._selectionOverrides.hideFakeCaret(), function (e) {
            D.from(e.selection.getNode()).each(function (e) {
                e.removeAttribute("data-mce-selected")
            })
        }(e), e.readonly = !0, fE(n, !1), function (e) {
            U(wa(e, '*[contenteditable="true"]'), function (e) {
                tn(e, xE, "true"), fE(e, !1)
            })
        }(n)) : (e.readonly = !1, fE(n, !0), function (e) {
            U(wa(e, "*[" + xE + '="true"]'), function (e) {
                Ge(e, xE), fE(e, !0)
            })
        }(n), lE(e, "StyleWithCSS", !1), lE(e, "enableInlineTableEditing", !1), lE(e, "enableObjectResizing", !1), Pd(e) && e.focus(), function (e) {
            e.selection.setRng(e.selection.getRng())
        }(e), e.nodeChanged())
    }

    function hE(e) {
        return e.readonly
    }

    function mE(t) {
        t.parser.addAttributeFilter("contenteditable", function (e) {
            hE(t) && U(e, function (e) {
                e.attr(xE, e.attr("contenteditable")), e.attr("contenteditable", "false")
            })
        }), t.serializer.addAttributeFilter(xE, function (e) {
            hE(t) && U(e, function (e) {
                e.attr("contenteditable", e.attr(xE))
            })
        }), t.serializer.addTempAttr(xE)
    }

    function gE(e, t) {
        return "selectionchange" === t ? e.getDoc() : !e.inline && /^mouse|touch|click|contextmenu|drop|dragover|dragend/.test(t) ? e.getDoc().documentElement : e.settings.event_root ? (e.eventRoot || (e.eventRoot = zE.select(e.settings.event_root)[0]), e.eventRoot) : e.getBody()
    }

    function pE(e, t, n) {
        !function (e) {
            return !e.hidden && !hE(e)
        }(e) ? hE(e) && function (e, t) {
            var n = t.target;
            !function (e) {
                return "click" === e.type
            }(t) || ph.metaKeyPressed(t) || !function (e, t) {
                return null !== e.dom.getParent(t, "a")
            }(e, n) || t.preventDefault()
        }(e, n) : e.fire(t, n)
    }

    function vE(i, a) {
        var e, t;
        if (i.delegates || (i.delegates = {}), !i.delegates[a] && !i.removed) if (e = gE(i, a), i.settings.event_root) {
            if (CE || (CE = {}, i.editorManager.on("removeEditor", function () {
                var e;
                if (!i.editorManager.activeEditor && CE) {
                    for (e in CE) i.dom.unbind(gE(i, e));
                    CE = null
                }
            })), CE[a]) return;
            t = function (e) {
                for (var t = e.target, n = i.editorManager.get(), r = n.length; r--;) {
                    var o = n[r].getBody();
                    o !== t && !zE.isChildOf(t, o) || pE(n[r], a, e)
                }
            }, CE[a] = t, zE.bind(e, a, t)
        } else t = function (e) {
            pE(i, a, e)
        }, zE.bind(e, a, t), i.delegates[a] = t
    }

    function yE(e, t, n, r) {
        var o = n[t.get()], i = n[r];
        try {
            i.activate()
        } catch (VN) {
            return void j.console.error("problem while activating editor mode " + r + ":", VN)
        }
        o.deactivate(), o.editorReadOnly !== i.editorReadOnly && dE(e, i.editorReadOnly), t.set(r), function (e, t) {
            e.fire("SwitchMode", {mode: t})
        }(e, r)
    }

    function bE(t) {
        var n = ut("design"), r = ut({
            design: {activate: u, deactivate: u, editorReadOnly: !1},
            readonly: {activate: u, deactivate: u, editorReadOnly: !0}
        });
        return function (e) {
            e.serializer ? mE(e) : e.on("PreInit", function () {
                mE(e)
            })
        }(t), function (t) {
            t.on("ShowCaret", function (e) {
                hE(t) && e.preventDefault()
            }), t.on("ObjectSelected", function (e) {
                hE(t) && e.preventDefault()
            })
        }(t), {
            isReadOnly: function () {
                return hE(t)
            }, set: function (e) {
                return function (e, t, n, r) {
                    if (r !== n.get()) {
                        if (!te(t, r)) throw new Error("Editor mode '" + r + "' is invalid");
                        e.initialized ? yE(e, n, t, r) : e.on("init", function () {
                            return yE(e, n, t, r)
                        })
                    }
                }(t, r.get(), n, e)
            }, get: function () {
                return n.get()
            }, register: function (e, t) {
                r.set(function (e, t, n) {
                    var r;
                    if (h(NE, t)) throw new Error("Cannot override default mode " + t);
                    return ne(ne({}, e), ((r = {})[t] = ne(ne({}, n), {
                        deactivate: function () {
                            try {
                                n.deactivate()
                            } catch (VN) {
                                j.console.error("problem while deactivating editor mode " + t + ":", VN)
                            }
                        }
                    }), r))
                }(r.get(), e, t))
            }
        }
    }

    var CE, wE = {
            fire: function (e, t, n) {
                if (this.removed && "remove" !== e && "detach" !== e) return t;
                var r = cE(this).fire(e, t);
                if (!1 !== n && this.parent) for (var o = this.parent(); o && !r.isPropagationStopped();) o.fire(e, r, !1), o = o.parent();
                return r
            }, on: function (e, t, n) {
                return cE(this).on(e, t, n)
            }, off: function (e, t) {
                return cE(this).off(e, t)
            }, once: function (e, t) {
                return cE(this).once(e, t)
            }, hasEventListeners: function (e) {
                return cE(this).has(e)
            }
        }, xE = "data-mce-contenteditable", zE = ea.DOM, EE = ne(ne({}, wE), {
            bindPendingEventDelegates: function () {
                var t = this;
                Jn.each(t._pendingNativeEvents, function (e) {
                    vE(t, e)
                })
            }, toggleNativeEvent: function (e, t) {
                var n = this;
                "focus" !== e && "blur" !== e && (t ? n.initialized ? vE(n, e) : n._pendingNativeEvents ? n._pendingNativeEvents.push(e) : n._pendingNativeEvents = [e] : n.initialized && (n.dom.unbind(gE(n, e), e, n.delegates[e]), delete n.delegates[e]))
            }, unbindAllNativeEvents: function () {
                var e, t = this, n = t.getBody(), r = t.dom;
                if (t.delegates) {
                    for (e in t.delegates) t.dom.unbind(gE(t, e), e, t.delegates[e]);
                    delete t.delegates
                }
                !t.inline && n && r && (n.onload = null, r.unbind(t.getWin()), r.unbind(t.getDoc())), r && (r.unbind(n), r.unbind(t.getContainer()))
            }
        }), NE = ["design", "readonly"], SE = Jn.each, kE = Jn.explode, TE = {
            f1: 112,
            f2: 113,
            f3: 114,
            f4: 115,
            f5: 116,
            f6: 117,
            f7: 118,
            f8: 119,
            f9: 120,
            f10: 121,
            f11: 122,
            f12: 123
        }, AE = Jn.makeMap("alt,ctrl,shift,meta,access"),
        ME = (RE.prototype.add = function (e, n, r, o) {
            var t, i = this;
            return "string" == typeof (t = r) ? r = function () {
                i.editor.execCommand(t, !1, null)
            } : Jn.isArray(t) && (r = function () {
                i.editor.execCommand(t[0], t[1], t[2])
            }), SE(kE(Jn.trim(e)), function (e) {
                var t = i.createShortcut(e, n, r, o);
                i.shortcuts[t.id] = t
            }), !0
        }, RE.prototype.remove = function (e) {
            var t = this.createShortcut(e);
            return !!this.shortcuts[t.id] && (delete this.shortcuts[t.id], !0)
        }, RE.prototype.parseShortcut = function (e) {
            var t, n, r = {};
            for (n in SE(kE(e.toLowerCase(), "+"), function (e) {
                e in AE ? r[e] = !0 : /^[0-9]{2,}$/.test(e) ? r.keyCode = parseInt(e, 10) : (r.charCode = e.charCodeAt(0), r.keyCode = TE[e] || e.toUpperCase().charCodeAt(0))
            }), t = [r.keyCode], AE) r[n] ? t.push(n) : r[n] = !1;
            return r.id = t.join(","), r.access && (r.alt = !0, Kn.mac ? r.ctrl = !0 : r.shift = !0), r.meta && (Kn.mac ? r.meta = !0 : (r.ctrl = !0, r.meta = !1)), r
        }, RE.prototype.createShortcut = function (e, t, n, r) {
            var o;
            return (o = Jn.map(kE(e, ">"), this.parseShortcut))[o.length - 1] = Jn.extend(o[o.length - 1], {
                func: n,
                scope: r || this.editor
            }), Jn.extend(o[0], {
                desc: this.editor.translate(t),
                subpatterns: o.slice(1)
            })
        }, RE.prototype.hasModifier = function (e) {
            return e.altKey || e.ctrlKey || e.metaKey
        }, RE.prototype.isFunctionKey = function (e) {
            return "keydown" === e.type && 112 <= e.keyCode && e.keyCode <= 123
        }, RE.prototype.matchShortcut = function (e, t) {
            return !!t && t.ctrl === e.ctrlKey && t.meta === e.metaKey && t.alt === e.altKey && t.shift === e.shiftKey && !!(e.keyCode === t.keyCode || e.charCode && e.charCode === t.charCode) && (e.preventDefault(), !0)
        }, RE.prototype.executeShortcutAction = function (e) {
            return e.func ? e.func.call(e.scope) : null
        }, RE);

    function RE(e) {
        this.shortcuts = {}, this.pendingPatterns = [], this.editor = e;
        var n = this;
        e.on("keyup keypress keydown", function (t) {
            !n.hasModifier(t) && !n.isFunctionKey(t) || t.isDefaultPrevented() || (SE(n.shortcuts, function (e) {
                if (n.matchShortcut(t, e)) return n.pendingPatterns = e.subpatterns.slice(0), "keydown" === t.type && n.executeShortcutAction(e), !0
            }), n.matchShortcut(t, n.pendingPatterns[0]) && (1 === n.pendingPatterns.length && "keydown" === t.type && n.executeShortcutAction(n.pendingPatterns[0]), n.pendingPatterns.shift()))
        })
    }

    function DE() {
        var e = function () {
            function e(n, r) {
                return function (e, t) {
                    return n[e.toLowerCase()] = ne(ne({}, t), {type: r})
                }
            }

            var t = {}, n = {}, r = {}, o = {}, i = {}, a = {}, u = {};
            return {
                addButton: e(t, "button"),
                addGroupToolbarButton: e(t, "grouptoolbarbutton"),
                addToggleButton: e(t, "togglebutton"),
                addMenuButton: e(t, "menubutton"),
                addSplitButton: e(t, "splitbutton"),
                addMenuItem: e(n, "menuitem"),
                addNestedMenuItem: e(n, "nestedmenuitem"),
                addToggleMenuItem: e(n, "togglemenuitem"),
                addAutocompleter: e(r, "autocompleter"),
                addContextMenu: e(i, "contextmenu"),
                addContextToolbar: e(a, "contexttoolbar"),
                addContextForm: e(a, "contextform"),
                addSidebar: e(u, "sidebar"),
                addIcon: function (e, t) {
                    return o[e.toLowerCase()] = t
                },
                getAll: function () {
                    return {
                        buttons: t,
                        menuItems: n,
                        icons: o,
                        popups: r,
                        contextMenus: i,
                        contextToolbars: a,
                        sidebars: u
                    }
                }
            }
        }();
        return {
            addAutocompleter: e.addAutocompleter,
            addButton: e.addButton,
            addContextForm: e.addContextForm,
            addContextMenu: e.addContextMenu,
            addContextToolbar: e.addContextToolbar,
            addIcon: e.addIcon,
            addMenuButton: e.addMenuButton,
            addMenuItem: e.addMenuItem,
            addNestedMenuItem: e.addNestedMenuItem,
            addSidebar: e.addSidebar,
            addSplitButton: e.addSplitButton,
            addToggleButton: e.addToggleButton,
            addGroupToolbarButton: e.addGroupToolbarButton,
            addToggleMenuItem: e.addToggleMenuItem,
            getAll: e.getAll
        }
    }

    var _E = Jn.each, OE = Jn.trim,
        HE = "source protocol authority userInfo user password host port relative path directory file query anchor".split(" "),
        BE = {ftp: 21, http: 80, https: 443, mailto: 25},
        PE = (LE.parseDataUri = function (e) {
            var t, n = decodeURIComponent(e).split(","),
                r = /data:([^;]+)/.exec(n[0]);
            return r && (t = r[1]), {type: t, data: n[1]}
        }, LE.getDocumentBaseUrl = function (e) {
            var t;
            return t = 0 !== e.protocol.indexOf("http") && "file:" !== e.protocol ? e.href : e.protocol + "//" + e.host + e.pathname, /^[^:]+:\/\/\/?[^\/]+\//.test(t) && (t = t.replace(/[\?#].*$/, "").replace(/[\/\\][^\/]+$/, ""), /[\/\\]$/.test(t) || (t += "/")), t
        }, LE.prototype.setPath = function (e) {
            var t = /^(.*?)\/?(\w+)?$/.exec(e);
            this.path = t[0], this.directory = t[1], this.file = t[2], this.source = "", this.getURI()
        }, LE.prototype.toRelative = function (e) {
            var t;
            if ("./" === e) return e;
            var n = new LE(e, {base_uri: this});
            if ("mce_host" !== n.host && this.host !== n.host && n.host || this.port !== n.port || this.protocol !== n.protocol && "" !== n.protocol) return n.getURI();
            var r = this.getURI(), o = n.getURI();
            return r === o || "/" === r.charAt(r.length - 1) && r.substr(0, r.length - 1) === o ? r : (t = this.toRelPath(this.path, n.path), n.query && (t += "?" + n.query), n.anchor && (t += "#" + n.anchor), t)
        }, LE.prototype.toAbsolute = function (e, t) {
            var n = new LE(e, {base_uri: this});
            return n.getURI(t && this.isSameOrigin(n))
        }, LE.prototype.isSameOrigin = function (e) {
            if (this.host == e.host && this.protocol == e.protocol) {
                if (this.port == e.port) return !0;
                var t = BE[this.protocol];
                if (t && (this.port || t) == (e.port || t)) return !0
            }
            return !1
        }, LE.prototype.toRelPath = function (e, t) {
            var n, r, o, i = 0, a = "",
                u = e.substring(0, e.lastIndexOf("/")).split("/");
            if (n = t.split("/"), u.length >= n.length) for (r = 0, o = u.length; r < o; r++) if (r >= n.length || u[r] !== n[r]) {
                i = r + 1;
                break
            }
            if (u.length < n.length) for (r = 0, o = n.length; r < o; r++) if (r >= u.length || u[r] !== n[r]) {
                i = r + 1;
                break
            }
            if (1 === i) return t;
            for (r = 0, o = u.length - (i - 1); r < o; r++) a += "../";
            for (r = i - 1, o = n.length; r < o; r++) a += r !== i - 1 ? "/" + n[r] : n[r];
            return a
        }, LE.prototype.toAbsPath = function (e, t) {
            var n, r, o, i = 0, a = [];
            r = /\/$/.test(t) ? "/" : "";
            var u = e.split("/"), c = t.split("/");
            for (_E(u, function (e) {
                e && a.push(e)
            }), u = a, n = c.length - 1, a = []; 0 <= n; n--) 0 !== c[n].length && "." !== c[n] && (".." !== c[n] ? 0 < i ? i-- : a.push(c[n]) : i++);
            return 0 !== (o = (n = u.length - i) <= 0 ? w(a).join("/") : u.slice(0, n).join("/") + "/" + w(a).join("/")).indexOf("/") && (o = "/" + o), r && o.lastIndexOf("/") !== o.length - 1 && (o += r), o
        }, LE.prototype.getURI = function (e) {
            var t;
            return void 0 === e && (e = !1), this.source && !e || (t = "", e || (this.protocol ? t += this.protocol + "://" : t += "//", this.userInfo && (t += this.userInfo + "@"), this.host && (t += this.host), this.port && (t += ":" + this.port)), this.path && (t += this.path), this.query && (t += "?" + this.query), this.anchor && (t += "#" + this.anchor), this.source = t), this.source
        }, LE);

    function LE(e, t) {
        e = OE(e), this.settings = t || {};
        var n = this.settings.base_uri, r = this;
        if (/^([\w\-]+):([^\/]{2})/i.test(e) || /^\s*#/.test(e)) r.source = e; else {
            var o = 0 === e.indexOf("//");
            if (0 !== e.indexOf("/") || o || (e = (n && n.protocol || "http") + "://mce_host" + e), !/^[\w\-]*:?\/\//.test(e)) {
                var i = this.settings.base_uri ? this.settings.base_uri.path : new LE(j.document.location.href).directory;
                if (this.settings.base_uri && "" == this.settings.base_uri.protocol) e = "//mce_host" + r.toAbsPath(i, e); else {
                    var a = /([^#?]*)([#?]?.*)/.exec(e);
                    e = (n && n.protocol || "http") + "://mce_host" + r.toAbsPath(i, a[1]) + a[2]
                }
            }
            e = e.replace(/@@/g, "(mce_at)");
            var u = /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@\/]*):?([^:@\/]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/.exec(e);
            _E(HE, function (e, t) {
                var n = u[t];
                n = n && n.replace(/\(mce_at\)/g, "@@"), r[e] = n
            }), n && (r.protocol || (r.protocol = n.protocol), r.userInfo || (r.userInfo = n.userInfo), r.port || "mce_host" !== r.host || (r.port = n.port), r.host && "mce_host" !== r.host || (r.host = n.host), r.source = ""), o && (r.protocol = "")
        }
    }

    var VE = ea.DOM, IE = Jn.extend, FE = Jn.each, UE = Jn.resolve, jE = Kn.ie,
        qE = ($E.prototype.render = function () {
            qz(this)
        }, $E.prototype.focus = function (e) {
            Hd(this, e)
        }, $E.prototype.hasFocus = function () {
            return Bd(this)
        }, $E.prototype.execCallback = function (e) {
            for (var t = [], n = 1; n < arguments.length; n++) t[n - 1] = arguments[n];
            var r, o = this.settings[e];
            if (o) return this.callbackLookup && (r = this.callbackLookup[e]) && (o = r.func, r = r.scope), "string" == typeof o && (r = (r = o.replace(/\.\w+$/, "")) ? UE(r) : 0, o = UE(o), this.callbackLookup = this.callbackLookup || {}, this.callbackLookup[e] = {
                func: o,
                scope: r
            }), o.apply(r || this, Array.prototype.slice.call(arguments, 1))
        }, $E.prototype.translate = function (e) {
            return la.translate(e)
        }, $E.prototype.getParam = function (e, t, n) {
            return ud(this, e, t, n)
        }, $E.prototype.nodeChanged = function (e) {
            this._nodeChangeDispatcher.nodeChanged(e)
        }, $E.prototype.addCommand = function (e, t, n) {
            this.editorCommands.addCommand(e, t, n)
        }, $E.prototype.addQueryStateHandler = function (e, t, n) {
            this.editorCommands.addQueryStateHandler(e, t, n)
        }, $E.prototype.addQueryValueHandler = function (e, t, n) {
            this.editorCommands.addQueryValueHandler(e, t, n)
        }, $E.prototype.addShortcut = function (e, t, n, r) {
            this.shortcuts.add(e, t, n, r)
        }, $E.prototype.execCommand = function (e, t, n, r) {
            return this.editorCommands.execCommand(e, t, n, r)
        }, $E.prototype.queryCommandState = function (e) {
            return this.editorCommands.queryCommandState(e)
        }, $E.prototype.queryCommandValue = function (e) {
            return this.editorCommands.queryCommandValue(e)
        }, $E.prototype.queryCommandSupported = function (e) {
            return this.editorCommands.queryCommandSupported(e)
        }, $E.prototype.show = function () {
            this.hidden && (this.hidden = !1, this.inline ? this.getBody().contentEditable = "true" : (VE.show(this.getContainer()), VE.hide(this.id)), this.load(), this.fire("show"))
        }, $E.prototype.hide = function () {
            var e = this, t = e.getDoc();
            e.hidden || (jE && t && !e.inline && t.execCommand("SelectAll"), e.save(), e.inline ? (e.getBody().contentEditable = "false", e === e.editorManager.focusedEditor && (e.editorManager.focusedEditor = null)) : (VE.hide(e.getContainer()), VE.setStyle(e.id, "display", e.orgDisplay)), e.hidden = !0, e.fire("hide"))
        }, $E.prototype.isHidden = function () {
            return !!this.hidden
        }, $E.prototype.setProgressState = function (e, t) {
            this.fire("ProgressState", {state: e, time: t})
        }, $E.prototype.load = function (e) {
            var t, n = this.getElement();
            if (this.removed) return "";
            if (n) {
                (e = e || {}).load = !0;
                var r = en.isTextareaOrInput(n) ? n.value : n.innerHTML;
                return t = this.setContent(r, e), e.element = n, e.no_events || this.fire("LoadContent", e), e.element = n = null, t
            }
        }, $E.prototype.save = function (e) {
            var t, n, r = this, o = r.getElement();
            if (o && r.initialized && !r.removed) return (e = e || {}).save = !0, e.element = o, e.content = r.getContent(e), e.no_events || r.fire("SaveContent", e), "raw" === e.format && r.fire("RawSaveContent", e), t = e.content, en.isTextareaOrInput(o) ? o.value = t : (!e.is_removing && r.inline || (o.innerHTML = t), (n = VE.getParent(r.id, "form")) && FE(n.elements, function (e) {
                if (e.name === r.id) return e.value = t, !1
            })), e.element = o = null, !1 !== e.set_dirty && r.setDirty(!1), t
        }, $E.prototype.setContent = function (e, t) {
            return Gf(this, e, t)
        }, $E.prototype.getContent = function (e) {
            return function (t, n) {
                return void 0 === n && (n = {}), D.from(t.getBody()).fold($("tree" === n.format ? new gf("body", 11) : ""), function (e) {
                    return wf(t, n, e)
                })
            }(this, e)
        }, $E.prototype.insertContent = function (e, t) {
            t && (e = IE({content: e}, t)), this.execCommand("mceInsertContent", !1, e)
        }, $E.prototype.resetContent = function (e) {
            e === undefined ? Gf(this, this.startContent, {format: "raw"}) : Gf(this, e), this.undoManager.reset(), this.setDirty(!1), this.nodeChanged()
        }, $E.prototype.isDirty = function () {
            return !this.isNotDirty
        }, $E.prototype.setDirty = function (e) {
            var t = !this.isNotDirty;
            this.isNotDirty = !e, e && e !== t && this.fire("dirty")
        }, $E.prototype.getContainer = function () {
            return this.container || (this.container = VE.get(this.editorContainer || this.id + "_parent")), this.container
        }, $E.prototype.getContentAreaContainer = function () {
            return this.contentAreaContainer
        }, $E.prototype.getElement = function () {
            return this.targetElm || (this.targetElm = VE.get(this.id)), this.targetElm
        }, $E.prototype.getWin = function () {
            var e;
            return this.contentWindow || (e = this.iframeElement) && (this.contentWindow = e.contentWindow), this.contentWindow
        }, $E.prototype.getDoc = function () {
            var e;
            return this.contentDocument || (e = this.getWin()) && (this.contentDocument = e.document), this.contentDocument
        }, $E.prototype.getBody = function () {
            var e = this.getDoc();
            return this.bodyElement || (e ? e.body : null)
        }, $E.prototype.convertURL = function (e, t, n) {
            var r = this.settings;
            return r.urlconverter_callback ? this.execCallback("urlconverter_callback", e, n, !0, t) : !r.convert_urls || n && "LINK" === n.nodeName || 0 === e.indexOf("file:") || 0 === e.length ? e : r.relative_urls ? this.documentBaseURI.toRelative(e) : e = this.documentBaseURI.toAbsolute(e, r.remove_script_host)
        }, $E.prototype.addVisual = function (e) {
            var n, r = this, o = r.settings, i = r.dom;
            e = e || r.getBody(), r.hasVisual === undefined && (r.hasVisual = o.visual), FE(i.select("table,a", e), function (e) {
                var t;
                switch (e.nodeName) {
                    case"TABLE":
                        return n = o.visual_table_class || "mce-item-table", void ((t = i.getAttrib(e, "border")) && "0" !== t || !r.hasVisual ? i.removeClass(e, n) : i.addClass(e, n));
                    case"A":
                        return void (i.getAttrib(e, "href") || (t = i.getAttrib(e, "name") || e.id, n = o.visual_anchor_class || "mce-item-anchor", t && r.hasVisual ? i.addClass(e, n) : i.removeClass(e, n)))
                }
            }), r.fire("VisualAid", {element: e, hasVisual: r.hasVisual})
        }, $E.prototype.remove = function () {
            Jf(this)
        }, $E.prototype.destroy = function (e) {
            Qf(this, e)
        }, $E.prototype.uploadImages = function (e) {
            return this.editorUpload.uploadImages(e)
        }, $E.prototype._scanForImages = function () {
            return this.editorUpload.scanForImages()
        }, $E.prototype.addButton = function () {
            throw new Error("editor.addButton has been removed in tinymce 5x, use editor.ui.registry.addButton or editor.ui.registry.addToggleButton or editor.ui.registry.addSplitButton instead")
        }, $E.prototype.addSidebar = function () {
            throw new Error("editor.addSidebar has been removed in tinymce 5x, use editor.ui.registry.addSidebar instead")
        }, $E.prototype.addMenuItem = function () {
            throw new Error("editor.addMenuItem has been removed in tinymce 5x, use editor.ui.registry.addMenuItem instead")
        }, $E.prototype.addContextToolbar = function () {
            throw new Error("editor.addContextToolbar has been removed in tinymce 5x, use editor.ui.registry.addContextToolbar instead")
        }, $E);

    function $E(e, t, n) {
        var r = this;
        this.plugins = {}, this.contentCSS = [], this.contentStyles = [], this.loadedCSS = {}, this.isNotDirty = !1, this.editorManager = n, this.documentBaseUrl = n.documentBaseURL, IE(this, EE), this.settings = id(this, e, this.documentBaseUrl, n.defaultSettings, t), this.settings.suffix && (n.suffix = this.settings.suffix), this.suffix = n.suffix, this.settings.base_url && n._setBaseUrl(this.settings.base_url), this.baseUri = n.baseURI, this.settings.referrer_policy && (oa.ScriptLoader._setReferrerPolicy(this.settings.referrer_policy), ea.DOM.styleSheetLoader._setReferrerPolicy(this.settings.referrer_policy)), xa.languageLoad = this.settings.language_load, xa.baseURL = n.baseURL, this.id = e, this.setDirty(!1), this.documentBaseURI = new PE(this.settings.document_base_url, {base_uri: this.baseUri}), this.baseURI = this.baseUri, this.inline = !!this.settings.inline, this.shortcuts = new ME(this), this.editorCommands = new rE(this), this.settings.cache_suffix && (Kn.cacheSuffix = this.settings.cache_suffix.replace(/^[\?\&]+/, "")), this.ui = {registry: DE()};
        var o = bE(this);
        this.mode = o, this.setMode = o.set, n.fire("SetupEditor", {editor: this}), this.execCallback("setup", this), this.$ = Fi.overrideDefaults(function () {
            return {
                context: r.inline ? r.getBody() : r.getDoc(),
                element: r.getBody()
            }
        })
    }

    function WE(t) {
        var n = t.type;
        QE(aN.get(), function (e) {
            switch (n) {
                case"scroll":
                    e.fire("ScrollWindow", t);
                    break;
                case"resize":
                    e.fire("ResizeWindow", t)
            }
        })
    }

    function KE(e) {
        e !== nN && (e ? Fi(window).on("resize scroll", WE) : Fi(window).off("resize scroll", WE), nN = e)
    }

    function XE(t) {
        var e = oN;
        delete rN[t.id];
        for (var n = 0; n < rN.length; n++) if (rN[n] === t) {
            rN.splice(n, 1);
            break
        }
        return oN = G(oN, function (e) {
            return t !== e
        }), aN.activeEditor === t && (aN.activeEditor = 0 < oN.length ? oN[0] : null), aN.focusedEditor === t && (aN.focusedEditor = null), e.length !== oN.length
    }

    var YE, GE, ZE = ea.DOM, JE = Jn.explode, QE = Jn.each, eN = Jn.extend,
        tN = 0, nN = !1, rN = [], oN = [],
        iN = "CSS1Compat" !== j.document.compatMode, aN = ne(ne({}, wE), {
            baseURI: null,
            baseURL: null,
            defaultSettings: {},
            documentBaseURL: null,
            suffix: null,
            $: Fi,
            majorVersion: "5",
            minorVersion: "2.1",
            releaseDate: "2020-03-25",
            editors: rN,
            i18n: la,
            activeEditor: null,
            focusedEditor: null,
            settings: {},
            setup: function () {
                var e, t, n = "";
                t = PE.getDocumentBaseUrl(j.document.location), /^[^:]+:\/\/\/?[^\/]+\//.test(t) && (t = t.replace(/[\?#].*$/, "").replace(/[\/\\][^\/]+$/, ""), /[\/\\]$/.test(t) || (t += "/"));
                var r = window.tinymce || window.tinyMCEPreInit;
                if (r) e = r.base || r.baseURL, n = r.suffix; else {
                    for (var o = j.document.getElementsByTagName("script"), i = 0; i < o.length; i++) {
                        var a;
                        if ("" !== (a = o[i].src || "")) {
                            var u = a.substring(a.lastIndexOf("/"));
                            if (/tinymce(\.full|\.jquery|)(\.min|\.dev|)\.js/.test(a)) {
                                -1 !== u.indexOf(".min") && (n = ".min"), e = a.substring(0, a.lastIndexOf("/"));
                                break
                            }
                        }
                    }
                    if (!e && j.document.currentScript) -1 !== (a = j.document.currentScript.src).indexOf(".min") && (n = ".min"), e = a.substring(0, a.lastIndexOf("/"))
                }
                this.baseURL = new PE(t).toAbsolute(e), this.documentBaseURL = t, this.baseURI = new PE(this.baseURL), this.suffix = n, Rd(this)
            },
            overrideDefaults: function (e) {
                var t, n;
                (t = e.base_url) && this._setBaseUrl(t), n = e.suffix, e.suffix && (this.suffix = n);
                var r = (this.defaultSettings = e).plugin_base_urls;
                for (var o in r) xa.PluginManager.urls[o] = r[o]
            },
            init: function (r) {
                var n, u, c = this;
                u = Jn.makeMap("area base basefont br col frame hr img input isindex link meta param embed source wbr track colgroup option table tbody tfoot thead tr th td script noscript style textarea video audio iframe object menu", " ");

                function s(e) {
                    var t = e.id;
                    return t || (t = (t = e.name) && !ZE.get(t) ? e.name : ZE.uniqueId(), e.setAttribute("id", t)), t
                }

                function l(e, t) {
                    return t.constructor === RegExp ? t.test(e.className) : ZE.hasClass(e, t)
                }

                var f = function (e) {
                    n = e
                }, e = function () {
                    function n(e, t, n) {
                        var r = new qE(e, t, c);
                        a.push(r), r.on("init", function () {
                            ++i === o.length && f(a)
                        }), r.targetElm = r.targetElm || n, r.render()
                    }

                    var o, i = 0, a = [];
                    ZE.unbind(window, "ready", e), function (e) {
                        var t = r[e];
                        if (t) t.apply(c, Array.prototype.slice.call(arguments, 2))
                    }("onpageload"), o = Fi.unique(function (t) {
                        var e, n = [];
                        if (Kn.browser.isIE() && Kn.browser.version.major < 11) return fh.initError("TinyMCE does not support the browser you are using. For a list of supported browsers please see: https://www.tinymce.com/docs/get-started/system-requirements/"), [];
                        if (iN) return fh.initError("Failed to initialize the editor as the document is not in standards mode. TinyMCE requires standards mode."), [];
                        if (t.types) return QE(t.types, function (e) {
                            n = n.concat(ZE.select(e.selector))
                        }), n;
                        if (t.selector) return ZE.select(t.selector);
                        if (t.target) return [t.target];
                        switch (t.mode) {
                            case"exact":
                                0 < (e = t.elements || "").length && QE(JE(e), function (t) {
                                    var e;
                                    (e = ZE.get(t)) ? n.push(e) : QE(j.document.forms, function (e) {
                                        QE(e.elements, function (e) {
                                            e.name === t && (t = "mce_editor_" + tN++, ZE.setAttrib(e, "id", t), n.push(e))
                                        })
                                    })
                                });
                                break;
                            case"textareas":
                            case"specific_textareas":
                                QE(ZE.select("textarea"), function (e) {
                                    t.editor_deselector && l(e, t.editor_deselector) || t.editor_selector && !l(e, t.editor_selector) || n.push(e)
                                })
                        }
                        return n
                    }(r)), r.types ? QE(r.types, function (t) {
                        Jn.each(o, function (e) {
                            return !ZE.is(e, t.selector) || (n(s(e), eN({}, r, t), e), !1)
                        })
                    }) : (Jn.each(o, function (e) {
                        !function (e) {
                            e && e.initialized && !(e.getContainer() || e.getBody()).parentNode && (XE(e), e.unbindAllNativeEvents(), e.destroy(!0), e.removed = !0, e = null)
                        }(c.get(e.id))
                    }), 0 === (o = Jn.grep(o, function (e) {
                        return !c.get(e.id)
                    })).length ? f([]) : QE(o, function (e) {
                        !function (e, t) {
                            return e.inline && t.tagName.toLowerCase() in u
                        }(r, e) ? n(s(e), r, e) : fh.initError("Could not initialize inline editor on invalid inline target element", e)
                    }))
                };
                return c.settings = r, ZE.bind(window, "ready", e), new xn(function (t) {
                    n ? t(n) : f = function (e) {
                        t(e)
                    }
                })
            },
            get: function (t) {
                return 0 === arguments.length ? oN.slice(0) : K(t) ? g(oN, function (e) {
                    return e.id === t
                }).getOr(null) : L(t) && oN[t] ? oN[t] : null
            },
            add: function (e) {
                var n = this;
                return rN[e.id] === e || (null === n.get(e.id) && (function (e) {
                    return "length" !== e
                }(e.id) && (rN[e.id] = e), rN.push(e), oN.push(e)), KE(!0), n.activeEditor = e, n.fire("AddEditor", {editor: e}), YE || (YE = function (e) {
                    var t = n.fire("BeforeUnload");
                    if (t.returnValue) return e.preventDefault(), e.returnValue = t.returnValue, t.returnValue
                }, window.addEventListener("beforeunload", YE))), e
            },
            createEditor: function (e, t) {
                return this.add(new qE(e, t, this))
            },
            remove: function (e) {
                var t, n, r = this;
                if (e) {
                    if (!K(e)) return n = e, H(r.get(n.id)) ? null : (XE(n) && r.fire("RemoveEditor", {editor: n}), 0 === oN.length && window.removeEventListener("beforeunload", YE), n.remove(), KE(0 < oN.length), n);
                    QE(ZE.select(e), function (e) {
                        (n = r.get(e.id)) && r.remove(n)
                    })
                } else for (t = oN.length - 1; 0 <= t; t--) r.remove(oN[t])
            },
            execCommand: function (e, t, n) {
                var r = this.get(n);
                switch (e) {
                    case"mceAddEditor":
                        return this.get(n) || new qE(n, this.settings, this).render(), !0;
                    case"mceRemoveEditor":
                        return r && r.remove(), !0;
                    case"mceToggleEditor":
                        return r ? r.isHidden() ? r.show() : r.hide() : this.execCommand("mceAddEditor", 0, n), !0
                }
                return !!this.activeEditor && this.activeEditor.execCommand(e, t, n)
            },
            triggerSave: function () {
                QE(oN, function (e) {
                    e.save()
                })
            },
            addI18n: function (e, t) {
                la.add(e, t)
            },
            translate: function (e) {
                return la.translate(e)
            },
            setActive: function (e) {
                var t = this.activeEditor;
                this.activeEditor !== e && (t && t.fire("deactivate", {relatedTarget: e}), e.fire("activate", {relatedTarget: t})), this.activeEditor = e
            },
            _setBaseUrl: function (e) {
                this.baseURL = new PE(this.documentBaseURL).toAbsolute(e.replace(/\/+$/, "")), this.baseURI = new PE(this.baseURL)
            }
        });

    function uN(n) {
        return {
            walk: function (e, t) {
                return nf(n, e, t)
            }, split: Ng, normalize: function (t) {
                return Vm(n, t).fold($(!1), function (e) {
                    return t.setStart(e.startContainer, e.startOffset), t.setEnd(e.endContainer, e.endOffset), !0
                })
            }
        }
    }

    aN.setup(), (GE = uN = uN || {}).compareRanges = Lm, GE.getCaretRangeFromPoint = bm, GE.getSelectedNode = Qa, GE.getNode = eu;

    function cN(e, t, n) {
        var r, o, i, a, u, c;
        return r = t.x, o = t.y, i = e.w, a = e.h, u = t.w, c = t.h, "b" === (n = (n || "").split(""))[0] && (o += c), "r" === n[1] && (r += u), "c" === n[0] && (o += yN(c / 2)), "c" === n[1] && (r += yN(u / 2)), "b" === n[3] && (o -= a), "r" === n[4] && (r -= i), "c" === n[3] && (o -= yN(a / 2)), "c" === n[4] && (r -= yN(i / 2)), bN(r, o, i, a)
    }

    function sN() {
    }

    var lN, fN, dN, hN, mN = uN, gN = (lN = {}, fN = {}, {
            load: function (r, o) {
                var i = 'Script at URL "' + o + '" failed to load',
                    a = 'Script at URL "' + o + "\" did not call `tinymce.Resource.add('" + r + "', data)` within 1 second";
                if (lN[r] !== undefined) return lN[r];
                var e = new xn(function (e, t) {
                    var n = function (e, t, n) {
                        function r(n) {
                            return function () {
                                for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
                                o || (o = !0, null !== i && (j.clearTimeout(i), i = null), n.apply(null, e))
                            }
                        }

                        void 0 === n && (n = 1e3);
                        var o = !1, i = null, a = r(e), u = r(t);
                        return {
                            start: function () {
                                for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
                                o || null !== i || (i = j.setTimeout(function () {
                                    return u.apply(null, e)
                                }, n))
                            }, resolve: a, reject: u
                        }
                    }(e, t);
                    fN[r] = n.resolve, oa.ScriptLoader.loadScript(o, function () {
                        return n.start(a)
                    }, function () {
                        return n.reject(i)
                    })
                });
                return lN[r] = e
            }, add: function (e, t) {
                fN[e] !== undefined && (fN[e](t), delete fN[e]), lN[e] = xn.resolve(t)
            }
        }), pN = Math.min, vN = Math.max, yN = Math.round,
        bN = function (e, t, n, r) {
            return {x: e, y: t, w: n, h: r}
        }, CN = {
            inflate: function (e, t, n) {
                return bN(e.x - t, e.y - n, e.w + 2 * t, e.h + 2 * n)
            },
            relativePosition: cN,
            findBestRelativePosition: function (e, t, n, r) {
                var o, i;
                for (i = 0; i < r.length; i++) if ((o = cN(e, t, r[i])).x >= n.x && o.x + o.w <= n.w + n.x && o.y >= n.y && o.y + o.h <= n.h + n.y) return r[i];
                return null
            },
            intersect: function (e, t) {
                var n, r, o, i;
                return n = vN(e.x, t.x), r = vN(e.y, t.y), o = pN(e.x + e.w, t.x + t.w), i = pN(e.y + e.h, t.y + t.h), o - n < 0 || i - r < 0 ? null : bN(n, r, o - n, i - r)
            },
            clamp: function (e, t, n) {
                var r, o, i, a, u, c, s, l, f, d;
                return u = e.x, c = e.y, s = e.x + e.w, l = e.y + e.h, f = t.x + t.w, d = t.y + t.h, r = vN(0, t.x - u), o = vN(0, t.y - c), i = vN(0, s - f), a = vN(0, l - d), u += r, c += o, n && (s += r, l += o, u -= i, c -= a), bN(u, c, (s -= i) - u, (l -= a) - c)
            },
            create: bN,
            fromClientRect: function (e) {
                return bN(e.left, e.top, e.width, e.height)
            }
        }, wN = Jn.each, xN = Jn.extend;
    sN.extend = dN = function (n) {
        function r() {
            var e, t, n;
            if (!hN && (this.init && this.init.apply(this, arguments), t = this.Mixins)) for (e = t.length; e--;) (n = t[e]).init && n.init.apply(this, arguments)
        }

        function t() {
            return this
        }

        function e(n, r) {
            return function () {
                var e, t = this._super;
                return this._super = u[n], e = r.apply(this, arguments), this._super = t, e
            }
        }

        var o, i, a, u = this.prototype;
        for (i in hN = !0, o = new this, hN = !1, n.Mixins && (wN(n.Mixins, function (e) {
            for (var t in e) "init" !== t && (n[t] = e[t])
        }), u.Mixins && (n.Mixins = u.Mixins.concat(n.Mixins))), n.Methods && wN(n.Methods.split(","), function (e) {
            n[e] = t
        }), n.Properties && wN(n.Properties.split(","), function (e) {
            var t = "_" + e;
            n[e] = function (e) {
                return e !== undefined ? (this[t] = e, this) : this[t]
            }
        }), n.Statics && wN(n.Statics, function (e, t) {
            r[t] = e
        }), n.Defaults && u.Defaults && (n.Defaults = xN({}, u.Defaults, n.Defaults)), n) "function" == typeof (a = n[i]) && u[i] ? o[i] = e(i, a) : o[i] = a;
        return r.prototype = o, (r.constructor = r).extend = dN, r
    };
    var zN = Math.min, EN = Math.max, NN = Math.round, SN = {
        serialize: function (e) {
            var t = JSON.stringify(e);
            return K(t) ? t.replace(/[\u0080-\uFFFF]/g, function (e) {
                var t = e.charCodeAt(0).toString(16);
                return "\\u" + "0000".substring(t.length) + t
            }) : t
        }, parse: function (e) {
            try {
                return JSON.parse(e)
            } catch (t) {
            }
        }
    }, kN = {
        callbacks: {}, count: 0, send: function (t) {
            var n = this, r = ea.DOM,
                o = t.count !== undefined ? t.count : n.count,
                i = "tinymce_jsonp_" + o;
            n.callbacks[o] = function (e) {
                r.remove(i), delete n.callbacks[o], t.callback(e)
            }, r.add(r.doc.body, "script", {
                id: i,
                src: t.url,
                type: "text/javascript"
            }), n.count++
        }
    }, TN = ne(ne({}, wE), {
        send: function (e) {
            var t, n = 0, r = function () {
                !e.async || 4 === t.readyState || 1e4 < n++ ? (e.success && n < 1e4 && 200 === t.status ? e.success.call(e.success_scope, "" + t.responseText, t, e) : e.error && e.error.call(e.error_scope, 1e4 < n ? "TIMED_OUT" : "GENERAL", t, e), t = null) : Ln.setTimeout(r, 10)
            };
            if (e.scope = e.scope || this, e.success_scope = e.success_scope || e.scope, e.error_scope = e.error_scope || e.scope, e.async = !1 !== e.async, e.data = e.data || "", TN.fire("beforeInitialize", {settings: e}), t = new j.XMLHttpRequest) {
                if (t.overrideMimeType && t.overrideMimeType(e.content_type), t.open(e.type || (e.data ? "POST" : "GET"), e.url, e.async), e.crossDomain && (t.withCredentials = !0), e.content_type && t.setRequestHeader("Content-Type", e.content_type), e.requestheaders && Jn.each(e.requestheaders, function (e) {
                    t.setRequestHeader(e.key, e.value)
                }), t.setRequestHeader("X-Requested-With", "XMLHttpRequest"), (t = TN.fire("beforeSend", {
                    xhr: t,
                    settings: e
                }).xhr).send(e.data), !e.async) return r();
                Ln.setTimeout(r, 10)
            }
        }
    }), AN = Jn.extend, MN = (RN.sendRPC = function (e) {
        return (new RN).send(e)
    }, RN.prototype.send = function (e) {
        var n = e.error, r = e.success, o = AN(this.settings, e);
        o.success = function (e, t) {
            void 0 === (e = SN.parse(e)) && (e = {error: "JSON Parse error."}), e.error ? n.call(o.error_scope || o.scope, e.error, t) : r.call(o.success_scope || o.scope, e.result)
        }, o.error = function (e, t) {
            n && n.call(o.error_scope || o.scope, e, t)
        }, o.data = SN.serialize({
            id: e.id || "c" + this.count++,
            method: e.method,
            params: e.params
        }), o.content_type = "application/json", TN.send(o)
    }, RN);

    function RN(e) {
        this.settings = AN({}, e), this.count = 0
    }

    var DN, _N, ON, HN;
    try {
        DN = j.window.localStorage
    } catch (VN) {
        _N = {}, ON = [], HN = {
            getItem: function (e) {
                var t = _N[e];
                return t || null
            }, setItem: function (e, t) {
                ON.push(e), _N[e] = String(t)
            }, key: function (e) {
                return ON[e]
            }, removeItem: function (t) {
                ON = ON.filter(function (e) {
                    return e === t
                }), delete _N[t]
            }, clear: function () {
                ON = [], _N = {}
            }, length: 0
        }, Object.defineProperty(HN, "length", {
            get: function () {
                return ON.length
            }, configurable: !1, enumerable: !1
        }), DN = HN
    }
    var BN, PN = {
        geom: {Rect: CN},
        util: {
            Promise: xn,
            Delay: Ln,
            Tools: Jn,
            VK: ph,
            URI: PE,
            Class: sN,
            EventDispatcher: aE,
            Observable: wE,
            I18n: la,
            XHR: TN,
            JSON: SN,
            JSONRequest: MN,
            JSONP: kN,
            LocalStorage: DN,
            Color: function (e) {
                function t(e) {
                    var t;
                    return "object" == typeof e ? "r" in e ? (u = e.r, c = e.g, s = e.b) : "v" in e && function (e, t, n) {
                        var r, o, i, a;
                        if (e = (parseInt(e, 10) || 0) % 360, t = parseInt(t, 10) / 100, n = parseInt(n, 10) / 100, t = EN(0, zN(t, 1)), n = EN(0, zN(n, 1)), 0 !== t) {
                            switch (r = e / 60, i = (o = n * t) * (1 - Math.abs(r % 2 - 1)), a = n - o, Math.floor(r)) {
                                case 0:
                                    u = o, c = i, s = 0;
                                    break;
                                case 1:
                                    u = i, c = o, s = 0;
                                    break;
                                case 2:
                                    u = 0, c = o, s = i;
                                    break;
                                case 3:
                                    u = 0, c = i, s = o;
                                    break;
                                case 4:
                                    u = i, c = 0, s = o;
                                    break;
                                case 5:
                                    u = o, c = 0, s = i;
                                    break;
                                default:
                                    u = c = s = 0
                            }
                            u = NN(255 * (u + a)), c = NN(255 * (c + a)), s = NN(255 * (s + a))
                        } else u = c = s = NN(255 * n)
                    }(e.h, e.s, e.v) : (t = /rgb\s*\(\s*([0-9]+)\s*,\s*([0-9]+)\s*,\s*([0-9]+)[^\)]*\)/gi.exec(e)) ? (u = parseInt(t[1], 10), c = parseInt(t[2], 10), s = parseInt(t[3], 10)) : (t = /#([0-F]{2})([0-F]{2})([0-F]{2})/gi.exec(e)) ? (u = parseInt(t[1], 16), c = parseInt(t[2], 16), s = parseInt(t[3], 16)) : (t = /#([0-F])([0-F])([0-F])/gi.exec(e)) && (u = parseInt(t[1] + t[1], 16), c = parseInt(t[2] + t[2], 16), s = parseInt(t[3] + t[3], 16)), u = u < 0 ? 0 : 255 < u ? 255 : u, c = c < 0 ? 0 : 255 < c ? 255 : c, s = s < 0 ? 0 : 255 < s ? 255 : s, n
                }

                var n = {}, u = 0, c = 0, s = 0;
                return e && t(e), n.toRgb = function () {
                    return {r: u, g: c, b: s}
                }, n.toHsv = function () {
                    return function (e, t, n) {
                        var r, o, i, a;
                        return o = 0, (i = zN(e /= 255, zN(t /= 255, n /= 255))) === (a = EN(e, EN(t, n))) ? {
                            h: 0,
                            s: 0,
                            v: 100 * (o = i)
                        } : (r = (a - i) / a, {
                            h: NN(60 * ((e === i ? 3 : n === i ? 1 : 5) - (e === i ? t - n : n === i ? e - t : n - e) / ((o = a) - i))),
                            s: NN(100 * r),
                            v: NN(100 * o)
                        })
                    }(u, c, s)
                }, n.toHex = function () {
                    function e(e) {
                        return 1 < (e = parseInt(e, 10).toString(16)).length ? e : "0" + e
                    }

                    return "#" + e(u) + e(c) + e(s)
                }, n.parse = t, n
            }
        },
        dom: {
            EventUtils: Zr,
            Sizzle: Qo,
            DomQuery: Fi,
            TreeWalker: Ui,
            TextSeeker: sc,
            DOMUtils: ea,
            ScriptLoader: oa,
            RangeUtils: mN,
            Serializer: Jm,
            ControlSelection: hh,
            BookmarkManager: mh,
            Selection: jm,
            Event: Zr.Event
        },
        html: {
            Styles: Wr,
            Entities: kr,
            Node: gf,
            Schema: Lr,
            SaxParser: hd,
            DomParser: Xm,
            Writer: xf,
            Serializer: zf
        },
        Env: Kn,
        AddOnManager: xa,
        Annotator: sf,
        Formatter: Yp,
        UndoManager: iv,
        EditorCommands: rE,
        WindowManager: oh,
        NotificationManager: th,
        EditorObservable: EE,
        Shortcuts: ME,
        Editor: qE,
        FocusManager: Td,
        EditorManager: aN,
        DOM: ea.DOM,
        ScriptLoader: oa.ScriptLoader,
        PluginManager: xa.PluginManager,
        ThemeManager: xa.ThemeManager,
        IconManager: Xd,
        Resource: gN,
        trim: Jn.trim,
        isArray: Jn.isArray,
        is: Jn.is,
        toArray: Jn.toArray,
        makeMap: Jn.makeMap,
        each: Jn.each,
        map: Jn.map,
        grep: Jn.grep,
        inArray: Jn.inArray,
        extend: Jn.extend,
        create: Jn.create,
        walk: Jn.walk,
        createNS: Jn.createNS,
        resolve: Jn.resolve,
        explode: Jn.explode,
        _addCacheSuffix: Jn._addCacheSuffix,
        isOpera: Kn.opera,
        isWebKit: Kn.webkit,
        isIE: Kn.ie,
        isGecko: Kn.gecko,
        isMac: Kn.mac
    }, LN = Jn.extend(aN, PN);
    BN = LN, window.tinymce = BN, window.tinyMCE = BN, function (e) {
        if ("object" == typeof module) try {
            module.exports = e
        } catch (t) {
        }
    }(LN)
}(window);

/* Ephox Fluffy plugin
 *
 * Copyright 2010-2016 Ephox Corporation.  All rights reserved.
 *
 * Version: 2.4.0-12
 */

!function (a) {
    "use strict";
    var n, t, r, e,
        u = void 0 !== a.window ? a.window : Function("return this;")(),
        i = function (n, t) {
            return {isRequired: n, applyPatch: t}
        }, c = function (i, o) {
            return function () {
                for (var n = [], t = 0; t < arguments.length; t++) n[t] = arguments[t];
                var r = o.apply(this, n), e = void 0 === r ? n : r;
                return i.apply(this, e)
            }
        }, o = function (n, t) {
            if (n) for (var r = 0; r < t.length; r++) t[r].isRequired(n) && t[r].applyPatch(n);
            return n
        }, f = function () {
        }, l = function (n) {
            return function () {
                return n
            }
        }, s = l(!1), g = l(!0), p = function () {
            return d
        }, d = (n = function (n) {
            return n.isNone()
        }, e = {
            fold: function (n, t) {
                return n()
            },
            is: s,
            isSome: s,
            isNone: g,
            getOr: r = function (n) {
                return n
            },
            getOrThunk: t = function (n) {
                return n()
            },
            getOrDie: function (n) {
                throw new Error(n || "error: getOrDie called on none.")
            },
            getOrNull: l(null),
            getOrUndefined: l(void 0),
            or: r,
            orThunk: t,
            map: p,
            each: f,
            bind: p,
            exists: s,
            forall: g,
            filter: p,
            equals: n,
            equals_: n,
            toArray: function () {
                return []
            },
            toString: l("none()")
        }, Object.freeze && Object.freeze(e), e), h = function (r) {
            var n = l(r), t = function () {
                return i
            }, e = function (n) {
                return n(r)
            }, i = {
                fold: function (n, t) {
                    return t(r)
                },
                is: function (n) {
                    return r === n
                },
                isSome: g,
                isNone: s,
                getOr: n,
                getOrThunk: n,
                getOrDie: n,
                getOrNull: n,
                getOrUndefined: n,
                or: t,
                orThunk: t,
                map: function (n) {
                    return h(n(r))
                },
                each: function (n) {
                    n(r)
                },
                bind: e,
                exists: e,
                forall: e,
                filter: function (n) {
                    return n(r) ? i : d
                },
                toArray: function () {
                    return [r]
                },
                toString: function () {
                    return "some(" + r + ")"
                },
                equals: function (n) {
                    return n.is(r)
                },
                equals_: function (n, t) {
                    return n.fold(s, function (n) {
                        return t(r, n)
                    })
                }
            };
            return i
        }, v = p, y = function (n) {
            return null == n ? d : h(n)
        }, m = function (t) {
            return function (n) {
                return function (n) {
                    if (null === n) return "null";
                    var t = typeof n;
                    return "object" === t && (Array.prototype.isPrototypeOf(n) || n.constructor && "Array" === n.constructor.name) ? "array" : "object" === t && (String.prototype.isPrototypeOf(n) || n.constructor && "String" === n.constructor.name) ? "string" : t
                }(n) === t
            }
        }, w = m("object"), O = m("array"), b = m("undefined"), j = m("function"),
        A = (Array.prototype.slice, Array.prototype.indexOf),
        x = Array.prototype.push, E = function (n, t) {
            return r = n, e = t, -1 < A.call(r, e);
            var r, e
        }, S = function (n, t) {
            return function (n) {
                for (var t = [], r = 0, e = n.length; r < e; ++r) {
                    if (!O(n[r])) throw new Error("Arr.flatten item " + r + " was not an array, input: " + n);
                    x.apply(t, n[r])
                }
                return t
            }(function (n, t) {
                for (var r = n.length, e = new Array(r), i = 0; i < r; i++) {
                    var o = n[i];
                    e[i] = t(o, i)
                }
                return e
            }(n, t))
        }, M = (j(Array.from) && Array.from, Object.prototype.hasOwnProperty),
        _ = function (u) {
            return function () {
                for (var n = new Array(arguments.length), t = 0; t < n.length; t++) n[t] = arguments[t];
                if (0 === n.length) throw new Error("Can't merge zero objects");
                for (var r = {}, e = 0; e < n.length; e++) {
                    var i = n[e];
                    for (var o in i) M.call(i, o) && (r[o] = u(r[o], i[o]))
                }
                return r
            }
        }, D = _(function (n, t) {
            return w(n) && w(t) ? D(n, t) : t
        }), P = _(function (n, t) {
            return t
        }), U = Object.keys, N = Object.hasOwnProperty, R = function (n, t) {
            for (var r = U(n), e = 0, i = r.length; e < i; e++) {
                var o = r[e];
                t(n[o], o)
            }
        }, T = function (n, t) {
            return q(n, t) ? y(n[t]) : v()
        }, q = function (n, t) {
            return N.call(n, t)
        }, C = function (n) {
            if (b(n) || "" === n) return [];
            var t = O(n) ? S(n, function (n) {
                return n.split(/[\s+,]/)
            }) : n.split(/[\s+,]/);
            return S(t, function (n) {
                return 0 < n.length ? [n.trim()] : []
            })
        }, I = function (n, t) {
            var r, e, i, o = D(n, t), u = C(t.plugins),
                a = T(o, "custom_plugin_urls").getOr({}), c = (r = function (n, t) {
                    return E(u, t)
                }, e = {}, i = {}, R(a, function (n, t) {
                    (r(n, t) ? e : i)[t] = n
                }), {t: e, f: i}), f = T(o, "external_plugins").getOr({}), l = {};
            R(c.t, function (n, t) {
                l[t] = n
            });
            var s = P(l, f);
            return P(t, 0 === U(s).length ? {} : {external_plugins: s})
        }, k = {
            getCustomPluginUrls: I, patch: i(function () {
                return !0
            }, function (t) {
                t.EditorManager.init = c(t.EditorManager.init, function (n) {
                    return [I(t.defaultSettings, n)]
                })
            })
        }, L = function (n, t) {
            return function (n, t) {
                for (var r = null != t ? t : u, e = 0; e < n.length && null != r; ++e) r = r[n[e]];
                return r
            }(n.split("."), t)
        }, z = function (n) {
            return parseInt(n, 10)
        }, V = function (n, t) {
            var r = n - t;
            return 0 === r ? 0 : 0 < r ? 1 : -1
        }, B = function (n, t, r) {
            return {major: n, minor: t, patch: r}
        }, F = function (n) {
            var t = /([0-9]+)\.([0-9]+)\.([0-9]+)(?:(\-.+)?)/.exec(n);
            return t ? B(z(t[1]), z(t[2]), z(t[3])) : B(0, 0, 0)
        }, $ = function (n, t) {
            return !!n && -1 === function (n, t) {
                var r = V(n.major, t.major);
                if (0 !== r) return r;
                var e = V(n.minor, t.minor);
                if (0 !== e) return e;
                var i = V(n.patch, t.patch);
                return 0 !== i ? i : 0
            }(F([(r = n).majorVersion, r.minorVersion].join(".").split(".").slice(0, 3).join(".")), F(t));
            var r
        }, G = {
            patch: i(function (n) {
                return $(n, "4.7.0")
            }, function (n) {
                var o;
                n.EditorManager.init = c(n.EditorManager.init, (o = n.EditorManager, function (n) {
                    var t = L("tinymce.util.Tools", u), r = C(n.plugins),
                        e = o.defaultSettings.forced_plugins || [],
                        i = 0 < e.length ? r.concat(e) : r;
                    return [t.extend({}, n, {plugins: i})]
                }))
            })
        }, H = function () {
            return (new Date).getTime()
        }, J = function (n, t, r, e, i) {
            var o, u = H();
            o = a.setInterval(function () {
                n() && (a.clearInterval(o), t()), H() - u > i && (a.clearInterval(o), r())
            }, e)
        }, K = function (i) {
            return function () {
                var n, t, r,
                    e = (n = i, t = "position", r = n.currentStyle ? n.currentStyle[t] : a.window.getComputedStyle(n, null)[t], r || "").toLowerCase();
                return "absolute" === e || "fixed" === e
            }
        }, Q = function (n) {
            n.parentNode.removeChild(n)
        }, W = function (n, t) {
            var r,
                e = ((r = a.document.createElement("div")).style.display = "none", r.className = "mce-floatpanel", r);
            a.document.body.appendChild(e), J(K(e), function () {
                Q(e), n()
            }, function () {
                Q(e), t()
            }, 10, 5e3)
        }, X = function (n, t) {
            n.notificationManager ? n.notificationManager.open({
                text: t,
                type: "warning",
                timeout: 0,
                icon: ""
            }) : n.windowManager.alert(t)
        }, Y = function (n) {
            n.EditorManager.on("AddEditor", function (n) {
                var t = n.editor, r = t.settings.service_message;
                r && W(function () {
                    X(t, t.settings.service_message)
                }, function () {
                    a.alert(r)
                })
            })
        }, Z = function (n) {
            var t, r, e = L("tinymce.util.URI", u);
            (t = n.base_url) && (this.baseURL = new e(this.documentBaseURL).toAbsolute(t.replace(/\/+$/, "")), this.baseURI = new e(this.baseURL)), r = n.suffix, n.suffix && (this.suffix = r), this.defaultSettings = n
        }, nn = function (n) {
            return [L("tinymce.util.Tools", u).extend({}, this.defaultSettings, n)]
        }, tn = {
            patch: i(function (n) {
                return "function" != typeof n.overrideDefaults
            }, function (n) {
                Y(n), n.overrideDefaults = Z, n.EditorManager.init = c(n.EditorManager.init, nn)
            })
        }, rn = {
            patch: i(function (n) {
                return $(n, "4.5.0")
            }, function (n) {
                var e;
                n.overrideDefaults = c(n.overrideDefaults, (e = n, function (n) {
                    var t = n.plugin_base_urls;
                    for (var r in t) e.PluginManager.urls[r] = t[r]
                }))
            })
        }, en = function (n) {
            o(n, [tn.patch, rn.patch, G.patch, k.patch])
        };
    en(u.tinymce)
}(window);

(function (cloudSettings) {
    tinymce.overrideDefaults(cloudSettings);
})({
    "imagetools_proxy": "https://imageproxy.tiny.cloud/2/image",
    "suffix": ".min",
    "linkchecker_service_url": "https://hyperlinking.tiny.cloud",
    "spellchecker_rpc_url": "https://spelling.tiny.cloud",
    "spellchecker_api_key": "invalid-origin",
    "tinydrive_service_url": "https://catalog.tiny.cloud",
    "api_key": "invalid-origin",
    "imagetools_api_key": "invalid-origin",
    "tinydrive_api_key": "invalid-origin",
    "forced_plugins": ["chiffer"],
    "referrer_policy": "origin",
    "content_css_cors": true,
    "custom_plugin_urls": {},
    "chiffer_snowplow_service_url": "https://sp.tinymce.com/i",
    "mediaembed_api_key": "invalid-origin",
    "linkchecker_api_key": "invalid-origin",
    "mediaembed_service_url": "https://hyperlinking.tiny.cloud",
    "service_message": "This domain is not registered with Tiny Cloud.  Please review \u003ca target=\"_blank\" href=\"https://www.tiny.cloud/my-account\"\u003eyour approved domains\u003c/a\u003e."
});
tinymce.baseURL = "https://cdn.tiny.cloud/1/invalid-origin/tinymce/5.2.1-76"

/* Ephox chiffer plugin
*
* Copyright 2010-2019 Tiny Technologies Inc. All rights reserved.
*
* Version: 1.4.2-9
*/

!function (u) {
    "use strict";
    for (var t, a = function () {
        return (new Date).getTime()
    }, c = (t = "string", function (n) {
        return function (n) {
            if (null === n) return "null";
            var t = typeof n;
            return "object" === t && (Array.prototype.isPrototypeOf(n) || n.constructor && "Array" === n.constructor.name) ? "array" : "object" === t && (String.prototype.isPrototypeOf(n) || n.constructor && "String" === n.constructor.name) ? "string" : t
        }(n) === t
    }), o = [], n = 0; n < 256; ++n) o[n] = (n + 256).toString(16).substr(1);
    var f = function () {
        var n, t, r, e = function () {
            for (var n = new Array(16), t = 0, r = 0; r < 16; r++) 0 == (3 & r) && (t = 4294967296 * Math.random()), n[r] = t >>> ((3 & r) << 3) & 255;
            return n
        }();
        return e[6] = 15 & e[6] | 64, e[8] = 63 & e[8] | 128, t = 0, (r = o)[(n = e)[t++]] + r[n[t++]] + r[n[t++]] + r[n[t++]] + "-" + r[n[t++]] + r[n[t++]] + "-" + r[n[t++]] + r[n[t++]] + "-" + r[n[t++]] + r[n[t++]] + "-" + r[n[t++]] + r[n[t++]] + r[n[t++]] + r[n[t++]] + r[n[t++]] + r[n[t++]]
    }, s = function () {
    }, d = function (n, t) {
        var i, c, r, e = (i = n, c = t, {
            send: function (n, t, r) {
                var e = "?aid=" + c + "&tna=tinymce_cloud&p=web&dtm=" + t + "&stm=" + a() + "&tz=" + ("undefined" != typeof Intl ? encodeURIComponent(Intl.DateTimeFormat().resolvedOptions().timeZone) : "N%2FA") + "&e=se&se_ca=" + n + "&eid=" + f() + "&fp=none&tv=js-2.6.1",
                    o = u.document.createElement("img");
                o.src = i.chiffer_snowplow_service_url + e, o.onload = function () {
                    r(!0)
                }, o.onerror = function () {
                    r(!1)
                }
            }
        });
        return r = e, {
            sendStat: function (n) {
                return function () {
                    r.send(n, a(), s)
                }
            }
        }
    };
    return function () {
        var n, t, r = tinymce.defaultSettings, e = {
                load: function (n) {
                    return s
                }
            }, o = (n = r.api_key, c(n) ? n : void 0),
            i = void 0 === o ? e : ((t = d(r, o)).sendStat("script_load")(), {
                load: function (n) {
                    n.once("init", t.sendStat("init")), n.once("focus", t.sendStat("focus"))
                }
            });
        tinymce.PluginManager.add("chiffer", i.load)
    }
}(window)();
