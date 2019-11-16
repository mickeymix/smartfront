function matchHeights(n) {
    $(n).height("");
    var t = $(n).map(function() {
            return $(this).height()
        }).get(),
        i = Math.max.apply(null, t);
    $(n).height(i)
}

function DoSearch(n) {
    var t = $("#search-term").val();
    if (null == t || "" === t) return !1;
    window.location.href = n + "?q=" + t
}

function ShowProp65WarningModal(n) {
    var t = sessionStorage.getItem("cartState"),
        r = "true" == sessionStorage.getItem("cartHasProp65Item"),
        u = n && "true" == n.toLowerCase(),
        f = t && "ca" == t.toLowerCase(),
        i = !1;
    return f && (r || u) && (i = !0), i
}

function ClearProp65StorageObject() {
    sessionStorage.removeItem("cartState");
    sessionStorage.removeItem("cartHasProp65Item")
}

function onProductClick(n, t, i) {
    ga("ec:addProduct", {
        id: n,
        name: t
    });
    ga("ec:setAction", "click", {
        list: "Search Results"
    });
    ga("send", "event", "UX", "click", "Results", {
        hitCallback: function() {
            document.location = i
        }
    })
}
window.console || (window.console = {
        log: function() {},
        info: function() {},
        error: function() {}
    }),
    function(n) {
        "use strict";

        function t() {
            var i = document.createElement("bootstrap"),
                t = {
                    WebkitTransition: "webkitTransitionEnd",
                    MozTransition: "transitionend",
                    OTransition: "oTransitionEnd otransitionend",
                    transition: "transitionend"
                },
                n;
            for (n in t)
                if (void 0 !== i.style[n]) return {
                    end: t[n]
                };
            return !1
        }
        n.fn.emulateTransitionEnd = function(t) {
            var i = !1,
                u = this,
                r;
            n(this).one(n.support.transition.end, function() {
                i = !0
            });
            return r = function() {
                i || n(u).trigger(n.support.transition.end)
            }, setTimeout(r, t), this
        };
        n(function() {
            n.support.transition = t()
        })
    }(jQuery),
    function(n) {
        "use strict";
        var i = '[data-dismiss="alert"]',
            t = function(t) {
                n(t).on("click", i, this.close)
            },
            r;
        t.prototype.close = function(t) {
            function f() {
                i.trigger("closed.bs.alert").remove()
            }
            var u = n(this),
                r = u.attr("data-target"),
                i;
            r || (r = u.attr("href"), r = r && r.replace(/.*(?=#[^\s]*$)/, ""));
            i = n(r);
            t && t.preventDefault();
            i.length || (i = u.hasClass("alert") ? u : u.parent());
            i.trigger(t = n.Event("close.bs.alert"));
            t.isDefaultPrevented() || (i.removeClass("in"), n.support.transition && i.hasClass("fade") ? i.one(n.support.transition.end, f).emulateTransitionEnd(150) : f())
        };
        r = n.fn.alert;
        n.fn.alert = function(i) {
            return this.each(function() {
                var r = n(this),
                    u = r.data("bs.alert");
                u || r.data("bs.alert", u = new t(this));
                "string" == typeof i && u[i].call(r)
            })
        };
        n.fn.alert.Constructor = t;
        n.fn.alert.noConflict = function() {
            return n.fn.alert = r, this
        };
        n(document).on("click.bs.alert.data-api", i, t.prototype.close)
    }(jQuery),
    function(n) {
        "use strict";
        var t = function(i, r) {
                this.$element = n(i);
                this.options = n.extend({}, t.DEFAULTS, r);
                this.isLoading = !1
            },
            i;
        t.DEFAULTS = {
            loadingText: "loading..."
        };
        t.prototype.setState = function(t) {
            var r = "disabled",
                i = this.$element,
                u = i.is("input") ? "val" : "html",
                f = i.data();
            t += "Text";
            f.resetText || i.data("resetText", i[u]());
            i[u](f[t] || this.options[t]);
            setTimeout(n.proxy(function() {
                "loadingText" == t ? (this.isLoading = !0, i.addClass(r).attr(r, r)) : this.isLoading && (this.isLoading = !1, i.removeClass(r).removeAttr(r))
            }, this), 0)
        };
        t.prototype.toggle = function() {
            var t = !0,
                i = this.$element.closest('[data-toggle="buttons"]'),
                n;
            i.length && (n = this.$element.find("input"), "radio" == n.prop("type") && (n.prop("checked") && this.$element.hasClass("active") ? t = !1 : i.find(".active").removeClass("active")), t && n.prop("checked", !this.$element.hasClass("active")).trigger("change"));
            t && this.$element.toggleClass("active")
        };
        i = n.fn.button;
        n.fn.button = function(i) {
            return this.each(function() {
                var u = n(this),
                    r = u.data("bs.button"),
                    f = "object" == typeof i && i;
                r || u.data("bs.button", r = new t(this, f));
                "toggle" == i ? r.toggle() : i && r.setState(i)
            })
        };
        n.fn.button.Constructor = t;
        n.fn.button.noConflict = function() {
            return n.fn.button = i, this
        };
        n(document).on("click.bs.button.data-api", "[data-toggle^=button]", function(t) {
            var i = n(t.target);
            i.hasClass("btn") || (i = i.closest(".btn"));
            i.button("toggle");
            t.preventDefault()
        })
    }(jQuery),
    function(n) {
        "use strict";
        var t = function(t, i) {
                this.$element = n(t);
                this.$indicators = this.$element.find(".carousel-indicators");
                this.options = i;
                this.paused = this.sliding = this.interval = this.$active = this.$items = null;
                "hover" == this.options.pause && this.$element.on("mouseenter", n.proxy(this.pause, this)).on("mouseleave", n.proxy(this.cycle, this))
            },
            i;
        t.DEFAULTS = {
            interval: 5e3,
            pause: "hover",
            wrap: !0
        };
        t.prototype.cycle = function(t) {
            return t || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(n.proxy(this.next, this), this.options.interval)), this
        };
        t.prototype.getActiveIndex = function() {
            return this.$active = this.$element.find(".item.active"), this.$items = this.$active.parent().children(), this.$items.index(this.$active)
        };
        t.prototype.to = function(t) {
            var r = this,
                i = this.getActiveIndex();
            if (!(t > this.$items.length - 1 || t < 0)) return this.sliding ? this.$element.one("slid.bs.carousel", function() {
                r.to(t)
            }) : i == t ? this.pause().cycle() : this.slide(t > i ? "next" : "prev", n(this.$items[t]))
        };
        t.prototype.pause = function(t) {
            return t || (this.paused = !0), this.$element.find(".next, .prev").length && n.support.transition && (this.$element.trigger(n.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
        };
        t.prototype.next = function() {
            if (!this.sliding) return this.slide("next")
        };
        t.prototype.prev = function() {
            if (!this.sliding) return this.slide("prev")
        };
        t.prototype.slide = function(t, i) {
            var u = this.$element.find(".item.active"),
                r = i || u[t](),
                s = this.interval,
                f = "next" == t ? "left" : "right",
                h = "next" == t ? "first" : "last",
                e = this,
                o;
            if (!r.length) {
                if (!this.options.wrap) return;
                r = this.$element.find(".item")[h]()
            }
            return r.hasClass("active") ? this.sliding = !1 : (o = n.Event("slide.bs.carousel", {
                relatedTarget: r[0],
                direction: f
            }), this.$element.trigger(o), o.isDefaultPrevented() ? void 0 : (this.sliding = !0, s && this.pause(), this.$indicators.length && (this.$indicators.find(".active").removeClass("active"), this.$element.one("slid.bs.carousel", function() {
                var t = n(e.$indicators.children()[e.getActiveIndex()]);
                t && t.addClass("active")
            })), n.support.transition && this.$element.hasClass("slide") ? (r.addClass(t), r[0].offsetWidth, u.addClass(f), r.addClass(f), u.one(n.support.transition.end, function() {
                r.removeClass([t, f].join(" ")).addClass("active");
                u.removeClass(["active", f].join(" "));
                e.sliding = !1;
                setTimeout(function() {
                    e.$element.trigger("slid.bs.carousel")
                }, 0)
            }).emulateTransitionEnd(1e3 * u.css("transition-duration").slice(0, -1))) : (u.removeClass("active"), r.addClass("active"), this.sliding = !1, this.$element.trigger("slid.bs.carousel")), s && this.cycle(), this))
        };
        i = n.fn.carousel;
        n.fn.carousel = function(i) {
            return this.each(function() {
                var u = n(this),
                    r = u.data("bs.carousel"),
                    f = n.extend({}, t.DEFAULTS, u.data(), "object" == typeof i && i),
                    e = "string" == typeof i ? i : f.slide;
                r || u.data("bs.carousel", r = new t(this, f));
                "number" == typeof i ? r.to(i) : e ? r[e]() : f.interval && r.pause().cycle()
            })
        };
        n.fn.carousel.Constructor = t;
        n.fn.carousel.noConflict = function() {
            return n.fn.carousel = i, this
        };
        n(document).on("click.bs.carousel.data-api", "[data-slide], [data-slide-to]", function(t) {
            var f, i = n(this),
                r = n(i.attr("data-target") || (f = i.attr("href")) && f.replace(/.*(?=#[^\s]+$)/, "")),
                e = n.extend({}, r.data(), i.data()),
                u = i.attr("data-slide-to");
            u && (e.interval = !1);
            r.carousel(e);
            (u = i.attr("data-slide-to")) && r.data("bs.carousel").to(u);
            t.preventDefault()
        });
        n(window).on("load", function() {
            n('[data-ride="carousel"]').each(function() {
                var t = n(this);
                t.carousel(t.data())
            })
        })
    }(jQuery),
    function(n) {
        "use strict";
        var t = function(i, r) {
                this.$element = n(i);
                this.options = n.extend({}, t.DEFAULTS, r);
                this.transitioning = null;
                this.options.parent && (this.$parent = n(this.options.parent));
                this.options.toggle && this.toggle()
            },
            i;
        t.DEFAULTS = {
            toggle: !0
        };
        t.prototype.dimension = function() {
            return this.$element.hasClass("width") ? "width" : "height"
        };
        t.prototype.show = function() {
            var u, t, r, i, f, e;
            if (!this.transitioning && !this.$element.hasClass("in") && (u = n.Event("show.bs.collapse"), this.$element.trigger(u), !u.isDefaultPrevented())) {
                if (t = this.$parent && this.$parent.find("> .panel > .in"), t && t.length) {
                    if (r = t.data("bs.collapse"), r && r.transitioning) return;
                    t.collapse("hide");
                    r || t.data("bs.collapse", null)
                }
                if (i = this.dimension(), this.$element.removeClass("collapse").addClass("collapsing")[i](0), this.transitioning = 1, f = function() {
                        this.$element.removeClass("collapsing").addClass("collapse in")[i]("auto");
                        this.transitioning = 0;
                        this.$element.trigger("shown.bs.collapse")
                    }, !n.support.transition) return f.call(this);
                e = n.camelCase(["scroll", i].join("-"));
                this.$element.one(n.support.transition.end, n.proxy(f, this)).emulateTransitionEnd(350)[i](this.$element[0][e])
            }
        };
        t.prototype.hide = function() {
            var i, t, r;
            if (!this.transitioning && this.$element.hasClass("in") && (i = n.Event("hide.bs.collapse"), this.$element.trigger(i), !i.isDefaultPrevented())) {
                if (t = this.dimension(), this.$element[t](this.$element[t]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse").removeClass("in"), this.transitioning = 1, r = function() {
                        this.transitioning = 0;
                        this.$element.trigger("hidden.bs.collapse").removeClass("collapsing").addClass("collapse")
                    }, !n.support.transition) return r.call(this);
                this.$element[t](0).one(n.support.transition.end, n.proxy(r, this)).emulateTransitionEnd(350)
            }
        };
        t.prototype.toggle = function() {
            this[this.$element.hasClass("in") ? "hide" : "show"]()
        };
        i = n.fn.collapse;
        n.fn.collapse = function(i) {
            return this.each(function() {
                var u = n(this),
                    r = u.data("bs.collapse"),
                    f = n.extend({}, t.DEFAULTS, u.data(), "object" == typeof i && i);
                !r && f.toggle && "show" == i && (i = !i);
                r || u.data("bs.collapse", r = new t(this, f));
                "string" == typeof i && r[i]()
            })
        };
        n.fn.collapse.Constructor = t;
        n.fn.collapse.noConflict = function() {
            return n.fn.collapse = i, this
        };
        n(document).on("click.bs.collapse.data-api", "[data-toggle=collapse]", function(t) {
            var e, i = n(this),
                s = i.attr("data-target") || t.preventDefault() || (e = i.attr("href")) && e.replace(/.*(?=#[^\s]+$)/, ""),
                r = n(s),
                u = r.data("bs.collapse"),
                h = u ? "toggle" : i.data(),
                f = i.attr("data-parent"),
                o = f && n(f);
            u && u.transitioning || (o && o.find('[data-toggle=collapse][data-parent="' + f + '"]').not(i).addClass("collapsed"), i[r.hasClass("in") ? "addClass" : "removeClass"]("collapsed"));
            r.collapse(h)
        })
    }(jQuery),
    function(n) {
        "use strict";

        function r(t) {
            n(e).remove();
            n(i).each(function() {
                var i = u(n(this)),
                    r = {
                        relatedTarget: this
                    };
                i.hasClass("open") && (i.trigger(t = n.Event("hide.bs.dropdown", r)), t.isDefaultPrevented() || i.removeClass("open").trigger("hidden.bs.dropdown", r))
            })
        }

        function u(t) {
            var i = t.attr("data-target"),
                r;
            return i || (i = t.attr("href"), i = i && /#[A-Za-z]/.test(i) && i.replace(/.*(?=#[^\s]*$)/, "")), r = i && n(i), r && r.length ? r : t.parent()
        }
        var e = ".dropdown-backdrop",
            i = "[data-toggle=dropdown]",
            t = function(t) {
                n(t).on("click.bs.dropdown", this.toggle)
            },
            f;
        t.prototype.toggle = function(t) {
            var f = n(this),
                i, o, e;
            if (!f.is(".disabled, :disabled")) {
                if (i = u(f), o = i.hasClass("open"), r(), !o) {
                    if ("ontouchstart" in document.documentElement && !i.closest(".navbar-nav").length && n('<div class="dropdown-backdrop"/>').insertAfter(n(this)).on("click", r), e = {
                            relatedTarget: this
                        }, i.trigger(t = n.Event("show.bs.dropdown", e)), t.isDefaultPrevented()) return;
                    i.toggleClass("open").trigger("shown.bs.dropdown", e);
                    f.focus()
                }
                return !1
            }
        };
        t.prototype.keydown = function(t) {
            var e, o, s, h, f, r;
            if (/(38|40|27)/.test(t.keyCode) && (e = n(this), t.preventDefault(), t.stopPropagation(), !e.is(".disabled, :disabled"))) {
                if (o = u(e), s = o.hasClass("open"), !s || s && 27 == t.keyCode) return 27 == t.which && o.find(i).focus(), e.click();
                h = " li:not(.divider):visible a";
                f = o.find("[role=menu]" + h + ", [role=listbox]" + h);
                f.length && (r = f.index(f.filter(":focus")), 38 == t.keyCode && r > 0 && r--, 40 == t.keyCode && r < f.length - 1 && r++, ~r || (r = 0), f.eq(r).focus())
            }
        };
        f = n.fn.dropdown;
        n.fn.dropdown = function(i) {
            return this.each(function() {
                var r = n(this),
                    u = r.data("bs.dropdown");
                u || r.data("bs.dropdown", u = new t(this));
                "string" == typeof i && u[i].call(r)
            })
        };
        n.fn.dropdown.Constructor = t;
        n.fn.dropdown.noConflict = function() {
            return n.fn.dropdown = f, this
        };
        n(document).on("click.bs.dropdown.data-api", r).on("click.bs.dropdown.data-api", ".dropdown form", function(n) {
            n.stopPropagation()
        }).on("click.bs.dropdown.data-api", i, t.prototype.toggle).on("keydown.bs.dropdown.data-api", i + ", [role=menu], [role=listbox]", t.prototype.keydown)
    }(jQuery),
    function(n) {
        "use strict";
        var t = function(t, i) {
                this.options = i;
                this.$element = n(t);
                this.$backdrop = this.isShown = null;
                this.options.remote && this.$element.find(".modal-content").load(this.options.remote, n.proxy(function() {
                    this.$element.trigger("loaded.bs.modal")
                }, this))
            },
            i;
        t.DEFAULTS = {
            backdrop: !0,
            keyboard: !0,
            show: !0
        };
        t.prototype.toggle = function(n) {
            return this[this.isShown ? "hide" : "show"](n)
        };
        t.prototype.show = function(t) {
            var i = this,
                r = n.Event("show.bs.modal", {
                    relatedTarget: t
                });
            this.$element.trigger(r);
            this.isShown || r.isDefaultPrevented() || (this.isShown = !0, this.escape(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', n.proxy(this.hide, this)), this.backdrop(function() {
                var u = n.support.transition && i.$element.hasClass("fade"),
                    r;
                i.$element.parent().length || i.$element.appendTo(document.body);
                i.$element.show().scrollTop(0);
                u && i.$element[0].offsetWidth;
                i.$element.addClass("in").attr("aria-hidden", !1);
                i.enforceFocus();
                r = n.Event("shown.bs.modal", {
                    relatedTarget: t
                });
                u ? i.$element.find(".modal-dialog").one(n.support.transition.end, function() {
                    i.$element.focus().trigger(r)
                }).emulateTransitionEnd(300) : i.$element.focus().trigger(r)
            }))
        };
        t.prototype.hide = function(t) {
            t && t.preventDefault();
            t = n.Event("hide.bs.modal");
            this.$element.trigger(t);
            this.isShown && !t.isDefaultPrevented() && (this.isShown = !1, this.escape(), n(document).off("focusin.bs.modal"), this.$element.removeClass("in").attr("aria-hidden", !0).off("click.dismiss.bs.modal"), n.support.transition && this.$element.hasClass("fade") ? this.$element.one(n.support.transition.end, n.proxy(this.hideModal, this)).emulateTransitionEnd(300) : this.hideModal())
        };
        t.prototype.enforceFocus = function() {
            n(document).off("focusin.bs.modal").on("focusin.bs.modal", n.proxy(function(n) {
                this.$element[0] === n.target || this.$element.has(n.target).length || this.$element.focus()
            }, this))
        };
        t.prototype.escape = function() {
            this.isShown && this.options.keyboard ? this.$element.on("keyup.dismiss.bs.modal", n.proxy(function(n) {
                27 == n.which && this.hide()
            }, this)) : this.isShown || this.$element.off("keyup.dismiss.bs.modal")
        };
        t.prototype.hideModal = function() {
            var n = this;
            this.$element.hide();
            this.backdrop(function() {
                n.removeBackdrop();
                n.$element.trigger("hidden.bs.modal")
            })
        };
        t.prototype.removeBackdrop = function() {
            this.$backdrop && this.$backdrop.remove();
            this.$backdrop = null
        };
        t.prototype.backdrop = function(t) {
            var r = this.$element.hasClass("fade") ? "fade" : "",
                i;
            if (this.isShown && this.options.backdrop) {
                if (i = n.support.transition && r, this.$backdrop = n('<div class="modal-backdrop ' + r + '" />').appendTo(document.body), this.$element.on("click.dismiss.bs.modal", n.proxy(function(n) {
                        n.target === n.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus.call(this.$element[0]) : this.hide.call(this))
                    }, this)), i && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !t) return;
                i ? this.$backdrop.one(n.support.transition.end, t).emulateTransitionEnd(150) : t()
            } else !this.isShown && this.$backdrop ? (this.$backdrop.removeClass("in"), n.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one(n.support.transition.end, t).emulateTransitionEnd(150) : t()) : t && t()
        };
        i = n.fn.modal;
        n.fn.modal = function(i, r) {
            return this.each(function() {
                var f = n(this),
                    u = f.data("bs.modal"),
                    e = n.extend({}, t.DEFAULTS, f.data(), "object" == typeof i && i);
                u || f.data("bs.modal", u = new t(this, e));
                "string" == typeof i ? u[i](r) : e.show && u.show(r)
            })
        };
        n.fn.modal.Constructor = t;
        n.fn.modal.noConflict = function() {
            return n.fn.modal = i, this
        };
        n(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function(t) {
            var i = n(this),
                r = i.attr("href"),
                u = n(i.attr("data-target") || r && r.replace(/.*(?=#[^\s]+$)/, "")),
                f = u.data("bs.modal") ? "toggle" : n.extend({
                    remote: !/#/.test(r) && r
                }, u.data(), i.data());
            i.is("a") && t.preventDefault();
            u.modal(f, this).one("hide", function() {
                i.is(":visible") && i.focus()
            })
        });
        n(document).on("show.bs.modal", ".modal", function() {
            n(document.body).addClass("modal-open")
        }).on("hidden.bs.modal", ".modal", function() {
            n(document.body).removeClass("modal-open")
        })
    }(jQuery),
    function(n) {
        "use strict";
        var t = function(n, t) {
                this.type = this.options = this.enabled = this.timeout = this.hoverState = this.$element = null;
                this.init("tooltip", n, t)
            },
            i;
        t.DEFAULTS = {
            animation: !0,
            placement: "top",
            selector: !1,
            template: '<div class="tooltip"><div class="tooltip-arrow"><\/div><div class="tooltip-inner"><\/div><\/div>',
            trigger: "hover focus",
            title: "",
            delay: 0,
            html: !1,
            container: !1
        };
        t.prototype.init = function(t, i, r) {
            var f, e, u, o, s;
            for (this.enabled = !0, this.type = t, this.$element = n(i), this.options = this.getOptions(r), f = this.options.trigger.split(" "), e = f.length; e--;)
                if (u = f[e], "click" == u) this.$element.on("click." + this.type, this.options.selector, n.proxy(this.toggle, this));
                else "manual" != u && (o = "hover" == u ? "mouseenter" : "focusin", s = "hover" == u ? "mouseleave" : "focusout", this.$element.on(o + "." + this.type, this.options.selector, n.proxy(this.enter, this)), this.$element.on(s + "." + this.type, this.options.selector, n.proxy(this.leave, this)));
            this.options.selector ? this._options = n.extend({}, this.options, {
                trigger: "manual",
                selector: ""
            }) : this.fixTitle()
        };
        t.prototype.getDefaults = function() {
            return t.DEFAULTS
        };
        t.prototype.getOptions = function(t) {
            return t = n.extend({}, this.getDefaults(), this.$element.data(), t), t.delay && "number" == typeof t.delay && (t.delay = {
                show: t.delay,
                hide: t.delay
            }), t
        };
        t.prototype.getDelegateOptions = function() {
            var t = {},
                i = this.getDefaults();
            return this._options && n.each(this._options, function(n, r) {
                i[n] != r && (t[n] = r)
            }), t
        };
        t.prototype.enter = function(t) {
            var i = t instanceof this.constructor ? t : n(t.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type);
            if (clearTimeout(i.timeout), i.hoverState = "in", !i.options.delay || !i.options.delay.show) return i.show();
            i.timeout = setTimeout(function() {
                "in" == i.hoverState && i.show()
            }, i.options.delay.show)
        };
        t.prototype.leave = function(t) {
            var i = t instanceof this.constructor ? t : n(t.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type);
            if (clearTimeout(i.timeout), i.hoverState = "out", !i.options.delay || !i.options.delay.hide) return i.hide();
            i.timeout = setTimeout(function() {
                "out" == i.hoverState && i.hide()
            }, i.options.delay.hide)
        };
        t.prototype.show = function() {
            var h = n.Event("show.bs." + this.type),
                u, i, v, s;
            if (this.hasContent() && this.enabled) {
                if (this.$element.trigger(h), h.isDefaultPrevented()) return;
                u = this;
                i = this.tip();
                this.setContent();
                this.options.animation && i.addClass("fade");
                var t = "function" == typeof this.options.placement ? this.options.placement.call(this, i[0], this.$element[0]) : this.options.placement,
                    c = /\s?auto?\s?/i,
                    l = c.test(t);
                l && (t = t.replace(c, "") || "top");
                i.detach().css({
                    top: 0,
                    left: 0,
                    display: "block"
                }).addClass(t);
                this.options.container ? i.appendTo(this.options.container) : i.insertAfter(this.$element);
                var r = this.getPosition(),
                    f = i[0].offsetWidth,
                    e = i[0].offsetHeight;
                if (l) {
                    var o = this.$element.parent(),
                        y = t,
                        a = document.documentElement.scrollTop || document.body.scrollTop,
                        p = "body" == this.options.container ? window.innerWidth : o.outerWidth(),
                        w = "body" == this.options.container ? window.innerHeight : o.outerHeight(),
                        b = "body" == this.options.container ? 0 : o.offset().left;
                    t = "bottom" == t && r.top + r.height + e - a > w ? "top" : "top" == t && r.top - a - e < 0 ? "bottom" : "right" == t && r.right + f > p ? "left" : "left" == t && r.left - f < b ? "right" : t;
                    i.removeClass(y).addClass(t)
                }
                v = this.getCalculatedOffset(t, r, f, e);
                this.applyPlacement(v, t);
                this.hoverState = null;
                s = function() {
                    u.$element.trigger("shown.bs." + u.type)
                };
                n.support.transition && this.$tip.hasClass("fade") ? i.one(n.support.transition.end, s).emulateTransitionEnd(150) : s()
            }
        };
        t.prototype.applyPlacement = function(t, i) {
            var c, r = this.tip(),
                l = r[0].offsetWidth,
                e = r[0].offsetHeight,
                o = parseInt(r.css("margin-top"), 10),
                s = parseInt(r.css("margin-left"), 10),
                f, u, h;
            isNaN(o) && (o = 0);
            isNaN(s) && (s = 0);
            t.top = t.top + o;
            t.left = t.left + s;
            n.offset.setOffset(r[0], n.extend({
                using: function(n) {
                    r.css({
                        top: Math.round(n.top),
                        left: Math.round(n.left)
                    })
                }
            }, t), 0);
            r.addClass("in");
            f = r[0].offsetWidth;
            u = r[0].offsetHeight;
            ("top" == i && u != e && (c = !0, t.top = t.top + e - u), /bottom|top/.test(i)) ? (h = 0, t.left < 0 && (h = -2 * t.left, t.left = 0, r.offset(t), f = r[0].offsetWidth, u = r[0].offsetHeight), this.replaceArrow(h - l + f, f, "left")) : this.replaceArrow(u - e, u, "top");
            c && r.offset(t)
        };
        t.prototype.replaceArrow = function(n, t, i) {
            this.arrow().css(i, n ? 50 * (1 - n / t) + "%" : "")
        };
        t.prototype.setContent = function() {
            var n = this.tip(),
                t = this.getTitle();
            n.find(".tooltip-inner")[this.options.html ? "html" : "text"](t);
            n.removeClass("fade in top bottom left right")
        };
        t.prototype.hide = function() {
            function r() {
                "in" != t.hoverState && i.detach();
                t.$element.trigger("hidden.bs." + t.type)
            }
            var t = this,
                i = this.tip(),
                u = n.Event("hide.bs." + this.type);
            if (this.$element.trigger(u), !u.isDefaultPrevented()) return i.removeClass("in"), n.support.transition && this.$tip.hasClass("fade") ? i.one(n.support.transition.end, r).emulateTransitionEnd(150) : r(), this.hoverState = null, this
        };
        t.prototype.fixTitle = function() {
            var n = this.$element;
            (n.attr("title") || "string" != typeof n.attr("data-original-title")) && n.attr("data-original-title", n.attr("title") || "").attr("title", "")
        };
        t.prototype.hasContent = function() {
            return this.getTitle()
        };
        t.prototype.getPosition = function() {
            var t = this.$element[0];
            return n.extend({}, "function" == typeof t.getBoundingClientRect ? t.getBoundingClientRect() : {
                width: t.offsetWidth,
                height: t.offsetHeight
            }, this.$element.offset())
        };
        t.prototype.getCalculatedOffset = function(n, t, i, r) {
            return "bottom" == n ? {
                top: t.top + t.height,
                left: t.left + t.width / 2 - i / 2
            } : "top" == n ? {
                top: t.top - r,
                left: t.left + t.width / 2 - i / 2
            } : "left" == n ? {
                top: t.top + t.height / 2 - r / 2,
                left: t.left - i
            } : {
                top: t.top + t.height / 2 - r / 2,
                left: t.left + t.width
            }
        };
        t.prototype.getTitle = function() {
            var t = this.$element,
                n = this.options;
            return t.attr("data-original-title") || ("function" == typeof n.title ? n.title.call(t[0]) : n.title)
        };
        t.prototype.tip = function() {
            return this.$tip = this.$tip || n(this.options.template)
        };
        t.prototype.arrow = function() {
            return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
        };
        t.prototype.validate = function() {
            this.$element[0].parentNode || (this.hide(), this.$element = null, this.options = null)
        };
        t.prototype.enable = function() {
            this.enabled = !0
        };
        t.prototype.disable = function() {
            this.enabled = !1
        };
        t.prototype.toggleEnabled = function() {
            this.enabled = !this.enabled
        };
        t.prototype.toggle = function(t) {
            var i = t ? n(t.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type) : this;
            i.tip().hasClass("in") ? i.leave(i) : i.enter(i)
        };
        t.prototype.destroy = function() {
            clearTimeout(this.timeout);
            this.hide().$element.off("." + this.type).removeData("bs." + this.type)
        };
        i = n.fn.tooltip;
        n.fn.tooltip = function(i) {
            return this.each(function() {
                var u = n(this),
                    r = u.data("bs.tooltip"),
                    f = "object" == typeof i && i;
                (r || "destroy" != i) && (r || u.data("bs.tooltip", r = new t(this, f)), "string" == typeof i && r[i]())
            })
        };
        n.fn.tooltip.Constructor = t;
        n.fn.tooltip.noConflict = function() {
            return n.fn.tooltip = i, this
        }
    }(jQuery),
    function(n) {
        "use strict";
        var t = function(n, t) {
                this.init("popover", n, t)
            },
            i;
        if (!n.fn.tooltip) throw new Error("Popover requires tooltip.js");
        t.DEFAULTS = n.extend({}, n.fn.tooltip.Constructor.DEFAULTS, {
            placement: "right",
            trigger: "click",
            content: "",
            template: '<div class="popover"><div class="arrow"><\/div><h3 class="popover-title"><\/h3><div class="popover-content"><\/div><\/div>'
        });
        t.prototype = n.extend({}, n.fn.tooltip.Constructor.prototype);
        t.prototype.constructor = t;
        t.prototype.getDefaults = function() {
            return t.DEFAULTS
        };
        t.prototype.setContent = function() {
            var n = this.tip(),
                i = this.getTitle(),
                t = this.getContent();
            n.find(".popover-title")[this.options.html ? "html" : "text"](i);
            n.find(".popover-content")[this.options.html ? "string" == typeof t ? "html" : "append" : "text"](t);
            n.removeClass("fade top bottom left right in");
            n.find(".popover-title").html() || n.find(".popover-title").hide()
        };
        t.prototype.hasContent = function() {
            return this.getTitle() || this.getContent()
        };
        t.prototype.getContent = function() {
            var t = this.$element,
                n = this.options;
            return t.attr("data-content") || ("function" == typeof n.content ? n.content.call(t[0]) : n.content)
        };
        t.prototype.arrow = function() {
            return this.$arrow = this.$arrow || this.tip().find(".arrow")
        };
        t.prototype.tip = function() {
            return this.$tip || (this.$tip = n(this.options.template)), this.$tip
        };
        i = n.fn.popover;
        n.fn.popover = function(i) {
            return this.each(function() {
                var u = n(this),
                    r = u.data("bs.popover"),
                    f = "object" == typeof i && i;
                (r || "destroy" != i) && (r || u.data("bs.popover", r = new t(this, f)), "string" == typeof i && r[i]())
            })
        };
        n.fn.popover.Constructor = t;
        n.fn.popover.noConflict = function() {
            return n.fn.popover = i, this
        }
    }(jQuery),
    function(n) {
        "use strict";

        function t(i, r) {
            var u, f = n.proxy(this.process, this);
            this.$element = n(n(i).is("body") ? window : i);
            this.$body = n("body");
            this.$scrollElement = this.$element.on("scroll.bs.scroll-spy.data-api", f);
            this.options = n.extend({}, t.DEFAULTS, r);
            this.selector = (this.options.target || (u = n(i).attr("href")) && u.replace(/.*(?=#[^\s]+$)/, "") || "") + " .nav li > a";
            this.offsets = n([]);
            this.targets = n([]);
            this.activeTarget = null;
            this.refresh();
            this.process()
        }
        t.DEFAULTS = {
            offset: 10
        };
        t.prototype.refresh = function() {
            var i = this.$element[0] == window ? "offset" : "position",
                t;
            this.offsets = n([]);
            this.targets = n([]);
            t = this;
            this.$body.find(this.selector).map(function() {
                var f = n(this),
                    u = f.data("target") || f.attr("href"),
                    r = /^#./.test(u) && n(u);
                return r && r.length && r.is(":visible") && [
                    [r[i]().top + (!n.isWindow(t.$scrollElement.get(0)) && t.$scrollElement.scrollTop()), u]
                ] || null
            }).sort(function(n, t) {
                return n[0] - t[0]
            }).each(function() {
                t.offsets.push(this[0]);
                t.targets.push(this[1])
            })
        };
        t.prototype.process = function() {
            var n, i = this.$scrollElement.scrollTop() + this.options.offset,
                f = this.$scrollElement[0].scrollHeight || this.$body[0].scrollHeight,
                e = f - this.$scrollElement.height(),
                t = this.offsets,
                r = this.targets,
                u = this.activeTarget;
            if (i >= e) return u != (n = r.last()[0]) && this.activate(n);
            if (u && i <= t[0]) return u != (n = r[0]) && this.activate(n);
            for (n = t.length; n--;) u != r[n] && i >= t[n] && (!t[n + 1] || i <= t[n + 1]) && this.activate(r[n])
        };
        t.prototype.activate = function(t) {
            this.activeTarget = t;
            n(this.selector).parentsUntil(this.options.target, ".active").removeClass("active");
            var r = this.selector + '[data-target="' + t + '"],' + this.selector + '[href="' + t + '"]',
                i = n(r).parents("li").addClass("active");
            i.parent(".dropdown-menu").length && (i = i.closest("li.dropdown").addClass("active"));
            i.trigger("activate.bs.scrollspy")
        };
        var i = n.fn.scrollspy;
        n.fn.scrollspy = function(i) {
            return this.each(function() {
                var u = n(this),
                    r = u.data("bs.scrollspy"),
                    f = "object" == typeof i && i;
                r || u.data("bs.scrollspy", r = new t(this, f));
                "string" == typeof i && r[i]()
            })
        };
        n.fn.scrollspy.Constructor = t;
        n.fn.scrollspy.noConflict = function() {
            return n.fn.scrollspy = i, this
        };
        n(window).on("load", function() {
            n('[data-spy="scroll"]').each(function() {
                var t = n(this);
                t.scrollspy(t.data())
            })
        })
    }(jQuery),
    function(n) {
        "use strict";
        var t = function(t) {
                this.element = n(t)
            },
            i;
        t.prototype.show = function() {
            var t = this.element,
                e = t.closest("ul:not(.dropdown-menu)"),
                i = t.data("target"),
                r, u, f;
            (i || (i = t.attr("href"), i = i && i.replace(/.*(?=#[^\s]*$)/, "")), t.parent("li").hasClass("active")) || (r = e.find(".active:last a")[0], u = n.Event("show.bs.tab", {
                relatedTarget: r
            }), (t.trigger(u), u.isDefaultPrevented()) || (f = n(i), this.activate(t.parent("li"), e), this.activate(f, f.parent(), function() {
                t.trigger({
                    type: "shown.bs.tab",
                    relatedTarget: r
                })
            })))
        };
        t.prototype.activate = function(t, i, r) {
            function f() {
                u.removeClass("active").find("> .dropdown-menu > .active").removeClass("active");
                t.addClass("active");
                e ? (t[0].offsetWidth, t.addClass("in")) : t.removeClass("fade");
                t.parent(".dropdown-menu") && t.closest("li.dropdown").addClass("active");
                r && r()
            }
            var u = i.find("> .active"),
                e = r && n.support.transition && u.hasClass("fade");
            e ? u.one(n.support.transition.end, f).emulateTransitionEnd(150) : f();
            u.removeClass("in")
        };
        i = n.fn.tab;
        n.fn.tab = function(i) {
            return this.each(function() {
                var u = n(this),
                    r = u.data("bs.tab");
                r || u.data("bs.tab", r = new t(this));
                "string" == typeof i && r[i]()
            })
        };
        n.fn.tab.Constructor = t;
        n.fn.tab.noConflict = function() {
            return n.fn.tab = i, this
        };
        n(document).on("click.bs.tab.data-api", '[data-toggle="tab"], [data-toggle="pill"]', function(t) {
            t.preventDefault();
            n(this).tab("show")
        })
    }(jQuery),
    function(n) {
        "use strict";
        var t = function(i, r) {
                this.options = n.extend({}, t.DEFAULTS, r);
                this.$window = n(window).on("scroll.bs.affix.data-api", n.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", n.proxy(this.checkPositionWithEventLoop, this));
                this.$element = n(i);
                this.affixed = this.unpin = this.pinnedOffset = null;
                this.checkPosition()
            },
            i;
        t.RESET = "affix affix-top affix-bottom";
        t.DEFAULTS = {
            offset: 0
        };
        t.prototype.getPinnedOffset = function() {
            if (this.pinnedOffset) return this.pinnedOffset;
            this.$element.removeClass(t.RESET).addClass("affix");
            var n = this.$window.scrollTop(),
                i = this.$element.offset();
            return this.pinnedOffset = i.top - n
        };
        t.prototype.checkPositionWithEventLoop = function() {
            setTimeout(n.proxy(this.checkPosition, this), 1)
        };
        t.prototype.checkPosition = function() {
            var i, e, h;
            if (this.$element.is(":visible")) {
                var c = n(document).height(),
                    o = this.$window.scrollTop(),
                    s = this.$element.offset(),
                    r = this.options.offset,
                    f = r.top,
                    u = r.bottom;
                "top" == this.affixed && (s.top += o);
                "object" != typeof r && (u = f = r);
                "function" == typeof f && (f = r.top(this.$element));
                "function" == typeof u && (u = r.bottom(this.$element));
                i = !(null != this.unpin && o + this.unpin <= s.top) && (null != u && s.top + this.$element.height() >= c - u ? "bottom" : null != f && o <= f && "top");
                this.affixed !== i && (this.unpin && this.$element.css("top", ""), e = "affix" + (i ? "-" + i : ""), h = n.Event(e + ".bs.affix"), this.$element.trigger(h), h.isDefaultPrevented() || (this.affixed = i, this.unpin = "bottom" == i ? this.getPinnedOffset() : null, this.$element.removeClass(t.RESET).addClass(e).trigger(n.Event(e.replace("affix", "affixed"))), "bottom" == i && this.$element.offset({
                    top: c - u - this.$element.height()
                })))
            }
        };
        i = n.fn.affix;
        n.fn.affix = function(i) {
            return this.each(function() {
                var u = n(this),
                    r = u.data("bs.affix"),
                    f = "object" == typeof i && i;
                r || u.data("bs.affix", r = new t(this, f));
                "string" == typeof i && r[i]()
            })
        };
        n.fn.affix.Constructor = t;
        n.fn.affix.noConflict = function() {
            return n.fn.affix = i, this
        };
        n(window).on("load", function() {
            n('[data-spy="affix"]').each(function() {
                var i = n(this),
                    t = i.data();
                t.offset = t.offset || {};
                t.offsetBottom && (t.offset.bottom = t.offsetBottom);
                t.offsetTop && (t.offset.top = t.offsetTop);
                i.affix(t)
            })
        })
    }(jQuery),
    function(n) {
        "use strict";
        n.expr[":"].icontains = function(t, i, r) {
            return n(t).text().toUpperCase().indexOf(r[3].toUpperCase()) >= 0
        };
        var t = function(i, r, u) {
            u && (u.stopPropagation(), u.preventDefault());
            this.$element = n(i);
            this.$newElement = null;
            this.$button = null;
            this.$menu = null;
            this.$lis = null;
            this.options = n.extend({}, n.fn.selectpicker.defaults, this.$element.data(), "object" == typeof r && r);
            null === this.options.title && (this.options.title = this.$element.attr("title"));
            this.val = t.prototype.val;
            this.render = t.prototype.render;
            this.refresh = t.prototype.refresh;
            this.setStyle = t.prototype.setStyle;
            this.selectAll = t.prototype.selectAll;
            this.deselectAll = t.prototype.deselectAll;
            this.init()
        };
        t.prototype = {
            constructor: t,
            init: function() {
                var i = this,
                    t = this.$element.attr("id");
                this.$element.hide();
                this.multiple = this.$element.prop("multiple");
                this.autofocus = this.$element.prop("autofocus");
                this.$newElement = this.createView();
                this.$element.after(this.$newElement);
                this.$menu = this.$newElement.find("> .dropdown-menu");
                this.$button = this.$newElement.find("> button");
                this.$searchbox = this.$newElement.find("input");
                void 0 !== t && (this.$button.attr("data-id", t), n('label[for="' + t + '"]').click(function(n) {
                    n.preventDefault();
                    i.$button.focus()
                }));
                this.checkDisabled();
                this.clickListener();
                this.options.liveSearch && this.liveSearchListener();
                this.render();
                this.liHeight();
                this.setStyle();
                this.setWidth();
                this.options.container && this.selectPosition();
                this.$menu.data("this", this);
                this.$newElement.data("this", this)
            },
            createDropdown: function() {
                var t = this.multiple ? " show-tick" : "",
                    i = this.autofocus ? " autofocus" : "",
                    r = this.options.header ? '<div class="popover-title"><button type="button" class="close" aria-hidden="true">&times;<\/button>' + this.options.header + "<\/div>" : "",
                    u = this.options.liveSearch ? '<div class="bootstrap-select-searchbox"><input type="text" class="input-block-level form-control" /><\/div>' : "";
                return n('<div class="btn-group bootstrap-select' + t + '"><button type="button" class="btn dropdown-toggle selectpicker" data-toggle="dropdown"' + i + '><span class="filter-option pull-left"><\/span>&nbsp;<span class="caret"><\/span><\/button><div class="dropdown-menu open">' + r + u + '<ul class="dropdown-menu inner selectpicker" role="menu"><\/ul><\/div><\/div>')
            },
            createView: function() {
                var n = this.createDropdown(),
                    t = this.createLi();
                return n.find("ul").append(t), n
            },
            reloadLi: function() {
                this.destroyLi();
                var n = this.createLi();
                this.$menu.find("ul").append(n)
            },
            destroyLi: function() {
                this.$menu.find("li").remove()
            },
            createLi: function() {
                var i = this,
                    t = [],
                    r = "";
                return this.$element.find("option").each(function() {
                    var r = n(this),
                        f = r.attr("class") || "",
                        e = r.attr("style") || "",
                        u = r.data("content") ? r.data("content") : r.html(),
                        h = void 0 !== r.data("subtext") ? '<small class="muted text-muted">' + r.data("subtext") + "<\/small>" : "",
                        o = void 0 !== r.data("icon") ? '<i class="' + i.options.iconBase + " " + r.data("icon") + '"><\/i> ' : "";
                    if ("" !== o && (r.is(":disabled") || r.parent().is(":disabled")) && (o = "<span>" + o + "<\/span>"), r.data("content") || (u = o + '<span class="text">' + u + h + "<\/span>"), i.options.hideDisabled && (r.is(":disabled") || r.parent().is(":disabled"))) t.push('<a style="min-height: 0; padding: 0"><\/a>');
                    else if (r.parent().is("optgroup") && !0 !== r.data("divider"))
                        if (0 === r.index()) {
                            var s = r.parent().attr("label"),
                                c = void 0 !== r.parent().data("subtext") ? '<small class="muted text-muted">' + r.parent().data("subtext") + "<\/small>" : "",
                                l = r.parent().data("icon") ? '<i class="' + r.parent().data("icon") + '"><\/i> ' : "";
                            s = l + '<span class="text">' + s + c + "<\/span>";
                            0 !== r[0].index ? t.push('<div class="div-contain"><div class="divider"><\/div><\/div><dt>' + s + "<\/dt>" + i.createA(u, "opt " + f, e)) : t.push("<dt>" + s + "<\/dt>" + i.createA(u, "opt " + f, e))
                        } else t.push(i.createA(u, "opt " + f, e));
                    else !0 === r.data("divider") ? t.push('<div class="div-contain"><div class="divider"><\/div><\/div>') : !0 === n(this).data("hidden") ? t.push("") : t.push(i.createA(u, f, e))
                }), n.each(t, function(n, t) {
                    r += "<li rel=" + n + ">" + t + "<\/li>"
                }), this.multiple || 0 !== this.$element.find("option:selected").length || this.options.title || this.$element.find("option").eq(0).prop("selected", !0).attr("selected", "selected"), n(r)
            },
            createA: function(n, t, i) {
                return '<a tabindex="0" class="' + t + '" style="' + i + '">' + n + '<i class="' + this.options.iconBase + " " + this.options.tickIcon + ' icon-ok check-mark"><\/i><\/a>'
            },
            render: function(t) {
                var i = this,
                    r, u, f, e;
                !1 !== t && this.$element.find("option").each(function(t) {
                    i.setDisabled(t, n(this).is(":disabled") || n(this).parent().is(":disabled"));
                    i.setSelected(t, n(this).is(":selected"))
                });
                this.tabIndex();
                r = this.$element.find("option:selected").map(function() {
                    var r, t = n(this),
                        u = t.data("icon") && i.options.showIcon ? '<i class="' + i.options.iconBase + " " + t.data("icon") + '"><\/i> ' : "";
                    return r = i.options.showSubtext && t.attr("data-subtext") && !i.multiple ? ' <small class="muted text-muted">' + t.data("subtext") + "<\/small>" : "", t.data("content") && i.options.showContent ? t.data("content") : void 0 !== t.attr("title") ? t.attr("title") : u + t.html() + r
                }).toArray();
                u = this.multiple ? r.join(this.options.multipleSeparator) : r[0];
                this.multiple && this.options.selectedTextFormat.indexOf("count") > -1 && (f = this.options.selectedTextFormat.split(">"), e = this.options.hideDisabled ? ":not([disabled])" : "", (f.length > 1 && r.length > f[1] || 1 == f.length && r.length >= 2) && (u = this.options.countSelectedText.replace("{0}", r.length).replace("{1}", this.$element.find('option:not([data-divider="true"]):not([data-hidden="true"])' + e).length)));
                u || (u = void 0 !== this.options.title ? this.options.title : this.options.noneSelectedText);
                this.$button.attr("title", n.trim(u));
                this.$newElement.find(".filter-option").html(u)
            },
            setStyle: function(n, t) {
                this.$element.attr("class") && this.$newElement.addClass(this.$element.attr("class").replace(/selectpicker|mobile-device/gi, ""));
                var i = n || this.options.style;
                "add" == t ? this.$button.addClass(i) : "remove" == t ? this.$button.removeClass(i) : (this.$button.removeClass(this.options.style), this.$button.addClass(i))
            },
            liHeight: function() {
                var t = this.$menu.parent().clone().find("> .dropdown-toggle").prop("autofocus", !1).end().appendTo("body"),
                    n = t.addClass("open").find("> .dropdown-menu"),
                    i = n.find("li > a").outerHeight(),
                    r = this.options.header ? n.find(".popover-title").outerHeight() : 0,
                    u = this.options.liveSearch ? n.find(".bootstrap-select-searchbox").outerHeight() : 0;
                t.remove();
                this.$newElement.data("liHeight", i).data("headerHeight", r).data("searchHeight", u)
            },
            setSize: function() {
                var i, r, e, u = this,
                    t = this.$menu,
                    h = t.find(".inner"),
                    k = this.$newElement.outerHeight(),
                    c = this.$newElement.data("liHeight"),
                    l = this.$newElement.data("headerHeight"),
                    a = this.$newElement.data("searchHeight"),
                    d = t.find("li .divider").outerHeight(!0),
                    f = parseInt(t.css("padding-top")) + parseInt(t.css("padding-bottom")) + parseInt(t.css("border-top-width")) + parseInt(t.css("border-bottom-width")),
                    v = this.options.hideDisabled ? ":not(.disabled)" : "",
                    y = n(window),
                    o = f + parseInt(t.css("margin-top")) + parseInt(t.css("margin-bottom")) + 2,
                    p = function() {
                        r = u.$newElement.offset().top - y.scrollTop();
                        e = y.height() - r - k
                    },
                    s, w, b;
                (p(), this.options.header && t.css("padding-top", 0), "auto" == this.options.size) ? (s = function() {
                    var n;
                    p();
                    i = e - o;
                    u.options.dropupAuto && u.$newElement.toggleClass("dropup", r > e && i - o < t.height());
                    u.$newElement.hasClass("dropup") && (i = r - o);
                    n = t.find("li").length + t.find("dt").length > 3 ? 3 * c + o - 2 : 0;
                    t.css({
                        "max-height": i + "px",
                        overflow: "hidden",
                        "min-height": n + "px"
                    });
                    h.css({
                        "max-height": i - l - a - f + "px",
                        "overflow-y": "auto",
                        "min-height": n - f + "px"
                    })
                }, s(), n(window).resize(s), n(window).scroll(s)) : this.options.size && "auto" != this.options.size && t.find("li" + v).length > this.options.size && (w = t.find("li" + v + " > *").filter(":not(.div-contain)").slice(0, this.options.size).last().parent().index(), b = t.find("li").slice(0, w + 1).find(".div-contain").length, i = c * this.options.size + b * d + f, u.options.dropupAuto && this.$newElement.toggleClass("dropup", r > e && i < t.height()), t.css({
                    "max-height": i + l + a + "px",
                    overflow: "hidden"
                }), h.css({
                    "max-height": i - f + "px",
                    "overflow-y": "auto"
                }))
            },
            setWidth: function() {
                if ("auto" == this.options.width) {
                    this.$menu.css("min-width", "0");
                    var n = this.$newElement.clone().appendTo("body"),
                        t = n.find("> .dropdown-menu").css("width");
                    n.remove();
                    this.$newElement.css("width", t)
                } else "fit" == this.options.width ? (this.$menu.css("min-width", ""), this.$newElement.css("width", "").addClass("fit-width")) : this.options.width ? (this.$menu.css("min-width", ""), this.$newElement.css("width", this.options.width)) : (this.$menu.css("min-width", ""), this.$newElement.css("width", ""));
                this.$newElement.hasClass("fit-width") && "fit" !== this.options.width && this.$newElement.removeClass("fit-width")
            },
            selectPosition: function() {
                var r, f, i = this,
                    t = n("<div />"),
                    u = function(n) {
                        t.addClass(n.attr("class")).toggleClass("dropup", n.hasClass("dropup"));
                        r = n.offset();
                        f = n.hasClass("dropup") ? 0 : n[0].offsetHeight;
                        t.css({
                            top: r.top + f,
                            left: r.left,
                            width: n[0].offsetWidth,
                            position: "absolute"
                        })
                    };
                this.$newElement.on("click", function() {
                    u(n(this));
                    t.appendTo(i.options.container);
                    t.toggleClass("open", !n(this).hasClass("open"));
                    t.append(i.$menu)
                });
                n(window).resize(function() {
                    u(i.$newElement)
                });
                n(window).on("scroll", function() {
                    u(i.$newElement)
                });
                n("html").on("click", function(r) {
                    n(r.target).closest(i.$newElement).length < 1 && t.removeClass("open")
                })
            },
            mobile: function() {
                this.$element.addClass("mobile-device").appendTo(this.$newElement);
                this.options.container && this.$menu.hide()
            },
            refresh: function() {
                this.$lis = null;
                this.reloadLi();
                this.render();
                this.setWidth();
                this.setStyle();
                this.checkDisabled();
                this.liHeight()
            },
            update: function() {
                this.reloadLi();
                this.setWidth();
                this.setStyle();
                this.checkDisabled();
                this.liHeight()
            },
            setSelected: function(t, i) {
                null == this.$lis && (this.$lis = this.$menu.find("li"));
                n(this.$lis[t]).toggleClass("selected", i)
            },
            setDisabled: function(t, i) {
                null == this.$lis && (this.$lis = this.$menu.find("li"));
                i ? n(this.$lis[t]).addClass("disabled").find("a").attr("href", "#").attr("tabindex", -1) : n(this.$lis[t]).removeClass("disabled").find("a").removeAttr("href").attr("tabindex", 0)
            },
            isDisabled: function() {
                return this.$element.is(":disabled")
            },
            checkDisabled: function() {
                var n = this;
                this.isDisabled() ? this.$button.addClass("disabled").attr("tabindex", -1) : (this.$button.hasClass("disabled") && this.$button.removeClass("disabled"), -1 == this.$button.attr("tabindex") && (this.$element.data("tabindex") || this.$button.removeAttr("tabindex")));
                this.$button.click(function() {
                    return !n.isDisabled()
                })
            },
            tabIndex: function() {
                this.$element.is("[tabindex]") && (this.$element.data("tabindex", this.$element.attr("tabindex")), this.$button.attr("tabindex", this.$element.data("tabindex")))
            },
            clickListener: function() {
                var t = this;
                n("body").on("touchstart.dropdown", ".dropdown-menu", function(n) {
                    n.stopPropagation()
                });
                this.$newElement.on("click", function() {
                    t.setSize();
                    t.options.liveSearch || t.multiple || setTimeout(function() {
                        t.$menu.find(".selected a").focus()
                    }, 10)
                });
                this.$menu.on("click", "li a", function(i) {
                    var r = n(this).parent().index(),
                        o = t.$element.val(),
                        s = t.$element.prop("selectedIndex");
                    if (t.multiple && i.stopPropagation(), i.preventDefault(), !t.isDisabled() && !n(this).parent().hasClass("disabled")) {
                        var f = t.$element.find("option"),
                            u = f.eq(r),
                            e = u.prop("selected");
                        t.multiple ? (u.prop("selected", !e), t.setSelected(r, !e)) : (f.prop("selected", !1), u.prop("selected", !0), t.$menu.find(".selected").removeClass("selected"), t.setSelected(r, !0));
                        t.multiple ? t.options.liveSearch && t.$searchbox.focus() : t.$button.focus();
                        (o != t.$element.val() && t.multiple || s != t.$element.prop("selectedIndex") && !t.multiple) && t.$element.change()
                    }
                });
                this.$menu.on("click", "li.disabled a, li dt, li .div-contain, .popover-title, .popover-title :not(.close)", function(n) {
                    n.target == this && (n.preventDefault(), n.stopPropagation(), t.options.liveSearch ? t.$searchbox.focus() : t.$button.focus())
                });
                this.$menu.on("click", ".popover-title .close", function() {
                    t.$button.focus()
                });
                this.$searchbox.on("click", function(n) {
                    n.stopPropagation()
                });
                this.$element.change(function() {
                    t.render(!1)
                })
            },
            liveSearchListener: function() {
                var t = this,
                    i = n('<li class="no-results"><\/li>');
                this.$newElement.on("click.dropdown.data-api", function() {
                    t.$menu.find(".active").removeClass("active");
                    t.$searchbox.val() && (t.$searchbox.val(""), t.$menu.find("li").show(), i.parent().length && i.remove());
                    t.multiple || t.$menu.find(".selected").addClass("active");
                    setTimeout(function() {
                        t.$searchbox.focus()
                    }, 10)
                });
                this.$searchbox.on("input propertychange", function() {
                    t.$searchbox.val() ? (t.$menu.find("li").show().not(":icontains(" + t.$searchbox.val() + ")").hide(), t.$menu.find("li").filter(":visible:not(.no-results)").length ? i.parent().length && i.remove() : (i.parent().length && i.remove(), i.html(t.options.noneResultsText + ' "' + t.$searchbox.val() + '"').show(), t.$menu.find("li").last().after(i))) : (t.$menu.find("li").show(), i.parent().length && i.remove());
                    t.$menu.find("li.active").removeClass("active");
                    t.$menu.find("li").filter(":visible:not(.divider)").eq(0).addClass("active").find("a").focus();
                    n(this).focus()
                });
                this.$menu.on("mouseenter", "a", function(i) {
                    t.$menu.find(".active").removeClass("active");
                    n(i.currentTarget).parent().not(".disabled").addClass("active")
                });
                this.$menu.on("mouseleave", "a", function() {
                    t.$menu.find(".active").removeClass("active")
                })
            },
            val: function(n) {
                return void 0 !== n ? (this.$element.val(n), this.$element.change(), this.$element) : this.$element.val()
            },
            selectAll: function() {
                this.$element.find("option").prop("selected", !0).attr("selected", "selected");
                this.render()
            },
            deselectAll: function() {
                this.$element.find("option").prop("selected", !1).removeAttr("selected");
                this.render()
            },
            keydown: function(t) {
                var f, r, o, i, h, c, l, v, y, u, p, s, w = {
                        32: " ",
                        48: "0",
                        49: "1",
                        50: "2",
                        51: "3",
                        52: "4",
                        53: "5",
                        54: "6",
                        55: "7",
                        56: "8",
                        57: "9",
                        59: ";",
                        65: "a",
                        66: "b",
                        67: "c",
                        68: "d",
                        69: "e",
                        70: "f",
                        71: "g",
                        72: "h",
                        73: "i",
                        74: "j",
                        75: "k",
                        76: "l",
                        77: "m",
                        78: "n",
                        79: "o",
                        80: "p",
                        81: "q",
                        82: "r",
                        83: "s",
                        84: "t",
                        85: "u",
                        86: "v",
                        87: "w",
                        88: "x",
                        89: "y",
                        90: "z",
                        96: "0",
                        97: "1",
                        98: "2",
                        99: "3",
                        100: "4",
                        101: "5",
                        102: "6",
                        103: "7",
                        104: "8",
                        105: "9"
                    },
                    e, b, a;
                (f = n(this), o = f.parent(), f.is("input") && (o = f.parent().parent()), u = o.data("this"), u.options.liveSearch && (o = f.parent().parent()), u.options.container && (o = u.$menu), r = n("[role=menu] li:not(.divider) a", o), s = u.$menu.parent().hasClass("open"), !s && /([0-9]|[A-z])/.test(String.fromCharCode(t.keyCode)) && (u.setSize(), u.$menu.parent().addClass("open"), s = u.$menu.parent().hasClass("open"), u.$searchbox.focus()), u.options.liveSearch && (/(^9$|27)/.test(t.keyCode) && s && 0 === u.$menu.find(".active").length && (t.preventDefault(), u.$menu.parent().removeClass("open"), u.$button.focus()), r = n("[role=menu] li:not(.divider):visible", o), f.val() || /(38|40)/.test(t.keyCode) || 0 === r.filter(".active").length && (r = u.$newElement.find("li").filter(":icontains(" + w[t.keyCode] + ")"))), r.length) && (/(38|40)/.test(t.keyCode) ? (i = r.index(r.filter(":focus")), c = r.parent(":not(.disabled):visible").first().index(), l = r.parent(":not(.disabled):visible").last().index(), h = r.eq(i).parent().nextAll(":not(.disabled):visible").eq(0).index(), v = r.eq(i).parent().prevAll(":not(.disabled):visible").eq(0).index(), y = r.eq(h).parent().prevAll(":not(.disabled):visible").eq(0).index(), u.options.liveSearch && (r.each(function(t) {
                    n(this).is(":not(.disabled)") && n(this).data("index", t)
                }), i = r.index(r.filter(".active")), c = r.filter(":not(.disabled):visible").first().data("index"), l = r.filter(":not(.disabled):visible").last().data("index"), h = r.eq(i).nextAll(":not(.disabled):visible").eq(0).data("index"), v = r.eq(i).prevAll(":not(.disabled):visible").eq(0).data("index"), y = r.eq(h).prevAll(":not(.disabled):visible").eq(0).data("index")), p = f.data("prevIndex"), 38 == t.keyCode && (u.options.liveSearch && (i -= 1), i != y && i > v && (i = v), i < c && (i = c), i == p && (i = l)), 40 == t.keyCode && (u.options.liveSearch && (i += 1), -1 == i && (i = 0), i != y && i < h && (i = h), i > l && (i = l), i == p && (i = c)), f.data("prevIndex", i), u.options.liveSearch ? (t.preventDefault(), f.is(".dropdown-toggle") || (r.removeClass("active"), r.eq(i).addClass("active").find("a").focus(), f.focus())) : r.eq(i).focus()) : f.is("input") || (a = [], r.each(function() {
                    n(this).parent().is(":not(.disabled)") && n.trim(n(this).text().toLowerCase()).substring(0, 1) == w[t.keyCode] && a.push(n(this).parent().index())
                }), e = n(document).data("keycount"), e++, n(document).data("keycount", e), b = n.trim(n(":focus").text().toLowerCase()).substring(0, 1), b != w[t.keyCode] ? (e = 1, n(document).data("keycount", e)) : e >= a.length && (n(document).data("keycount", 0), e > a.length && (e = 1)), r.eq(a[e - 1]).focus()), /(13|32|^9$)/.test(t.keyCode) && s && (/(32)/.test(t.keyCode) || t.preventDefault(), u.options.liveSearch ? /(32)/.test(t.keyCode) || (u.$menu.find(".active a").click(), f.focus()) : n(":focus").click(), n(document).data("keycount", 0)), (/(^9$|27)/.test(t.keyCode) && s && (u.multiple || u.options.liveSearch) || /(27)/.test(t.keyCode) && !s) && (u.$menu.parent().removeClass("open"), u.$button.focus()))
            },
            hide: function() {
                this.$newElement.hide()
            },
            show: function() {
                this.$newElement.show()
            },
            destroy: function() {
                this.$newElement.remove();
                this.$element.remove()
            }
        };
        n.fn.selectpicker = function(i, r) {
            var u, f = arguments,
                e = this.each(function() {
                    var h, s;
                    if (n(this).is("select")) {
                        var c = n(this),
                            e = c.data("selectpicker"),
                            o = "object" == typeof i && i;
                        if (e) {
                            if (o)
                                for (h in o) e.options[h] = o[h]
                        } else c.data("selectpicker", e = new t(this, o, r));
                        "string" == typeof i && (s = i, e[s] instanceof Function ? ([].shift.apply(f), u = e[s].apply(e, f)) : u = e.options[s])
                    }
                });
            return void 0 !== u ? u : e
        };
        n.fn.selectpicker.defaults = {
            style: "btn-default",
            size: "auto",
            title: null,
            selectedTextFormat: "values",
            noneSelectedText: "Nothing selected",
            noneResultsText: "No results match",
            countSelectedText: "{0} of {1} selected",
            width: !1,
            container: !1,
            hideDisabled: !1,
            showSubtext: !1,
            showIcon: !0,
            showContent: !0,
            dropupAuto: !0,
            header: !1,
            liveSearch: !1,
            multipleSeparator: ", ",
            iconBase: "glyphicon",
            tickIcon: "glyphicon-ok"
        };
        n(document).data("keycount", 0).on("keydown", ".bootstrap-select [data-toggle=dropdown], .bootstrap-select [role=menu], .bootstrap-select-searchbox input", t.prototype.keydown).on("focusin.modal", ".bootstrap-select [data-toggle=dropdown], .bootstrap-select [role=menu], .bootstrap-select-searchbox input", function(n) {
            n.stopPropagation()
        })
    }(window.jQuery),
    function(n) {
        function t(t) {
            var f = n(this),
                r = null,
                u = [],
                e = null,
                o = null,
                i = n.extend({
                    rowSelector: "> li",
                    submenuSelector: "*",
                    submenuDirection: "right",
                    tolerance: 75,
                    enter: n.noop,
                    exit: n.noop,
                    activate: n.noop,
                    deactivate: n.noop,
                    exitMenu: n.noop
                }, t),
                c = function(n) {
                    u.push({
                        x: n.pageX,
                        y: n.pageY
                    });
                    u.length > 3 && u.shift()
                },
                l = function() {
                    o && clearTimeout(o);
                    i.exitMenu(this) && (r && i.deactivate(r), r = null)
                },
                a = function() {
                    o && clearTimeout(o);
                    i.enter(this);
                    h(this)
                },
                v = function() {
                    i.exit(this)
                },
                y = function() {
                    s(this)
                },
                s = function(n) {
                    n != r && (r && i.deactivate(r), i.activate(n), r = n)
                },
                h = function(n) {
                    var t = p();
                    t ? o = setTimeout(function() {
                        h(n)
                    }, t) : s(n)
                },
                p = function() {
                    function l(n, t) {
                        return (t.y - n.y) / (t.x - n.x)
                    }
                    var h, c;
                    if (!r || !n(r).is(i.submenuSelector)) return 0;
                    var t = f.offset(),
                        v = {
                            x: t.left,
                            y: t.top - i.tolerance
                        },
                        p = {
                            x: t.left + f.outerWidth(),
                            y: v.y
                        },
                        y = {
                            x: t.left,
                            y: t.top + f.outerHeight() + i.tolerance
                        },
                        a = {
                            x: t.left + f.outerWidth(),
                            y: y.y
                        },
                        s = u[u.length - 1],
                        o = u[0];
                    if (!s || (o || (o = s), o.x < t.left || o.x > a.x || o.y < t.top || o.y > a.y) || e && s.x == e.x && s.y == e.y) return 0;
                    h = p;
                    c = a;
                    "left" == i.submenuDirection ? (h = y, c = v) : "below" == i.submenuDirection ? (h = a, c = y) : "above" == i.submenuDirection && (h = v, c = p);
                    var w = l(s, h),
                        b = l(s, c),
                        k = l(o, h),
                        d = l(o, c);
                    return w < k && b > d ? (e = s, 200) : (e = null, 0)
                };
            f.mouseleave(l).find(i.rowSelector).mouseenter(a).mouseleave(v).click(y);
            n(document).mousemove(c)
        }
        n.fn.menuAim = function(n) {
            return this.each(function() {
                t.call(this, n)
            }), this
        }
    }(jQuery),
    function(n) {
        n.fn.sticky = function(t) {
            var r = {
                offset: 20,
                mode: "fixed",
                stopper: "",
                speed: 500,
                classes: {
                    element: "jquery-sticky-element",
                    start: "jquery-sticky-start",
                    sticky: "jquery-sticky-sticky",
                    stopped: "jquery-sticky-stopped",
                    placeholder: "jquery-sticky-placeholder"
                },
                onStick: "",
                onStart: "",
                onStop: ""
            };
            this.each(function() {
                if (t && n.extend(r, t), !n(this).parent().hasClass(r.classes.element)) {
                    var u = {
                        init: function(t) {
                            if (u.element = t.wrap('<div class="' + r.classes.element + '" />').parent(), u.units = {
                                    start: u.element.offset().top
                                }, r.states = [r.classes.start, r.classes.sticky, r.classes.stopped].join(" "), "" != r.stopper) {
                                var e, f = n(r.stopper);
                                if (f.length > 0)
                                    for (i = 0; i < f.length && void 0 === u.stopper; i++) n(f[i]).offset().top > u.element.offset().top + u.element.outerHeight(!1) && (u.stopper = n(f[i]));
                                void 0 !== u.stopper && u.stopper.length > 0 && (e = parseInt(u.stopper.css("margin-top")) || 0, u.units.stop = u.stopper.offset().top - e)
                            }
                            u.placeholder = u.element.clone().empty().attr("class", r.classes.placeholder).css({
                                opacity: 0,
                                height: u.element.height()
                            }).insertBefore(u.element);
                            u.element.appendTo("body").css({
                                width: u.placeholder.width(),
                                left: u.placeholder.offset().left,
                                top: u.placeholder.offset().top,
                                "margin-bottom": "0px",
                                position: "absolute",
                                "z-index": "999"
                            });
                            n(window).bind("resize scroll", function() {
                                u.update()
                            });
                            u.update()
                        },
                        update: function() {
                            var t;
                            u.element.css({
                                width: u.placeholder.width(),
                                left: u.placeholder.offset().left
                            });
                            u.placeholder.css("height", u.element.height());
                            u.units.start = u.placeholder.offset().top;
                            u.element.outerHeight(!1) + r.offset < n(window).height() ? (u.units.doctop = n(document).scrollTop(), u.element.hasClass(r.classes.sticky) && "animate" == r.mode && u.animate(u.units.doctop + r.offset), void 0 !== u.stopper && u.stopper.length > 0 && (t = parseInt(u.stopper.css("margin-top")) || 0, u.units.stop = u.stopper.offset().top - t), !u.element.hasClass(r.classes.stopped) && void 0 !== u.stopper && u.stopper.length > 0 && u.units.doctop + r.offset + u.element.outerHeight(!1) >= u.units.stop ? (u.stop(u.units.stop - u.element.outerHeight(!1), "stop"), "function" == typeof r.onStop && r.onStop()) : !u.element.hasClass(r.classes.sticky) && u.units.doctop > u.units.start - r.offset && (void 0 === u.stopper || 0 == u.stopper.length || u.stopper.length > 0 && u.units.doctop + r.offset + u.element.outerHeight(!1) < u.units.stop) ? (u.stick(r.offset), "animate" == r.mode && u.animate(u.units.doctop + r.offset), "function" == typeof r.onStick && r.onStick()) : u.units.doctop <= u.units.start - r.offset && (u.stop(u.units.start, "start"), "function" == typeof r.onStart && r.onStart())) : u.element.hasClass(r.classes.start) || u.stop(u.units.start, "start")
                        },
                        animate: function(n) {
                            clearTimeout(u.timer);
                            u.timer = setTimeout(function() {
                                n >= u.units.stop ? n = u.units.stop - u.element.outerHeight(!1) : n <= u.units.start && (n = u.units.start);
                                u.element.stop().animate({
                                    top: n
                                }, r.speed)
                            }, 100)
                        },
                        stick: function(n) {
                            u.element.removeClass(r.states).addClass(r.classes.sticky);
                            "fixed" == r.mode && u.element.css({
                                top: n,
                                position: "fixed"
                            })
                        },
                        stop: function(n, t) {
                            u.element.removeClass(r.states).addClass("start" == t ? r.classes.start : r.classes.stopped);
                            "fixed" == r.mode ? u.element.css({
                                top: n,
                                position: "absolute"
                            }) : u.animate("start" == t ? u.units.start : u.units.stop - u.element.outerHeight(!1))
                        }
                    };
                    u.init(n(this))
                }
            })
        }
    }(jQuery);
$(document).ready(function() {
    if ($(".sidebar-first-level").menuAim({
            activate: function(n) {
                $(n).addClass("active");
                $(n).find(".sidebar-second-level").show()
            },
            deactivate: function(n) {
                $(n).removeClass("active");
                $(n).find(".sidebar-second-level").hide()
            },
            exitMenu: function() {
                return !0
            }
        }), $("#SelectProdOptionIPN").length > 0 && window.location.hash && "true" == $("#FirstLoad").val()) {
        $("#FirstLoad").val("false");
        var n = window.location.hash.substring(1);
        $("#SelectProdOptionIPN").val(n);
        $("#SelectProdOptionIPN").closest("form").submit()
    }
});
window.TSS || (window.TSS = {});
window.TSS.changeImageNumber = function() {

    $("#imageCount").length && ($("#currentImageNumber").html($(".image-toggler.active").attr("id").substr($(".image-toggler.active").attr("id").indexOf("-") + 1)), $(".imageText").text($(".image-toggler.active").parent(".gallery-thumnail-wrapper").find(".imageText-hidden").text()));
    $(document).trigger("mainImageDataSrcSet")
};
window.TSS.changeToNextImage = function() {
    parseInt($("#currentImageNumber").html()) == parseInt($("#totalImageNumber").html()) ? ($("#gallery-video-embedded").is(":visible") && ($("#gallery-video-controls").addClass("hidden"), $(".gallery-main-image .image-toggle").removeClass("hidden"), $("#gallery-video-embedded").addClass("hidden"), $("#fs-alt-button").addClass("hidden"), $("#gallery-video-embedded")[0].contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', "*")), $(".image-toggler.active").removeClass("active"), $(".image-toggler").first().addClass("active"), $(".image-toggle").attr("src", $(".image-toggler.active").attr("src")), $(".imageText").text($(".image-toggler.active").parent(".gallery-thumnail-wrapper").find(".imageText-hidden").text()), 0 != $(".video-toggler.active").length ? $("#gallery-video-controls").removeClass("hidden") : $("#gallery-video-controls").addClass("hidden")) : ($(".image-toggler.active").removeClass("active").parent().parent().next().find(".image-toggler").addClass("active"), $(".image-toggle", $(".image-toggler.active").closest("section")).attr("src", $(".image-toggler.active").attr("src")), $(".imageText").text($(".image-toggler.active").parent(".gallery-thumnail-wrapper").find(".imageText-hidden").text()), 0 != $(".video-toggler.active").length ? $("#gallery-video-controls").removeClass("hidden") : $("#gallery-video-controls").addClass("hidden"), $("#gallery-video-embedded").is(":visible") && ($("#gallery-video-controls").addClass("hidden"), $(".gallery-main-image .image-toggle").removeClass("hidden"), $("#gallery-video-embedded").addClass("hidden"), $("#fs-alt-button").addClass("hidden"), $("#gallery-video-embedded")[0].contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', "*")));
    $(".image-overlay").is(":visible") && $(".image-overlay").hide();
    window.TSS.changeImageNumber()
};
window.TSS.changeToPrevImage = function() {
    1 == parseInt($("#currentImageNumber").html()) ? ($(".image-toggler.active").removeClass("active"), $(".image-toggler").last().addClass("active"), $(".image-toggle").attr("src", $(".image-toggler.active").attr("src")), $(".imageText").text($(".image-toggler.active").parent(".gallery-thumnail-wrapper").find(".imageText-hidden").text()), 0 != $(".video-toggler.active").length ? $("#gallery-video-controls").removeClass("hidden") : $("#gallery-video-controls").addClass("hidden"), $("#gallery-video-embedded").is(":visible") && ($("#gallery-video-controls").addClass("hidden"), $(".gallery-main-image .image-toggle").removeClass("hidden"), $("#gallery-video-embedded").addClass("hidden"), $("#fs-alt-button").addClass("hidden"), $("#gallery-video-embedded")[0].contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', "*"))) : ($(".image-toggler.active").removeClass("active").parent().parent().prev().find(".image-toggler").addClass("active"), $(".image-toggle", $(".image-toggler.active").closest("section")).attr("src", $(".image-toggler.active").attr("src")), $(".imageText").text($(".image-toggler.active").parent(".gallery-thumnail-wrapper").find(".imageText-hidden").text()), 0 != $(".video-toggler.active").length ? $("#gallery-video-controls").removeClass("hidden") : $("#gallery-video-controls").addClass("hidden"), $("#gallery-video-embedded").is(":visible") && ($("#gallery-video-controls").addClass("hidden"), $(".gallery-main-image .image-toggle").removeClass("hidden"), $("#gallery-video-embedded").addClass("hidden"), $("#fs-alt-button").addClass("hidden"), $("#gallery-video-embedded")[0].contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', "*")));
    $(".image-overlay").is(":visible") && $(".image-overlay").hide();
    window.TSS.changeImageNumber()
};

window.TSS.ConfigureProductPage = function() {
    $(function() {
        if ($(".selectpicker").selectpicker(), "true" == $("#runSizeSelectionTest").val()) {
            var t = $("[data-id=sizePicker]").siblings(".dropdown-menu").children(".inner"),
                n = t.children("li.selected");
            "false" === $("#SizeOptionChanged").val() ? ($(".add-to-cart").data("origtext", $(".add-to-cart").text()).text("Please Select a Size").addClass("pleaseSelect").attr("disabled", "disabled"), $("[data-id=sizePicker]").children(".filter-option").text("Select a Size")) : "true" === $("#SizeOptionChanged").val() && $("[data-id=sizePicker]").children(".filter-option").text(n.text());
            t.on("click", function() {
                $("#SizeOptionChanged").val("true")
            });
            n.on("click", function() {
                $(".add-to-cart").text($(".add-to-cart").data("origtext") || "Add to Cart").removeClass("pleaseSelect").removeAttr("disabled");
                $("[data-id=sizePicker]").children(".filter-option").text(n.text());
                $("#SizeOptionChanged").val("true")
            })
        }
        $(".image-toggler").click(function() {
		
            $(".image-toggler.active").removeClass("active");
            $(this).addClass("active");
            $(".image-toggle", $(this).closest("section")).attr("src", $(this).attr("src"));
            0 != $(".video-toggler.active").length ? $("#gallery-video-controls").removeClass("hidden") : $("#gallery-video-controls").addClass("hidden");
            $("#gallery-video-embedded").is(":visible") && ($("#gallery-video-controls").addClass("hidden"), $(".gallery-main-image .image-toggle").removeClass("hidden"), $("#gallery-video-embedded").addClass("hidden"), $("#fs-alt-button").addClass("hidden"), $("#gallery-video-embedded")[0].contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', "*"));
            $("#imageCount").length && window.TSS.changeImageNumber()
        }).first().click();
        $("#imageThumbnailCarousel").height() < $("#imageThumbnailMask").height() && ($("#imageThumbnail-ScrollUp").css("visibility", "hidden"), $("#imageThumbnail-ScrollDown").css("visibility", "hidden"));
        $(".dropdown-menu li a").click(function() {
            $(this).parents(".btn-group").find(".selection").text($(this).text());
            $(this).parents(".btn-group").find(".selection").val($(this).text())
        });
        $("#Quantity").change(function() {
            var n = $("#shipping-calc-iframe")[0];
            n && (n.src = n.src.replace(/qty=[0-9]+/, "qty=" + $(this).val()));
            $("#formqty").val($(this).val())
        })
    })
};
$(function() {
        $(".product-page").delegate("[data-ajax-submit]", "change", function() {
            $(this).closest("form").submit()
        });
        $(".product-page").delegate("[data-update-input]", "change click", function() {
            var n = $(this),
                t = n.attr("data-update-input"),
                i = n.val();
            n.closest("form").find("input[name=" + t + "]").val(i).change()
        });
        $(".product-page").delegate("[data-select-option]", "click", function() {
            var n = $(this).attr("data-select-option");
            $("#SelectOption").val(n).closest("form").submit()
        });
        $(".product-page").delegate("[data-select-attribute]", "click", function() {
            var n = $(this).attr("data-select-attribute");
            $("#SelectAttribute").val(n).closest("form").submit()
        });
        $(".product-page").delegate("button[data-ajax-cart]", "click", function(n) {
            n.preventDefault();
            $.post("/cart", $("#AddToCartForm").serialize()).success(function(n) {
                $("#addToCartResult").html(n)
            }).error(function(n) {
                $("#addToCartResult").html(n)
            })
        })
    }),
    function() {
        $(function() {
            $("#mobile-menu-out-toggle").click(function() {
                $("body").toggleClass("shift-right");
                $("#add-to-cart-floating").css("position", "fixed")
            });
            $("#mobile-menu-out-toggle").click(function() {
                $("body").toggleClass("shift-right");
                $("#add-to-cart-floating").css("position", "fixed")
            });
            $("#search-menu-toggle").click(function() {
				
                $("body").toggleClass("show-search");
                $("#sitewideBanner").toggleClass("search-margin")
            })
        })
    }();
window.TSS || (window.TSS = {});
window._ || (window._ = {});
_.now = Date.now || function() {
    return (new Date).getTime()
};
_.debounce = function(n, t, i) {
    var r, u, f, o, e, s = function() {
        var h = _.now() - o;
        h < t && h > 0 ? r = setTimeout(s, t - h) : (r = null, i || (e = n.apply(f, u), r || (f = u = null)))
    };
    return function() {
        f = this;
        u = arguments;
        o = _.now();
        var h = i && !r;
        return r || (r = setTimeout(s, t)), h && (e = n.apply(f, u), f = u = null), e
    }
};
_.throttle = function(n, t, i) {
    var u, f, o, r = null,
        e = 0,
        s;
    return i || (i = {}), s = function() {
            e = !1 === i.leading ? 0 : _.now();
            r = null;
            o = n.apply(u, f);
            r || (u = f = null)
        },
        function() {
            var c = _.now(),
                h;
            return e || !1 !== i.leading || (e = c), h = t - (c - e), u = this, f = arguments, h <= 0 || h > t ? (clearTimeout(r), r = null, e = c, o = n.apply(u, f), r || (u = f = null)) : r || !1 === i.trailing || (r = setTimeout(s, h)), o
        }
};
window.TSS.ConfigureLegendSelection = function() {
    $(function() {
        var u = $("#legendform"),
            i = $("input[name$=Quantity]", "[data-option-active]"),
            r = $(".summary-head"),
            t = $("input[type=submit]", ".summary-head"),
            n = $(".summary");
        ! function() {
            var f = function() {
                var s = $(this),
                    e = s.val(),
                    l = e && e.length > 0 && parseInt(e) > 0,
                    h = s.valid(),
                    c = l ? "True" : "False",
                    o, u, f;
                (!h && e && (c = "Invalid"), s.closest("[data-option-active]").attr("data-option-active", c), h) ? (t.removeAttr("disabled"), o = 0, u = 0, (i.each(function() {
                    var n = parseInt("0" + $(this).val());
                    o += n;
                    u += n > 0 ? 1 : 0
                }), 1 == u) ? (f = "", n.html("You have selected a total of <b>" + o + "<\/b> signs." + f)) : u > 1 ? (f = "", n.html("You have selected <b>" + u + "<\/b> types of legends for a combined quantity of <b>" + o + "<\/b> signs." + f)) : (n.html("Please enter quantities for each type of sign you wish to purchase."), t.attr("disabled", "disabled")), r.addClass("bg-info").removeClass("bg-warning").removeClass("bg-danger")) : (n.html("Oops! Please correct any of the quantities outlined in <span style='color:red;'>red<\/span> before submitting your order."), t.attr("disabled", "disabled"), r.addClass("bg-danger").removeClass("bg-warning").removeClass("bg-info"))
            };
            u.delegate("input[name$=Quantity]", "change keyup", f)
        }();
        $("[data-option-active]").click(function() {
            $("input", this).focus()
        });
        i.change();
        $(function() {
            var t = $(".summary-head"),
                r = $(".main.container"),
                e = t.next(),
                n, i, u, f;
            t.affix({
                offset: {
                    top: function() {
                        return e.offset().top - t.outerHeight()
                    }
                }
            });
            n = $(".volume-pricing-sticky");
            i = function(n) {
                var i = $(n),
                    n = i[0],
                    r = i.closest(".panel-body");
                n._affixTop = r.offset().top;
                n._affixBottom = r.offset().top + r.outerHeight(!0) - (i.outerHeight(!0) + t.outerHeight(!0))
            };
            n.each(function(n, t) {
                i(t)
            });
            $(window).on("addRelatedProductToLegendPage", function() {
                n.each(function(n, t) {
                    i(t)
                })
            });
            u = function() {
                var t, r, i, n = window.pageYOffset || $(window).scrollTop(),
                    u = !0,
                    f;
                ($("#mobile-header").is(":visible") && 45, $(".optionGroupSelectionContainer").each(function(f, e) {
                    if (t = $(e).offset().top - 10, r = t + $(e).height(), i = $(e).attr("id"), t <= n && r > n) {
                        if (window.history.replaceState) {
                            var o = window.location.href.replace(/[#,?].*$/, "") + "#" + i;
                            window.history.replaceState({}, "", o)
                        } else window.location.search = "", window.location.hash = "#" + i;
                        u = !1
                    }
                }), u) && (window.history.replaceState ? (f = window.location.href.replace(/[#,?].*$/, ""), window.history.replaceState({}, "", f)) : (window.location.search = "", window.location.hash = ""));
                $(".volume-pricing-sticky").each(function(t, i) {
                    i._affixTop <= n && i._affixBottom >= n ? $(i).css("position", "fixed").css("z-index", 2).css("top", "45px").addClass("affixed") : $(i).css("position", "inherit").css("opacity", "").css("z-index", "").css("top", "").removeClass("affixed")
                })
            };
            $(window).scroll(_.throttle(u, 100));
            $(".panel-collapse").on("shown.bs.collapse hidden.bs.collapse", function() {
                n.each(function(n, t) {
                    i(t)
                })
            });
            f = function() {
                var u = n.parent(),
                    f, e;
                n.each(function(n, t) {
                    i(t)
                });
                f = u.innerWidth() - (parseInt(u.css("padding-left")) + parseInt(u.css("padding-right")));
                n.width(f);
                e = r.innerWidth() - (parseInt(r.css("padding-left")) + parseInt(r.css("padding-right")));
                t.css("width", e);
                t.affix()
            };
            $(window).resize(_.debounce(f, 250));
            $(window).resize()
        })
    })
};
$(function() {
    $(".modal[data-modal-lazy-url]").on("show.bs.modal", function() {
        var n = $(this),
            t = n.attr("data-modal-lazy-url");
        $.get(t).success(function(t) {
            $(".modal-body", n).html(t)
        }).error(function() {
            $(".modal-body", n).html('<div class="alert-warning text-center" style="padding:5px;" >We\'re sorry, this review cannot be edited at this time.<br/><br/>Please try again in a few moments.<\/div>')
        })
    })
});
$(function() {
    $(".modal[data-modal-ajaxify-form]").delegate("form", "submit", function(n) {
        n.preventDefault();
        $form = $(this);
        var t = $form.serialize();
        $.post($form.attr("action"), t).success(function(n) {
            $form.replaceWith(n)
        })
    })
});
$(function() {
    var n = $("body");
    $("main.main").on("touchmove", function(t) {
        return !n.hasClass("shift-right") || (t.preventDefault(), !1)
    })
});
$(function() {
        var n = null;
        $(window).height() <= 480 && ($body = $("body"), $("main").delegate("input, select, textarea", "focus", function() {
            n && (clearTimeout(n), n = null);
            $body.addClass("form-focused")
        }).delegate("input, select, textarea", "blur", function() {
            n && (clearTimeout(n), n = null);
            n = setTimeout(function() {
                $body.removeClass("form-focused")
            }, 300)
        }))
    }),
    function() {
        window.TSS.ConfigureThumbnailHovers = function() {
            $body = $("body");
            var n = ($(".magnifier-target"), !1);
            $(".image-overlay-center").mouseenter(function() {
                n = !0
            });
            $(".image-overlay").click(function() {
                n = !0
            });
            $(".gallery-main-image").mousemove(function(t) {
                var i, r, o, u, s, f, h, c, e, a, v;
                if ($(window).width() > 975 && ($("#imageCount").length || $(".image-overlay").show(), n)) {
                    if ($(".image-overlay").hide(), $("#imageCount").length && ($("#nextImage").hide(), $("#prevImage").hide()), i = this, r = $(this), !i.isConfigured) {
                        i.isConfigured = !0;
                        i.magnifierLens = $('<span class="magnifier-lens" style="-ms-filter:\'progid:DXImageTransform.Microsoft.Alpha(Opacity=70)\';position: absolute; display:block; z-index:10; border: 1px dashed #007ACC; background: #79C9FF; opacity: .7;cursor: zoom-in;"><\/span>');
                        i.magnifierLens[0].style.left = t.offsetX + "px";
                        i.magnifierLens[0].style.top = t.offsetY + "px";
                        i.targetImage = $("img", this);
                        o = (r.outerWidth(), r.outerHeight(), $("#magnifier-target"));
                        i.targetOffset = o.offset();
                        u = $('<div style="padding: 0px; margin: 0px; position: fixed; overflow:hidden; border: 1px solid #EFEFEF; background: white;"/>');
                        u.offset(i.targetOffset);
                        s = o.outerWidth(!0);
                        u.width(s);
                        u.height(s);
                        o.append(u);
                        f = (i.targetImage.width(), i.targetImage.height(), i.targetImage.width() / 2);
                        i.magnifierResult = u;
                        i.magnifiedWidthImage = $('<img src="' + i.targetImage.attr("src") + '" style="width:' + s / f * i.targetImage.width() + 'px; position: absolute;"/>');
                        u.append(i.magnifiedWidthImage);
                        this.magnifierLens.width(f);
                        this.magnifierLens.height(f);
                        r.append(i.magnifierLens);
                        var y = r.width(),
                            p = r.height(),
                            w = i.targetImage.position();
                        i.maxOffset = {
                            top: p - f,
                            left: y - f
                        };
                        i.minOffset = w;
                        h = i.magnifierLens.outerWidth(!0);
                        c = i.magnifierResult.outerWidth(!0);
                        i.actualFactor = c / h
                    }
                    var l = r.offset(),
                        b = $body.scrollLeft() + t.clientX - (l.left + i.magnifierLens.outerWidth(!0) / 2),
                        k = $body.scrollTop() + t.clientY - (l.top + i.magnifierLens.outerHeight(!0) / 2);
                    i.magnifierResult.offset(i.targetOffset);
                    e = {
                        left: Math.max(0, Math.min(i.maxOffset.left, b)),
                        top: Math.max(0, Math.min(i.maxOffset.top, k))
                    };
                    i.magnifierLens[0].style.left = e.left + "px";
                    i.magnifierLens[0].style.top = e.top + "px";
                    a = (e.left - i.minOffset.left) * -i.actualFactor;
                    v = (e.top - i.minOffset.top) * -i.actualFactor;
                    this.magnifiedWidthImage[0].style.left = a + "px";
                    this.magnifiedWidthImage[0].style.top = v + "px"
                }
            });
            $(".gallery-main-image").mouseleave(function() {
                $("#imageCount").length && ($("#nextImage").show(), $("#prevImage").show());
                $(".image-overlay").hide();
                n = !1;
                this.magnifierLens && this.magnifierLens.remove();
                this.magnifierResult && this.magnifierResult.remove();
                delete this.isConfigured;
                delete this.magnifierLens;
                delete this.magnifierResult;
                delete this.targetImage;
                delete this.magnifiedWidthImage;
                delete this.maxOffset;
                delete this.actualFactor;
                delete this.targetOffset
            })
        }
    }();
$(document).ready(function() {
        $("#catDescSlidedown-toggle").length > 0 && $("#site-wrapper").on("click", "#catDescSlidedown-toggle", function() {
            $("#catDescSlidedown").slideToggle(400, function() {
                $("#catSlidedown-indicator").hasClass("glyphicon-chevron-down") ? ($("#catSlidedown-indicator").removeClass("glyphicon-chevron-down"), $("#catSlidedown-indicator").addClass("glyphicon-chevron-up"), $("#catDesc-toggleText").text("Show Less")) : ($("#catSlidedown-indicator").removeClass("glyphicon-chevron-up"), $("#catSlidedown-indicator").addClass("glyphicon-chevron-down"), $("#catDesc-toggleText").text("More Info"))
            })
        })
    }),
    function(n) {
        function i(n, t) {
            for (var i = window, r = (n || "").split("."); i && r.length;) i = i[r.shift()];
            return "function" == typeof i ? i : (t.push(n), Function.constructor.apply(null, t))
        }

        function u(n) {
            return "GET" === n || "POST" === n
        }

        function e(n, t) {
            u(t) || n.setRequestHeader("X-HTTP-Method-Override", t)
        }

        function o(t, i, r) {
            var u; - 1 === r.indexOf("application/x-javascript") && (u = (t.getAttribute("data-ajax-mode") || "").toUpperCase(), n(t.getAttribute("data-ajax-update")).each(function(t, r) {
                var f;
                switch (u) {
                    case "BEFORE":
                        f = r.firstChild;
                        n("<div />").html(i).contents().each(function() {
                            r.insertBefore(this, f)
                        });
                        break;
                    case "AFTER":
                        n("<div />").html(i).contents().each(function() {
                            r.appendChild(this)
                        });
                        break;
                    case "REPLACE-WITH":
                        n(r).replaceWith(i);
                        break;
                    default:
                        n(r).html(i)
                }
            }))
        }

        function f(t, r) {
            var c, s, f, h;
            (c = t.getAttribute("data-ajax-confirm")) && !window.confirm(c) || (s = n(t.getAttribute("data-ajax-loading")), h = parseInt(t.getAttribute("data-ajax-loading-duration"), 10) || 0, n.extend(r, {
                type: t.getAttribute("data-ajax-method") || void 0,
                url: t.getAttribute("data-ajax-url") || void 0,
                cache: !!t.getAttribute("data-ajax-cache"),
                beforeSend: function(n) {
                    var r;
                    return e(n, f), r = i(t.getAttribute("data-ajax-begin"), ["xhr"]).apply(t, arguments), !1 !== r && s.show(h), r
                },
                complete: function() {
                    s.hide(h);
                    i(t.getAttribute("data-ajax-complete"), ["xhr", "status"]).apply(t, arguments)
                },
                success: function(n, r, u) {
                    o(t, n, u.getResponseHeader("Content-Type") || "text/html");
                    i(t.getAttribute("data-ajax-success"), ["data", "status", "xhr"]).apply(t, arguments)
                },
                error: function() {
                    i(t.getAttribute("data-ajax-failure"), ["xhr", "status", "error"]).apply(t, arguments)
                }
            }), r.data.push({
                name: "X-Requested-With",
                value: "XMLHttpRequest"
            }), f = r.type.toUpperCase(), u(f) || (r.type = "POST", r.data.push({
                name: "X-HTTP-Method-Override",
                value: f
            })), n.ajax(r))
        }

        function s(t) {
            var i = n(t).data(h);
            return !i || !i.validate || i.validate()
        }
        var t = "unobtrusiveAjaxClick",
            r = "unobtrusiveAjaxClickTarget",
            h = "unobtrusiveValidation";
        n(document).on("click", "a[data-ajax=true]", function(n) {
            n.preventDefault();
            f(this, {
                url: this.href,
                type: "GET",
                data: []
            })
        });
        n(document).on("click", "form[data-ajax=true] input[type=image]", function(i) {
            var r = i.target.name,
                u = n(i.target),
                f = n(u.parents("form")[0]),
                e = u.offset();
            f.data(t, [{
                name: r + ".x",
                value: Math.round(i.pageX - e.left)
            }, {
                name: r + ".y",
                value: Math.round(i.pageY - e.top)
            }]);
            setTimeout(function() {
                f.removeData(t)
            }, 0)
        });
        n(document).on("click", "form[data-ajax=true] :submit", function(i) {
            var f = i.currentTarget.name,
                e = n(i.target),
                u = n(e.parents("form")[0]);
            u.data(t, f ? [{
                name: f,
                value: i.currentTarget.value
            }] : []);
            u.data(r, e);
            setTimeout(function() {
                u.removeData(t);
                u.removeData(r)
            }, 0)
        });
        n(document).on("submit", "form[data-ajax=true]", function(i) {
            var e = n(this).data(t) || [],
                u = n(this).data(r),
                o = u && u.hasClass("cancel");
            i.preventDefault();
            (o || s(this)) && f(this, {
                url: this.action,
                type: this.method || "GET",
                data: e.concat(n(this).serializeArray())
            })
        })
    }(jQuery),
    function(n) {
        var t = function() {
                "use strict";
                return {
                    isMsie: function() {
                        return !!/(msie|trident)/i.test(navigator.userAgent) && navigator.userAgent.match(/(msie |rv:)(\d+(.\d+)?)/i)[2]
                    },
                    isBlankString: function(n) {
                        return !n || /^\s*$/.test(n)
                    },
                    escapeRegExChars: function(n) {
                        return n.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&")
                    },
                    isString: function(n) {
                        return "string" == typeof n
                    },
                    isNumber: function(n) {
                        return "number" == typeof n
                    },
                    isArray: n.isArray,
                    isFunction: n.isFunction,
                    isObject: n.isPlainObject,
                    isUndefined: function(n) {
                        return void 0 === n
                    },
                    toStr: function(n) {
                        return t.isUndefined(n) || null === n ? "" : n + ""
                    },
                    bind: n.proxy,
                    each: function(t, i) {
                        function r(n, t) {
                            return i(t, n)
                        }
                        n.each(t, r)
                    },
                    map: n.map,
                    filter: n.grep,
                    every: function(t, i) {
                        var r = !0;
                        return t ? (n.each(t, function(n, u) {
                            if (!(r = i.call(null, u, n, t))) return !1
                        }), !!r) : r
                    },
                    some: function(t, i) {
                        var r = !1;
                        return t ? (n.each(t, function(n, u) {
                            if (r = i.call(null, u, n, t)) return !1
                        }), !!r) : r
                    },
                    mixin: n.extend,
                    getUniqueId: function() {
                        var n = 0;
                        return function() {
                            return n++
                        }
                    }(),
                    templatify: function(t) {
                        function i() {
                            return String(t)
                        }
                        return n.isFunction(t) ? t : i
                    },
                    defer: function(n) {
                        setTimeout(n, 0)
                    },
                    debounce: function(n, t, i) {
                        var r, u;
                        return function() {
                            var f, e, o = this,
                                s = arguments;
                            return f = function() {
                                r = null;
                                i || (u = n.apply(o, s))
                            }, e = i && !r, clearTimeout(r), r = setTimeout(f, t), e && (u = n.apply(o, s)), u
                        }
                    },
                    throttle: function(n, t) {
                        var u, f, i, e, r, o;
                        return r = 0, o = function() {
                                r = new Date;
                                i = null;
                                e = n.apply(u, f)
                            },
                            function() {
                                var s = new Date,
                                    h = t - (s - r);
                                return u = this, f = arguments, h <= 0 ? (clearTimeout(i), i = null, r = s, e = n.apply(u, f)) : i || (i = setTimeout(o, h)), e
                            }
                    },
                    noop: function() {}
                }
            }(),
            r = function() {
                return {
                    wrapper: '<span class="twitter-typeahead"><\/span>',
                    dropdown: '<span class="tt-dropdown-menu"><\/span>',
                    dataset: '<div class="tt-dataset-%CLASS%"><\/div>',
                    suggestions: '<span class="tt-suggestions"><\/span>',
                    suggestion: '<div class="tt-suggestion"><\/div>'
                }
            }(),
            i = function() {
                "use strict";
                var n = {
                    wrapper: {
                        position: "relative",
                        display: "inline-block"
                    },
                    hint: {
                        position: "absolute",
                        top: "0",
                        left: "0",
                        borderColor: "transparent",
                        boxShadow: "none",
                        opacity: "1"
                    },
                    input: {
                        position: "relative",
                        verticalAlign: "top",
                        backgroundColor: "transparent"
                    },
                    inputWithNoHint: {
                        position: "relative",
                        verticalAlign: "top"
                    },
                    dropdown: {
                        position: "absolute",
                        top: "100%",
                        left: "0",
                        zIndex: "100",
                        display: "none"
                    },
                    suggestions: {
                        display: "block"
                    },
                    suggestion: {
                        whiteSpace: "nowrap",
                        cursor: "pointer"
                    },
                    suggestionChild: {
                        whiteSpace: "normal"
                    },
                    ltr: {
                        left: "0",
                        right: "auto"
                    },
                    rtl: {
                        left: "auto",
                        right: " 0"
                    }
                };
                return t.isMsie() && t.mixin(n.input, {
                    backgroundImage: "url(data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7)"
                }), t.isMsie() && t.isMsie() <= 7 && t.mixin(n.input, {
                    marginTop: "-1px"
                }), n
            }(),
            e = function() {
                "use strict";

                function i(t) {
                    t && t.el || n.error("EventBus initialized without el");
                    this.$el = n(t.el)
                }
                return t.mixin(i.prototype, {
                    trigger: function(n) {
                        var t = [].slice.call(arguments, 1);
                        this.$el.trigger("typeahead:" + n, t)
                    }
                }), i
            }(),
            f = function() {
                "use strict";

                function t(t, i, r, u) {
                    var f;
                    if (!r) return this;
                    for (i = i.split(n), r = u ? o(r, u) : r, this._callbacks = this._callbacks || {}; f = i.shift();) this._callbacks[f] = this._callbacks[f] || {
                        sync: [],
                        async: []
                    }, this._callbacks[f][t].push(r);
                    return this
                }

                function r(n, i, r) {
                    return t.call(this, "async", n, i, r)
                }

                function u(n, i, r) {
                    return t.call(this, "sync", n, i, r)
                }

                function f(t) {
                    var i;
                    if (!this._callbacks) return this;
                    for (t = t.split(n); i = t.shift();) delete this._callbacks[i];
                    return this
                }

                function e(t) {
                    var r, u, f, e, o;
                    if (!this._callbacks) return this;
                    for (t = t.split(n), f = [].slice.call(arguments, 1);
                        (r = t.shift()) && (u = this._callbacks[r]);) e = i(u.sync, this, [r].concat(f)), o = i(u.async, this, [r].concat(f)), e() && s(o);
                    return this
                }

                function i(n, t, i) {
                    function r() {
                        for (var r, u = 0, f = n.length; !r && u < f; u += 1) r = !1 === n[u].apply(t, i);
                        return !r
                    }
                    return r
                }

                function o(n, t) {
                    return n.bind ? n.bind(t) : function() {
                        n.apply(t, [].slice.call(arguments, 0))
                    }
                }
                var n = /\s+/,
                    s = function() {
                        return window.setImmediate ? function(n) {
                            setImmediate(function() {
                                n()
                            })
                        } : function(n) {
                            setTimeout(function() {
                                n()
                            }, 0)
                        }
                    }();
                return {
                    onSync: u,
                    onAsync: r,
                    off: f,
                    trigger: e
                }
            }(),
            s = function(n) {
                "use strict";

                function i(n, i, r) {
                    for (var u, f = [], e = 0, o = n.length; e < o; e++) f.push(t.escapeRegExChars(n[e]));
                    return u = r ? "\\b(" + f.join("|") + ")\\b" : "(" + f.join("|") + ")", i ? new RegExp(u) : new RegExp(u, "i")
                }
                var r = {
                    node: null,
                    pattern: null,
                    tagName: "strong",
                    className: null,
                    wordsOnly: !1,
                    caseSensitive: !1
                };
                return function(u) {
                    function o(t) {
                        var i, r, f;
                        return (i = e.exec(t.data)) && (f = n.createElement(u.tagName), u.className && (f.className = u.className), r = t.splitText(i.index), r.splitText(i[0].length), f.appendChild(r.cloneNode(!0)), t.parentNode.replaceChild(f, r)), !!i
                    }

                    function f(n, t) {
                        for (var i, r = 0; r < n.childNodes.length; r++) i = n.childNodes[r], 3 === i.nodeType ? r += t(i) ? 1 : 0 : f(i, t)
                    }
                    var e;
                    u = t.mixin({}, r, u);
                    u.node && u.pattern && (u.pattern = t.isArray(u.pattern) ? u.pattern : [u.pattern], e = i(u.pattern, u.caseSensitive, u.wordsOnly), f(u.node, o))
                }
            }(window.document),
            o = function() {
                "use strict";

                function i(i) {
                    var r, f, o, s, h = this;
                    i = i || {};
                    i.input || n.error("input is missing");
                    r = t.bind(this._onBlur, this);
                    f = t.bind(this._onFocus, this);
                    o = t.bind(this._onKeydown, this);
                    s = t.bind(this._onInput, this);
                    this.$hint = n(i.hint);
                    this.$input = n(i.input).on("blur.tt", r).on("focus.tt", f).on("keydown.tt", o);
                    0 === this.$hint.length && (this.setHint = this.getHint = this.clearHint = this.clearHintIfInvalid = t.noop);
                    t.isMsie() ? this.$input.on("keydown.tt keypress.tt cut.tt paste.tt", function(n) {
                        u[n.which || n.keyCode] || t.defer(t.bind(h._onInput, h, n))
                    }) : this.$input.on("input.tt", s);
                    this.query = this.$input.val();
                    this.$overflowHelper = e(this.$input)
                }

                function e(t) {
                    return n('<pre aria-hidden="true"><\/pre>').css({
                        position: "absolute",
                        visibility: "hidden",
                        whiteSpace: "pre",
                        fontFamily: t.css("font-family"),
                        fontSize: t.css("font-size"),
                        fontStyle: t.css("font-style"),
                        fontVariant: t.css("font-variant"),
                        fontWeight: t.css("font-weight"),
                        wordSpacing: t.css("word-spacing"),
                        letterSpacing: t.css("letter-spacing"),
                        textIndent: t.css("text-indent"),
                        textRendering: t.css("text-rendering"),
                        textTransform: t.css("text-transform")
                    }).insertAfter(t)
                }

                function o(n, t) {
                    return i.normalizeQuery(n) === i.normalizeQuery(t)
                }

                function r(n) {
                    return n.altKey || n.ctrlKey || n.metaKey || n.shiftKey
                }
                var u;
                return u = {
                    9: "tab",
                    27: "esc",
                    37: "left",
                    39: "right",
                    13: "enter",
                    38: "up",
                    40: "down"
                }, i.normalizeQuery = function(n) {
                    return (n || "").replace(/^\s*/g, "").replace(/\s{2,}/g, " ")
                }, t.mixin(i.prototype, f, {
                    _onBlur: function() {
                        this.resetInputValue();
                        this.trigger("blurred")
                    },
                    _onFocus: function() {
                        this.trigger("focused")
                    },
                    _onKeydown: function(n) {
                        var t = u[n.which || n.keyCode];
                        this._managePreventDefault(t, n);
                        t && this._shouldTrigger(t, n) && this.trigger(t + "Keyed", n)
                    },
                    _onInput: function() {
                        this._checkInputValue()
                    },
                    _managePreventDefault: function(n, t) {
                        var i, u, f;
                        switch (n) {
                            case "tab":
                                u = this.getHint();
                                f = this.getInputValue();
                                i = u && u !== f && !r(t);
                                break;
                            case "up":
                            case "down":
                                i = !r(t);
                                break;
                            default:
                                i = !1
                        }
                        i && t.preventDefault()
                    },
                    _shouldTrigger: function(n, t) {
                        var i;
                        switch (n) {
                            case "tab":
                                i = !r(t);
                                break;
                            default:
                                i = !0
                        }
                        return i
                    },
                    _checkInputValue: function() {
                        var n, t, i;
                        n = this.getInputValue();
                        t = o(n, this.query);
                        i = !!t && this.query.length !== n.length;
                        this.query = n;
                        t ? i && this.trigger("whitespaceChanged", this.query) : this.trigger("queryChanged", this.query)
                    },
                    focus: function() {
                        this.$input.focus()
                    },
                    blur: function() {
                        this.$input.blur()
                    },
                    getQuery: function() {
                        return this.query
                    },
                    setQuery: function(n) {
                        this.query = n
                    },
                    getInputValue: function() {
                        return this.$input.val()
                    },
                    setInputValue: function(n, t) {
                        this.$input.val(n);
                        t ? this.clearHint() : this._checkInputValue()
                    },
                    resetInputValue: function() {
                        this.setInputValue(this.query, !0)
                    },
                    getHint: function() {
                        return this.$hint.val()
                    },
                    setHint: function(n) {
                        this.$hint.val(n)
                    },
                    clearHint: function() {
                        this.setHint("")
                    },
                    clearHintIfInvalid: function() {
                        var n, t, i, r;
                        n = this.getInputValue();
                        t = this.getHint();
                        i = n !== t && 0 === t.indexOf(n);
                        !(r = "" !== n && i && !this.hasOverflow()) && this.clearHint()
                    },
                    getLanguageDirection: function() {
                        return (this.$input.css("direction") || "ltr").toLowerCase()
                    },
                    hasOverflow: function() {
                        var n = this.$input.width() - 2;
                        return this.$overflowHelper.text(this.getInputValue()), this.$overflowHelper.width() >= n
                    },
                    isCursorAtEnd: function() {
                        var n, i, r;
                        return n = this.$input.val().length, i = this.$input[0].selectionStart, t.isNumber(i) ? i === n : !document.selection || (r = document.selection.createRange(), r.moveStart("character", -n), n === r.text.length)
                    },
                    destroy: function() {
                        this.$hint.off(".tt");
                        this.$input.off(".tt");
                        this.$hint = this.$input = this.$overflowHelper = null
                    }
                }), i
            }(),
            u = function() {
                "use strict";

                function u(i) {
                    i = i || {};
                    i.templates = i.templates || {};
                    i.source || n.error("missing source");
                    i.name && !a(i.name) && n.error("invalid dataset name: " + i.name);
                    this.query = null;
                    this.highlight = !!i.highlight;
                    this.name = i.name || t.getUniqueId();
                    this.source = i.source;
                    this.displayFn = c(i.display || i.displayKey);
                    this.templates = l(i.templates, this.displayFn);
                    this.$el = n(r.dataset.replace("%CLASS%", this.name))
                }

                function c(n) {
                    function i(t) {
                        return t[n]
                    }
                    return n = n || "value", t.isFunction(n) ? n : i
                }

                function l(n, i) {
                    function r(n) {
                        return "<p>" + i(n) + "<\/p>"
                    }
                    return {
                        empty: n.empty && t.templatify(n.empty),
                        header: n.header && t.templatify(n.header),
                        footer: n.footer && t.templatify(n.footer),
                        suggestion: n.suggestion || r
                    }
                }

                function a(n) {
                    return /^[_a-zA-Z0-9-]+$/.test(n)
                }
                var e = "ttDataset",
                    o = "ttValue",
                    h = "ttDatum";
                return u.extractDatasetName = function(t) {
                    return n(t).data(e)
                }, u.extractValue = function(t) {
                    return n(t).data(o)
                }, u.extractDatum = function(t) {
                    return n(t).data(h)
                }, t.mixin(u.prototype, f, {
                    _render: function(u, f) {
                        function a() {
                            return c.templates.header({
                                query: u,
                                isEmpty: !l
                            })
                        }

                        function v() {
                            return c.templates.footer({
                                query: u,
                                isEmpty: !l
                            })
                        }
                        if (this.$el) {
                            var l, c = this;
                            this.$el.empty();
                            l = f && f.length;
                            !l && this.templates.empty ? this.$el.html(function() {
                                return c.templates.empty({
                                    query: u,
                                    isEmpty: !0
                                })
                            }()).prepend(c.templates.header ? a() : null).append(c.templates.footer ? v() : null) : l && this.$el.html(function() {
                                function v(t) {
                                    var u;
                                    return u = n(r.suggestion).append(c.templates.suggestion(t)).data(e, c.name).data(o, c.displayFn(t)).data(h, t), u.children().each(function() {
                                        n(this).css(i.suggestionChild)
                                    }), u
                                }
                                var l, a;
                                return l = n(r.suggestions).css(i.suggestions), a = t.map(f, v), l.append.apply(l, a), c.highlight && s({
                                    className: "tt-highlight",
                                    node: l[0],
                                    pattern: u
                                }), l
                            }()).prepend(c.templates.header ? a() : null).append(c.templates.footer ? v() : null);
                            this.trigger("rendered")
                        }
                    },
                    getRoot: function() {
                        return this.$el
                    },
                    update: function(n) {
                        function i(i) {
                            t.canceled || n !== t.query || t._render(n, i)
                        }
                        var t = this;
                        this.query = n;
                        this.canceled = !1;
                        this.source(n, i)
                    },
                    cancel: function() {
                        this.canceled = !0
                    },
                    clear: function() {
                        this.cancel();
                        this.$el.empty();
                        this.trigger("rendered")
                    },
                    isEmpty: function() {
                        return this.$el.is(":empty")
                    },
                    destroy: function() {
                        this.$el = null
                    }
                }), u
            }(),
            h = function() {
                "use strict";

                function r(i) {
                    var u, f, o, r = this;
                    i = i || {};
                    i.menu || n.error("menu is required");
                    this.isOpen = !1;
                    this.isEmpty = !0;
                    this.datasets = t.map(i.datasets, e);
                    u = t.bind(this._onSuggestionClick, this);
                    f = t.bind(this._onSuggestionMouseEnter, this);
                    o = t.bind(this._onSuggestionMouseLeave, this);
                    this.$menu = n(i.menu).on("click.tt", ".tt-suggestion", u).on("mouseenter.tt", ".tt-suggestion", f).on("mouseleave.tt", ".tt-suggestion", o);
                    t.each(this.datasets, function(n) {
                        r.$menu.append(n.getRoot());
                        n.onSync("rendered", r._onRendered, r)
                    })
                }

                function e(n) {
                    return new u(n)
                }
                return t.mixin(r.prototype, f, {
                    _onSuggestionClick: function(t) {
                        this.trigger("suggestionClicked", n(t.currentTarget))
                    },
                    _onSuggestionMouseEnter: function(t) {
                        this._removeCursor();
                        this._setCursor(n(t.currentTarget), !0)
                    },
                    _onSuggestionMouseLeave: function() {
                        this._removeCursor()
                    },
                    _onRendered: function() {
                        function n(n) {
                            return n.isEmpty()
                        }
                        this.isEmpty = t.every(this.datasets, n);
                        this.isEmpty ? this._hide() : this.isOpen && this._show();
                        this.trigger("datasetRendered")
                    },
                    _hide: function() {
                        this.$menu.hide()
                    },
                    _show: function() {
                        this.$menu.css("display", "block")
                    },
                    _getSuggestions: function() {
                        return this.$menu.find(".tt-suggestion")
                    },
                    _getCursor: function() {
                        return this.$menu.find(".tt-cursor").first()
                    },
                    _setCursor: function(n, t) {
                        n.first().addClass("tt-cursor");
                        t || this.trigger("cursorMoved")
                    },
                    _removeCursor: function() {
                        this._getCursor().removeClass("tt-cursor")
                    },
                    _moveCursor: function(n) {
                        var i, r, t, u;
                        if (this.isOpen) {
                            if (r = this._getCursor(), i = this._getSuggestions(), this._removeCursor(), t = i.index(r) + n, -1 == (t = (t + 1) % (i.length + 1) - 1)) return void this.trigger("cursorRemoved");
                            t < -1 && (t = i.length - 1);
                            this._setCursor(u = i.eq(t));
                            this._ensureVisible(u)
                        }
                    },
                    _ensureVisible: function(n) {
                        var t, i, r, u;
                        t = n.position().top;
                        i = t + n.outerHeight(!0);
                        r = this.$menu.scrollTop();
                        u = this.$menu.height() + parseInt(this.$menu.css("paddingTop"), 10) + parseInt(this.$menu.css("paddingBottom"), 10);
                        t < 0 ? this.$menu.scrollTop(r + t) : u < i && this.$menu.scrollTop(r + (i - u))
                    },
                    close: function() {
                        this.isOpen && (this.isOpen = !1, this._removeCursor(), this._hide(), this.trigger("closed"))
                    },
                    open: function() {
                        this.isOpen || (this.isOpen = !0, !this.isEmpty && this._show(), this.trigger("opened"))
                    },
                    setLanguageDirection: function(n) {
                        this.$menu.css("ltr" === n ? i.ltr : i.rtl)
                    },
                    moveCursorUp: function() {
                        this._moveCursor(-1)
                    },
                    moveCursorDown: function() {
                        this._moveCursor(1)
                    },
                    getDatumForSuggestion: function(n) {
                        var t = null;
                        return n.length && (t = {
                            raw: u.extractDatum(n),
                            value: u.extractValue(n),
                            datasetName: u.extractDatasetName(n)
                        }), t
                    },
                    getDatumForCursor: function() {
                        return this.getDatumForSuggestion(this._getCursor().first())
                    },
                    getDatumForTopSuggestion: function() {
                        return this.getDatumForSuggestion(this._getSuggestions().first())
                    },
                    update: function(n) {
                        function i(t) {
                            t.update(n)
                        }
                        t.each(this.datasets, i)
                    },
                    empty: function() {
                        function n(n) {
                            n.clear()
                        }
                        t.each(this.datasets, n);
                        this.isEmpty = !0
                    },
                    isVisible: function() {
                        return this.isOpen && !this.isEmpty
                    },
                    destroy: function() {
                        function n(n) {
                            n.destroy()
                        }
                        this.$menu.off(".tt");
                        this.$menu = null;
                        t.each(this.datasets, n)
                    }
                }), r
            }(),
            c = function() {
                "use strict";

                function f(i) {
                    var r, u, f;
                    i = i || {};
                    i.input || n.error("missing input");
                    this.isActivated = !1;
                    this.autoselect = !!i.autoselect;
                    this.minLength = t.isNumber(i.minLength) ? i.minLength : 1;
                    this.$node = s(i.input, i.withHint);
                    r = this.$node.find(".tt-dropdown-menu");
                    u = this.$node.find(".tt-input");
                    f = this.$node.find(".tt-hint");
                    u.on("blur.tt", function(n) {
                        var i, f, e;
                        i = document.activeElement;
                        f = r.is(i);
                        e = r.has(i).length > 0;
                        t.isMsie() && (f || e) && (n.preventDefault(), n.stopImmediatePropagation(), t.defer(function() {
                            u.focus()
                        }))
                    });
                    r.on("mousedown.tt", function(n) {
                        n.preventDefault()
                    });
                    this.eventBus = i.eventBus || new e({
                        el: u
                    });
                    this.dropdown = new h({
                        menu: r,
                        datasets: i.datasets
                    }).onSync("suggestionClicked", this._onSuggestionClicked, this).onSync("cursorMoved", this._onCursorMoved, this).onSync("cursorRemoved", this._onCursorRemoved, this).onSync("opened", this._onOpened, this).onSync("closed", this._onClosed, this).onAsync("datasetRendered", this._onDatasetRendered, this);
                    this.input = new o({
                        input: u,
                        hint: f
                    }).onSync("focused", this._onFocused, this).onSync("blurred", this._onBlurred, this).onSync("enterKeyed", this._onEnterKeyed, this).onSync("tabKeyed", this._onTabKeyed, this).onSync("escKeyed", this._onEscKeyed, this).onSync("upKeyed", this._onUpKeyed, this).onSync("downKeyed", this._onDownKeyed, this).onSync("leftKeyed", this._onLeftKeyed, this).onSync("rightKeyed", this._onRightKeyed, this).onSync("queryChanged", this._onQueryChanged, this).onSync("whitespaceChanged", this._onWhitespaceChanged, this);
                    this._setLanguageDirection()
                }

                function s(t, f) {
                    var e, s, h, o;
                    e = n(t);
                    s = n(r.wrapper).css(i.wrapper);
                    h = n(r.dropdown).css(i.dropdown);
                    o = e.clone().css(i.hint).css(c(e));
                    o.val("").removeData().addClass("tt-hint").removeAttr("id name placeholder required").prop("readonly", !0).attr({
                        autocomplete: "off",
                        spellcheck: "false",
                        tabindex: -1
                    });
                    e.data(u, {
                        dir: e.attr("dir"),
                        autocomplete: e.attr("autocomplete"),
                        spellcheck: e.attr("spellcheck"),
                        style: e.attr("style")
                    });
                    e.addClass("tt-input").attr({
                        autocomplete: "off",
                        spellcheck: !1
                    }).css(f ? i.input : i.inputWithNoHint);
                    try {
                        e.attr("dir") || e.attr("dir", "auto")
                    } catch (n) {}
                    return e.wrap(s).parent().prepend(f ? o : null).append(h)
                }

                function c(n) {
                    return {
                        backgroundAttachment: n.css("background-attachment"),
                        backgroundClip: n.css("background-clip"),
                        backgroundColor: n.css("background-color"),
                        backgroundImage: n.css("background-image"),
                        backgroundOrigin: n.css("background-origin"),
                        backgroundPosition: n.css("background-position"),
                        backgroundRepeat: n.css("background-repeat"),
                        backgroundSize: n.css("background-size")
                    }
                }

                function l(n) {
                    var i = n.find(".tt-input");
                    t.each(i.data(u), function(n, r) {
                        t.isUndefined(n) ? i.removeAttr(r) : i.attr(r, n)
                    });
                    i.detach().removeData(u).removeClass("tt-input").insertAfter(n);
                    n.remove()
                }
                var u = "ttAttrs";
                return t.mixin(f.prototype, {
                    _onSuggestionClicked: function(n, t) {
                        var i;
                        (i = this.dropdown.getDatumForSuggestion(t)) && this._select(i)
                    },
                    _onCursorMoved: function() {
                        var n = this.dropdown.getDatumForCursor();
                        this.input.setInputValue(n.value, !0);
                        this.eventBus.trigger("cursorchanged", n.raw, n.datasetName)
                    },
                    _onCursorRemoved: function() {
                        this.input.resetInputValue();
                        this._updateHint()
                    },
                    _onDatasetRendered: function() {
                        this._updateHint()
                    },
                    _onOpened: function() {
                        this._updateHint();
                        this.eventBus.trigger("opened")
                    },
                    _onClosed: function() {
                        this.input.clearHint();
                        this.eventBus.trigger("closed")
                    },
                    _onFocused: function() {
                        this.isActivated = !0;
                        this.dropdown.open()
                    },
                    _onBlurred: function() {
                        this.isActivated = !1;
                        this.dropdown.empty();
                        this.dropdown.close()
                    },
                    _onEnterKeyed: function(n, t) {
                        var i, r;
                        i = this.dropdown.getDatumForCursor();
                        r = this.dropdown.getDatumForTopSuggestion();
                        i ? (this._select(i), t.preventDefault()) : this.autoselect && r && (this._select(r), t.preventDefault())
                    },
                    _onTabKeyed: function(n, t) {
                        var i;
                        (i = this.dropdown.getDatumForCursor()) ? (this._select(i), t.preventDefault()) : this._autocomplete(!0)
                    },
                    _onEscKeyed: function() {
                        this.dropdown.close();
                        this.input.resetInputValue()
                    },
                    _onUpKeyed: function() {
                        var n = this.input.getQuery();
                        this.dropdown.isEmpty && n.length >= this.minLength ? this.dropdown.update(n) : this.dropdown.moveCursorUp();
                        this.dropdown.open()
                    },
                    _onDownKeyed: function() {
                        var n = this.input.getQuery();
                        this.dropdown.isEmpty && n.length >= this.minLength ? this.dropdown.update(n) : this.dropdown.moveCursorDown();
                        this.dropdown.open()
                    },
                    _onLeftKeyed: function() {
                        "rtl" === this.dir && this._autocomplete()
                    },
                    _onRightKeyed: function() {
                        "ltr" === this.dir && this._autocomplete()
                    },
                    _onQueryChanged: function(n, t) {
                        this.input.clearHintIfInvalid();
                        t.length >= this.minLength ? this.dropdown.update(t) : this.dropdown.empty();
                        this.dropdown.open();
                        this._setLanguageDirection()
                    },
                    _onWhitespaceChanged: function() {
                        this._updateHint();
                        this.dropdown.open()
                    },
                    _setLanguageDirection: function() {
                        var n;
                        this.dir !== (n = this.input.getLanguageDirection()) && (this.dir = n, this.$node.css("direction", n), this.dropdown.setLanguageDirection(n))
                    },
                    _updateHint: function() {
                        var n, i, u, f, e, r;
                        n = this.dropdown.getDatumForTopSuggestion();
                        n && this.dropdown.isVisible() && !this.input.hasOverflow() ? (i = this.input.getInputValue(), u = o.normalizeQuery(i), f = t.escapeRegExChars(u), e = new RegExp("^(?:" + f + ")(.+$)", "i"), r = e.exec(n.value), r ? this.input.setHint(i + r[1]) : this.input.clearHint()) : this.input.clearHint()
                    },
                    _autocomplete: function(n) {
                        var i, r, u, t;
                        i = this.input.getHint();
                        r = this.input.getQuery();
                        u = n || this.input.isCursorAtEnd();
                        i && r !== i && u && (t = this.dropdown.getDatumForTopSuggestion(), t && this.input.setInputValue(t.value), this.eventBus.trigger("autocompleted", t.raw, t.datasetName))
                    },
                    _select: function(n) {
                        this.input.setQuery(n.value);
                        this.input.setInputValue(n.value, !0);
                        this._setLanguageDirection();
                        this.eventBus.trigger("selected", n.raw, n.datasetName);
                        this.dropdown.close();
                        t.defer(t.bind(this.dropdown.empty, this.dropdown))
                    },
                    open: function() {
                        this.dropdown.open()
                    },
                    close: function() {
                        this.dropdown.close()
                    },
                    setVal: function(n) {
                        n = t.toStr(n);
                        this.isActivated ? this.input.setInputValue(n) : (this.input.setQuery(n), this.input.setInputValue(n, !0));
                        this._setLanguageDirection()
                    },
                    getVal: function() {
                        return this.input.getQuery()
                    },
                    destroy: function() {
                        this.input.destroy();
                        this.dropdown.destroy();
                        l(this.$node);
                        this.$node = null
                    }
                }), f
            }();
        ! function() {
            "use strict";
            var u, i, r;
            u = n.fn.typeahead;
            i = "ttTypeahead";
            r = {
                initialize: function(r, u) {
                    function f() {
                        var o, f = n(this);
                        t.each(u, function(n) {
                            n.highlight = !!r.highlight
                        });
                        o = new c({
                            input: f,
                            eventBus: new e({
                                el: f
                            }),
                            withHint: !!t.isUndefined(r.hint) || !!r.hint,
                            minLength: r.minLength,
                            autoselect: r.autoselect,
                            datasets: u
                        });
                        f.data(i, o)
                    }
                    return u = t.isArray(u) ? u : [].slice.call(arguments, 1), r = r || {}, this.each(f)
                },
                open: function() {
                    function t() {
                        var t, r = n(this);
                        (t = r.data(i)) && t.open()
                    }
                    return this.each(t)
                },
                close: function() {
                    function t() {
                        var t, r = n(this);
                        (t = r.data(i)) && t.close()
                    }
                    return this.each(t)
                },
                val: function(t) {
                    function r() {
                        var r, u = n(this);
                        (r = u.data(i)) && r.setVal(t)
                    }
                    return arguments.length ? this.each(r) : function(n) {
                        var t, r;
                        return (t = n.data(i)) && (r = t.getVal()), r
                    }(this.first())
                },
                destroy: function() {
                    function t() {
                        var t, r = n(this);
                        (t = r.data(i)) && (t.destroy(), r.removeData(i))
                    }
                    return this.each(t)
                }
            };
            n.fn.typeahead = function(t) {
                var u;
                return r[t] && "initialize" !== t ? (u = this.filter(function() {
                    return !!n(this).data(i)
                }), r[t].apply(u, [].slice.call(arguments, 1))) : r.initialize.apply(this, arguments)
            };
            n.fn.typeahead.noConflict = function() {
                return n.fn.typeahead = u, this
            }
        }()
    }(window.jQuery);
$(function() {
    $("#search-term").keyup(function(n) {
        13 == n.keyCode && $("#search-button").click()
    })
});
$("#prop65CancelPurchase").click(function(n) {
    n.preventDefault();
    $("#prop65Warning").modal("toggle")
});
window.Modernizr = function(n, t, i) {
        function y(n) {
            w.cssText = n
        }

        function u(n, t) {
            return typeof n === t
        }
        var r = {},
            o = !0,
            s = t.documentElement,
            p = t.createElement("modernizr"),
            w = p.style,
            b, k = {}.toString,
            h = {},
            c = [],
            l = c.slice,
            f, a = {}.hasOwnProperty,
            v, e;
        v = !u(a, "undefined") && !u(a.call, "undefined") ? function(n, t) {
            return a.call(n, t)
        } : function(n, t) {
            return t in n && u(n.constructor.prototype[t], "undefined")
        };
        Function.prototype.bind || (Function.prototype.bind = function(n) {
            var t = this,
                i, r;
            if (typeof t != "function") throw new TypeError;
            return i = l.call(arguments, 1), r = function() {
                var f, e, u;
                return this instanceof r ? (f = function() {}, f.prototype = t.prototype, e = new f, u = t.apply(e, i.concat(l.call(arguments))), Object(u) === u ? u : e) : t.apply(n, i.concat(l.call(arguments)))
            }, r
        });
        for (e in h) v(h, e) && (f = e.toLowerCase(), r[f] = h[e](), c.push((r[f] ? "" : "no-") + f));
        return r.addTest = function(n, t) {
                if (typeof n == "object")
                    for (var u in n) v(n, u) && r.addTest(u, n[u]);
                else {
                    if (n = n.toLowerCase(), r[n] !== i) return r;
                    t = typeof t == "function" ? t() : t;
                    typeof o != "undefined" && o && (s.className += " " + (t ? "" : "no-") + n);
                    r[n] = t
                }
                return r
            }, y(""), p = b = null,
            function(n, t) {
                function v(n, t) {
                    var i = n.createElement("p"),
                        r = n.getElementsByTagName("head")[0] || n.documentElement;
                    return i.innerHTML = "x<style>" + t + "<\/style>", r.insertBefore(i.lastChild, r.firstChild)
                }

                function s() {
                    var n = r.elements;
                    return typeof n == "string" ? n.split(" ") : n
                }

                function u(n) {
                    var t = a[n[l]];
                    return t || (t = {}, o++, n[l] = o, a[o] = t), t
                }

                function h(n, r, f) {
                    if (r || (r = t), i) return r.createElement(n);
                    f || (f = u(r));
                    var e;
                    return e = f.cache[n] ? f.cache[n].cloneNode() : b.test(n) ? (f.cache[n] = f.createElem(n)).cloneNode() : f.createElem(n), e.canHaveChildren && !w.test(n) && !e.tagUrn ? f.frag.appendChild(e) : e
                }

                function y(n, r) {
                    if (n || (n = t), i) return n.createDocumentFragment();
                    r = r || u(n);
                    for (var e = r.frag.cloneNode(), f = 0, o = s(), h = o.length; f < h; f++) e.createElement(o[f]);
                    return e
                }

                function p(n, t) {
                    t.cache || (t.cache = {}, t.createElem = n.createElement, t.createFrag = n.createDocumentFragment, t.frag = t.createFrag());
                    n.createElement = function(i) {
                        return r.shivMethods ? h(i, n, t) : t.createElem(i)
                    };
                    n.createDocumentFragment = Function("h,f", "return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&(" + s().join().replace(/[\w\-]+/g, function(n) {
                        return t.createElem(n), t.frag.createElement(n), 'c("' + n + '")'
                    }) + ");return n}")(r, t.frag)
                }

                function c(n) {
                    n || (n = t);
                    var f = u(n);
                    return r.shivCSS && !e && !f.hasCSS && (f.hasCSS = !!v(n, "article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")), i || p(n, f), n
                }
                var f = n.html5 || {},
                    w = /^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,
                    b = /^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,
                    e, l = "_html5shiv",
                    o = 0,
                    a = {},
                    i, r;
                (function() {
                    try {
                        var n = t.createElement("a");
                        n.innerHTML = "<xyz><\/xyz>";
                        e = "hidden" in n;
                        i = n.childNodes.length == 1 || function() {
                            t.createElement("a");
                            var n = t.createDocumentFragment();
                            return typeof n.cloneNode == "undefined" || typeof n.createDocumentFragment == "undefined" || typeof n.createElement == "undefined"
                        }()
                    } catch (r) {
                        e = !0;
                        i = !0
                    }
                })();
                r = {
                    elements: f.elements || "abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",
                    version: "3.7.0",
                    shivCSS: f.shivCSS !== !1,
                    supportsUnknownElements: i,
                    shivMethods: f.shivMethods !== !1,
                    type: "default",
                    shivDocument: c,
                    createElement: h,
                    createDocumentFragment: y
                };
                n.html5 = r;
                c(t)
            }(this, t), r._version = "2.8.2", s.className = s.className.replace(/(^|\s)no-js(\s|$)/, "$1$2") + (o ? " js " + c.join(" ") : ""), r
    }(this, this.document),
    function(n, t, i) {
        function h(n) {
            return "[object Function]" == y.call(n)
        }

        function c(n) {
            return "string" == typeof n
        }

        function l() {}

        function w(n) {
            return !n || "loaded" == n || "complete" == n || "uninitialized" == n
        }

        function e() {
            var n = a.shift();
            v = 1;
            n ? n.t ? s(function() {
                ("c" == n.t ? u.injectCss : u.injectJs)(n.s, 0, n.a, n.x, n.e, 1)
            }, 0) : (n(), e()) : v = 0
        }

        function ut(n, i, f, h, c, l, y) {
            function k(t) {
                if (!nt && w(p.readyState) && (tt.r = nt = 1, !v && e(), p.onload = p.onreadystatechange = null, t)) {
                    "img" != n && s(function() {
                        g.removeChild(p)
                    }, 50);
                    for (var u in r[i]) r[i].hasOwnProperty(u) && r[i][u].onload()
                }
            }
            var y = y || u.errorTimeout,
                p = t.createElement(n),
                nt = 0,
                b = 0,
                tt = {
                    t: f,
                    s: i,
                    e: c,
                    a: l,
                    x: y
                };
            1 === r[i] && (b = 1, r[i] = []);
            "object" == n ? p.data = i : (p.src = i, p.type = n);
            p.width = p.height = "0";
            p.onerror = p.onload = p.onreadystatechange = function() {
                k.call(this, b)
            };
            a.splice(h, 0, tt);
            "img" != n && (b || 2 === r[i] ? (g.insertBefore(p, d ? null : o), s(k, y)) : r[i].push(p))
        }

        function ft(n, t, i, r, u) {
            return v = 0, t = t || "j", c(n) ? ut("c" == t ? et : nt, n, t, this.i++, i, r, u) : (a.splice(this.i++, 0, n), 1 == a.length && e()), this
        }

        function b() {
            var n = u;
            return n.loader = {
                load: ft,
                i: 0
            }, n
        }
        var f = t.documentElement,
            s = n.setTimeout,
            o = t.getElementsByTagName("script")[0],
            y = {}.toString,
            a = [],
            v = 0,
            k = "MozAppearance" in f.style,
            d = k && !!t.createRange().compareNode,
            g = d ? f : o.parentNode,
            f = n.opera && "[object Opera]" == y.call(n.opera),
            f = !!t.attachEvent && !f,
            nt = k ? "object" : f ? "script" : "img",
            et = f ? "script" : nt,
            tt = Array.isArray || function(n) {
                return "[object Array]" == y.call(n)
            },
            p = [],
            r = {},
            it = {
                timeout: function(n, t) {
                    return t.length && (n.timeout = t[0]), n
                }
            },
            rt, u;
        u = function(n) {
            function a(n) {
                for (var n = n.split("!"), f = p.length, t = n.pop(), e = n.length, t = {
                        url: t,
                        origUrl: t,
                        prefixes: n
                    }, u, r, i = 0; i < e; i++) r = n[i].split("="), (u = it[r.shift()]) && (t = u(t, r));
                for (i = 0; i < f; i++) t = p[i](t);
                return t
            }

            function f(n, t, u, f, e) {
                var o = a(n),
                    s = o.autoCallback;
                o.url.split(".").pop().split("?").shift();
                o.bypass || (t && (t = h(t) ? t : t[n] || t[f] || t[n.split("/").pop().split("?")[0]]), o.instead ? o.instead(n, t, u, f, e) : (r[o.url] ? o.noexec = !0 : r[o.url] = 1, u.load(o.url, o.forceCSS || !o.forceJS && "css" == o.url.split(".").pop().split("?").shift() ? "c" : i, o.noexec, o.attrs, o.timeout), (h(t) || h(s)) && u.load(function() {
                    b();
                    t && t(o.origUrl, e, f);
                    s && s(o.origUrl, e, f);
                    r[o.url] = 2
                })))
            }

            function s(n, t) {
                function a(n, o) {
                    if (n) {
                        if (c(n)) o || (i = function() {
                            var n = [].slice.call(arguments);
                            s.apply(this, n);
                            u()
                        }), f(n, i, t, 0, e);
                        else if (Object(n) === n)
                            for (r in v = function() {
                                    var t = 0,
                                        i;
                                    for (i in n) n.hasOwnProperty(i) && t++;
                                    return t
                                }(), n) n.hasOwnProperty(r) && (!o && !--v && (h(i) ? i = function() {
                                var n = [].slice.call(arguments);
                                s.apply(this, n);
                                u()
                            } : i[r] = function(n) {
                                return function() {
                                    var t = [].slice.call(arguments);
                                    n && n.apply(this, t);
                                    u()
                                }
                            }(s[r])), f(n[r], i, t, r, e))
                    } else o || u()
                }
                var e = !!n.test,
                    o = n.load || n.both,
                    i = n.callback || l,
                    s = i,
                    u = n.complete || l,
                    v, r;
                a(e ? n.yep : n.nope, !!o);
                o && a(o)
            }
            var e, t, o = this.yepnope.loader;
            if (c(n)) f(n, 0, o, 0);
            else if (tt(n))
                for (e = 0; e < n.length; e++) t = n[e], c(t) ? f(t, 0, o, 0) : tt(t) ? u(t) : Object(t) === t && s(t, o);
            else Object(n) === n && s(n, o)
        };
        u.addPrefix = function(n, t) {
            it[n] = t
        };
        u.addFilter = function(n) {
            p.push(n)
        };
        u.errorTimeout = 1e4;
        null == t.readyState && t.addEventListener && (t.readyState = "loading", t.addEventListener("DOMContentLoaded", rt = function() {
            t.removeEventListener("DOMContentLoaded", rt, 0);
            t.readyState = "complete"
        }, 0));
        n.yepnope = b();
        n.yepnope.executeStack = e;
        n.yepnope.injectJs = function(n, i, r, f, h, c) {
            var a = t.createElement("script"),
                v, y, f = f || u.errorTimeout;
            a.src = n;
            for (y in r) a.setAttribute(y, r[y]);
            i = c ? e : i || l;
            a.onreadystatechange = a.onload = function() {
                !v && w(a.readyState) && (v = 1, i(), a.onload = a.onreadystatechange = null)
            };
            s(function() {
                v || (v = 1, i(1))
            }, f);
            h ? a.onload() : o.parentNode.insertBefore(a, o)
        };
        n.yepnope.injectCss = function(n, i, r, u, f, h) {
            var u = t.createElement("link"),
                c, i = h ? e : i || l;
            u.href = n;
            u.rel = "stylesheet";
            u.type = "text/css";
            for (c in r) u.setAttribute(c, r[c]);
            f || (o.parentNode.insertBefore(u, o), s(i, 0))
        }
    }(this, document);
Modernizr.load = function() {
    yepnope.apply(window, [].slice.call(arguments, 0))
}