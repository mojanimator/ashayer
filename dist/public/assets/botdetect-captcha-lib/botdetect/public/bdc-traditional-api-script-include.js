"use strict";

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

(function () {
  function a(a) {
    a ? (l[0] = l[16] = l[1] = l[2] = l[3] = l[4] = l[5] = l[6] = l[7] = l[8] = l[9] = l[10] = l[11] = l[12] = l[13] = l[14] = l[15] = 0, this.blocks = l) : this.blocks = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];this.h0 = 1732584193;this.h1 = 4023233417;this.h2 = 2562383102;this.h3 = 271733878;this.h4 = 3285377520;this.block = this.start = this.bytes = 0;this.finalized = this.hashed = !1;this.first = !0;
  }var b = "object" === (typeof window === "undefined" ? "undefined" : _typeof(window)) ? window : {},
      c = "0123456789abcdef".split(""),
      m = [-2147483648, 8388608, 32768, 128],
      d = [24, 16, 8, 0],
      n = ["hex", "array", "digest", "arrayBuffer"],
      l = [],
      q = function q(b) {
    return function (c) {
      return new a(!0).update(c)[b]();
    };
  };a.prototype.update = function (a) {
    if (!this.finalized) {
      var c = "string" !== typeof a;c && a.constructor === b.ArrayBuffer && (a = new Uint8Array(a));for (var p, f = 0, e, h = a.length || 0, g = this.blocks; f < h;) {
        this.hashed && (this.hashed = !1, g[0] = this.block, g[16] = g[1] = g[2] = g[3] = g[4] = g[5] = g[6] = g[7] = g[8] = g[9] = g[10] = g[11] = g[12] = g[13] = g[14] = g[15] = 0);if (c) for (e = this.start; f < h && 64 > e; ++f) {
          g[e >> 2] |= a[f] << d[e++ & 3];
        } else for (e = this.start; f < h && 64 > e; ++f) {
          p = a.charCodeAt(f), 128 > p ? g[e >> 2] |= p << d[e++ & 3] : (2048 > p ? g[e >> 2] |= (192 | p >> 6) << d[e++ & 3] : (55296 > p || 57344 <= p ? g[e >> 2] |= (224 | p >> 12) << d[e++ & 3] : (p = 65536 + ((p & 1023) << 10 | a.charCodeAt(++f) & 1023), g[e >> 2] |= (240 | p >> 18) << d[e++ & 3], g[e >> 2] |= (128 | p >> 12 & 63) << d[e++ & 3]), g[e >> 2] |= (128 | p >> 6 & 63) << d[e++ & 3]), g[e >> 2] |= (128 | p & 63) << d[e++ & 3]);
        }this.lastByteIndex = e;this.bytes += e - this.start;64 <= e ? (this.block = g[16], this.start = e - 64, this.hash(), this.hashed = !0) : this.start = e;
      }return this;
    }
  };a.prototype.finalize = function () {
    if (!this.finalized) {
      this.finalized = !0;var a = this.blocks,
          b = this.lastByteIndex;a[16] = this.block;a[b >> 2] |= m[b & 3];this.block = a[16];56 <= b && (this.hashed || this.hash(), a[0] = this.block, a[16] = a[1] = a[2] = a[3] = a[4] = a[5] = a[6] = a[7] = a[8] = a[9] = a[10] = a[11] = a[12] = a[13] = a[14] = a[15] = 0);a[15] = this.bytes << 3;this.hash();
    }
  };a.prototype.hash = function () {
    var a = this.h0,
        b = this.h1,
        c = this.h2,
        f = this.h3,
        e = this.h4,
        h,
        g = this.blocks;for (h = 16; 80 > h; ++h) {
      var k = g[h - 3] ^ g[h - 8] ^ g[h - 14] ^ g[h - 16];g[h] = k << 1 | k >>> 31;
    }for (h = 0; 20 > h; h += 5) {
      var d = b & c | ~b & f;k = a << 5 | a >>> 27;e = k + d + e + 1518500249 + g[h] << 0;b = b << 30 | b >>> 2;d = a & b | ~a & c;k = e << 5 | e >>> 27;f = k + d + f + 1518500249 + g[h + 1] << 0;a = a << 30 | a >>> 2;d = e & a | ~e & b;k = f << 5 | f >>> 27;c = k + d + c + 1518500249 + g[h + 2] << 0;e = e << 30 | e >>> 2;d = f & e | ~f & a;k = c << 5 | c >>> 27;b = k + d + b + 1518500249 + g[h + 3] << 0;f = f << 30 | f >>> 2;d = c & f | ~c & e;k = b << 5 | b >>> 27;a = k + d + a + 1518500249 + g[h + 4] << 0;c = c << 30 | c >>> 2;
    }for (; 40 > h; h += 5) {
      d = b ^ c ^ f, k = a << 5 | a >>> 27, e = k + d + e + 1859775393 + g[h] << 0, b = b << 30 | b >>> 2, d = a ^ b ^ c, k = e << 5 | e >>> 27, f = k + d + f + 1859775393 + g[h + 1] << 0, a = a << 30 | a >>> 2, d = e ^ a ^ b, k = f << 5 | f >>> 27, c = k + d + c + 1859775393 + g[h + 2] << 0, e = e << 30 | e >>> 2, d = f ^ e ^ a, k = c << 5 | c >>> 27, b = k + d + b + 1859775393 + g[h + 3] << 0, f = f << 30 | f >>> 2, d = c ^ f ^ e, k = b << 5 | b >>> 27, a = k + d + a + 1859775393 + g[h + 4] << 0, c = c << 30 | c >>> 2;
    }for (; 60 > h; h += 5) {
      d = b & c | b & f | c & f, k = a << 5 | a >>> 27, e = k + d + e - 1894007588 + g[h] << 0, b = b << 30 | b >>> 2, d = a & b | a & c | b & c, k = e << 5 | e >>> 27, f = k + d + f - 1894007588 + g[h + 1] << 0, a = a << 30 | a >>> 2, d = e & a | e & b | a & b, k = f << 5 | f >>> 27, c = k + d + c - 1894007588 + g[h + 2] << 0, e = e << 30 | e >>> 2, d = f & e | f & a | e & a, k = c << 5 | c >>> 27, b = k + d + b - 1894007588 + g[h + 3] << 0, f = f << 30 | f >>> 2, d = c & f | c & e | f & e, k = b << 5 | b >>> 27, a = k + d + a - 1894007588 + g[h + 4] << 0, c = c << 30 | c >>> 2;
    }for (; 80 > h; h += 5) {
      d = b ^ c ^ f, k = a << 5 | a >>> 27, e = k + d + e - 899497514 + g[h] << 0, b = b << 30 | b >>> 2, d = a ^ b ^ c, k = e << 5 | e >>> 27, f = k + d + f - 899497514 + g[h + 1] << 0, a = a << 30 | a >>> 2, d = e ^ a ^ b, k = f << 5 | f >>> 27, c = k + d + c - 899497514 + g[h + 2] << 0, e = e << 30 | e >>> 2, d = f ^ e ^ a, k = c << 5 | c >>> 27, b = k + d + b - 899497514 + g[h + 3] << 0, f = f << 30 | f >>> 2, d = c ^ f ^ e, k = b << 5 | b >>> 27, a = k + d + a - 899497514 + g[h + 4] << 0, c = c << 30 | c >>> 2;
    }this.h0 = this.h0 + a << 0;this.h1 = this.h1 + b << 0;this.h2 = this.h2 + c << 0;this.h3 = this.h3 + f << 0;this.h4 = this.h4 + e << 0;
  };a.prototype.hex = function () {
    this.finalize();var a = this.h0,
        b = this.h1,
        d = this.h2,
        f = this.h3,
        e = this.h4;return c[a >> 28 & 15] + c[a >> 24 & 15] + c[a >> 20 & 15] + c[a >> 16 & 15] + c[a >> 12 & 15] + c[a >> 8 & 15] + c[a >> 4 & 15] + c[a & 15] + c[b >> 28 & 15] + c[b >> 24 & 15] + c[b >> 20 & 15] + c[b >> 16 & 15] + c[b >> 12 & 15] + c[b >> 8 & 15] + c[b >> 4 & 15] + c[b & 15] + c[d >> 28 & 15] + c[d >> 24 & 15] + c[d >> 20 & 15] + c[d >> 16 & 15] + c[d >> 12 & 15] + c[d >> 8 & 15] + c[d >> 4 & 15] + c[d & 15] + c[f >> 28 & 15] + c[f >> 24 & 15] + c[f >> 20 & 15] + c[f >> 16 & 15] + c[f >> 12 & 15] + c[f >> 8 & 15] + c[f >> 4 & 15] + c[f & 15] + c[e >> 28 & 15] + c[e >> 24 & 15] + c[e >> 20 & 15] + c[e >> 16 & 15] + c[e >> 12 & 15] + c[e >> 8 & 15] + c[e >> 4 & 15] + c[e & 15];
  };a.prototype.toString = a.prototype.hex;
  a.prototype.digest = function () {
    this.finalize();var a = this.h0,
        b = this.h1,
        c = this.h2,
        d = this.h3,
        e = this.h4;return [a >> 24 & 255, a >> 16 & 255, a >> 8 & 255, a & 255, b >> 24 & 255, b >> 16 & 255, b >> 8 & 255, b & 255, c >> 24 & 255, c >> 16 & 255, c >> 8 & 255, c & 255, d >> 24 & 255, d >> 16 & 255, d >> 8 & 255, d & 255, e >> 24 & 255, e >> 16 & 255, e >> 8 & 255, e & 255];
  };a.prototype.array = a.prototype.digest;a.prototype.arrayBuffer = function () {
    this.finalize();var a = new ArrayBuffer(20),
        b = new DataView(a);b.setUint32(0, this.h0);b.setUint32(4, this.h1);b.setUint32(8, this.h2);b.setUint32(12, this.h3);
    b.setUint32(16, this.h4);return a;
  };var r = function () {
    var b = q("hex");b.create = function () {
      return new a();
    };b.update = function (a) {
      return b.create().update(a);
    };for (var c = 0; c < n.length; ++c) {
      var d = n[c];b[d] = q(d);
    }return b;
  }();b.a1 = r;
})();
(function (a) {
  var b = function b(a) {
    a = a || {};this.startingPos = a.startingPos;this.endingPos = a.endingPos ? a.endingPos : Math.pow(2, 31) - 1;this.step = a.step || 15E3;this.eachElement = a.eachElement;if ("undefined" === typeof this.startingPos || "function" !== typeof this.eachElement) throw Error("Invalid arguments");this.currentPos = this.startingPos;this.running = !0;this.timer = 0;
  };b.prototype.runIt = function () {
    var a = this;(function d() {
      for (; a.currentPos <= a.endingPos && a.running; a.currentPos++) {
        if (a.eachElement(a.currentPos), 0 === a.currentPos % a.step) {
          a.currentPos++;a.timer = setTimeout(d, 0);break;
        }
      }
    })();
  };b.prototype.stopIt = function () {
    this.running = !1;clearTimeout(this.timer);
  };a.BDCustomFor = b;
})(window);
"undefined" === typeof BotDetect && (BotDetect = function (_BotDetect) {
  function BotDetect(_x, _x2, _x3, _x4, _x5, _x6, _x7, _x8, _x9, _x10, _x11, _x12, _x13, _x14) {
    return _BotDetect.apply(this, arguments);
  }

  BotDetect.toString = function () {
    return _BotDetect.toString();
  };

  return BotDetect;
}(function (a, b, c, m, d, n, l, q, r, p, t, u, f, e) {
  this.Id = a;this.InstanceId = b;this.Image = document.getElementById(a + "_CaptchaImage");this.ImagePlaceholder = this.Image.parentNode;this.ImageSrcUrl = this.Image.src;this.ImageColorMode = u;this.Base64Image = this.GrayscaleImageDataUrl = this.ColorImageDataUrl = null;this.ControlsDisabled = !1;if (b = document.getElementById(a + "_ReloadLink")) if (b.style.cssText = "display: inline-block !important", this.ReloadTimer = this.ProgressIndicator = this.NewImage = null, this.ReloadTimerTicks = 0, this.AutoReloadPeriod = 1E3 * Math.max(q - 10, 10), this.AutoReloadTimeout = 1E3 * r, this.AutoReloadExpiredImage = l, this.AutoReloadPeriodSum = 0, this.AutoReloading = !1, l) {
    this.AutoReloadTimer && clearTimeout(this.AutoReloadTimer);var h = this;this.AutoReloadTimer = setTimeout(function () {
      clearTimeout(h.AutoReloadTimer);h.AutoReloadPeriodSum >= h.AutoReloadTimeout ? (h.DisableControls(), h.SessionExpired = !0) : (h.AutoReloading = !0, h.ReloadImage(), h.AutoReloading = !1, h.AutoReloadPeriodSum += h.AutoReloadPeriod, h = null);
    }, h.AutoReloadPeriod);
  }if (document.getElementById(this.Id + "_ReloadIcon")) {
    this.ReloadIconSrc = document.getElementById(this.Id + "_ReloadIcon").src;this.DisabledReloadIconSrc = null;l = document.createElement("img");var g = this;l.onload = function () {
      g.DisabledReloadIconSrc = this.src;g = null;
    };l.src = this.ReloadIconSrc.replace("icon", "disabled-icon");
  }this.SoundStartDelay = p;this.LimitSoundRegeneration = t;this.SoundPlayDelayed = this.SoundPlayed = !1;if (p = document.getElementById(a + "_SoundLink")) this.SoundUrl = p.href;
  this.SoundPlaceholder = document.getElementById(a + "_AudioPlaceholder");if (document.getElementById(this.Id + "_SoundIcon")) {
    this.SoundIconSrc = document.getElementById(this.Id + "_SoundIcon").src;this.DisabledSoundIconSrc = null;a = document.createElement("img");var k = this;a.onload = function () {
      k.DisabledSoundIconSrc = this.src;k = null;
    };this.SoundIconSrc.match(/disabled-icon/) || (a.src = this.SoundIconSrc.replace("icon", "disabled-icon"));
  }this.ValidationUrl = this.ImageSrcUrl.replace("get=image", "get=validation-result");
  this.PUrl = this.ImageSrcUrl.replace("get=image", "get=p");this.FollowHelpLink = !0;this.JavaScriptRequired = f;this.IsTestModeEnabled = e;c && (this.InputId = c, c = BotDetect.GetInputElement(c)) && (this.UserInput = c, c.Captcha = this, c.setAttribute("autocomplete", "off"), this.AutoFocusInput = d, this.AutoClearInput = n, c.style.textTransform = m ? "uppercase" : "lowercase");
}), BotDetect.Init = function (a, b, c, m, d, n, l, q, r, p, t, u, f, e) {
  var h = function h() {
    document.getElementById(a + "_CaptchaImage") && (window[a] = new BotDetect(a, b, c, m, d, n, l, q, r, p, t, u, f, e), window[a].PostInit(), window[a].InitEventListeners());
  };"undefined" != typeof window.jQuery ? jQuery(h) : BotDetect.RegisterHandler(window, "domready", h, !1);window.opera ? BotDetect.RegisterHandler(window, "popstate", function (b) {
    window[a].ReloadImage();
  }, !1) : window.chrome ? BotDetect.RegisterHandler(window, "domready", function (b) {
    b = document.getElementById("BDC_BackWorkaround_" + a);"0" == b.value ? b.value = "1" : (b.value = "0", window[a].ReloadImage());
  }, !1) : BotDetect.RegisterHandler(window, "pageshow", function (b) {
    b && b.persisted && window[a].ReloadImage();
  }, !1);
}, BotDetect.ReloadTimerMaxTicks = 100, BotDetect.ReloadTimerDelay = 250, BotDetect.MillisecondsInAMinute = 6E4, BotDetect.AjaxTimeout = 1E4, BotDetect.MinSoundCooldown = 2E3, BotDetect.ConvertGrayscaleImageTimerDelay = 500, BotDetect.GrayscaleImageFilterCss = "-webkit-filter: grayscale(100%)!important;-moz-filter: grayscale(100%)!important;-ms-filter: grayscale(100%)!important;-o-filter: grayscale(100%)!important;filter: grayscale(100%)!important;filter: url('url(\"data:image/svg+xml;utf8,<svg%20xmlns='http://www.w3.org/2000/svg'><filter%20id='grayscale'><feColorMatrix%20type='matrix'%20values='0.3333%200.3333%200.3333%200%200%200.3333%200.3333%200.3333%200%200%200.3333%200.3333%200.3333%200%200%200%200%200%201%200'/></filter></svg>#grayscale\");')!important;filter: gray!important", BotDetect.prototype.ReloadImage = function () {
  var a = this,
      b = function b() {
    if (a.Image && !a.ReloadInProgress && !a.SessionExpired && (!a.ControlsDisabled || a.SoundPlayDelayed)) {
      a.ReloadInProgress = !0;a.DisableControls();a.ProgressIndicator = document.createElement("span");a.ProgressIndicator.className = "BDC_ProgressIndicator";a.ProgressIndicator.appendChild(document.createTextNode("."));a.PreReloadImage();var b = BotDetect.UpdateTimestamp(a.ImageSrcUrl);a.InitNewImage(b);a.ImagePlaceholder.innerHTML = "";a.ImagePlaceholder.appendChild(a.ProgressIndicator);
      a.ShowProgress();a = null;
    }
  };this.UseM() ? this.GP(b) : b();
}, BotDetect.prototype.InitNewImage = function (a) {
  this.NewImage = document.createElement("img");var b = this,
      c = !1;this.NewImage.onload = function () {
    !c && b.NewImage && b.ImagePlaceholder && b.ProgressIndicator && (b.ImagePlaceholder.innerHTML = "", b.ImagePlaceholder.appendChild(b.NewImage), b.Image = b.NewImage, b.ProgressIndicator = null, b.InitImageColorModeHandler(), b.PostReloadImage(), b = null, c = !0);
  };this.NewImage.id = this.Image.id;this.NewImage.alt = this.Image.alt;this.ImageSrcUrl = this.NewImage.src = a;"none" !== this.ImageColorMode && this.NewImage.setAttribute("style", "visibility: hidden !important");
}, BotDetect.prototype.ShowProgress = function () {
  if (this.ProgressIndicator && this.ReloadTimerTicks < BotDetect.ReloadTimerMaxTicks) {
    this.ReloadTimerTicks += 1;this.UpdateProgressIndicator();var a = this;this.ReloadTimer = setTimeout(function () {
      a.ShowProgress();a = null;
    }, BotDetect.ReloadTimerDelay);
  } else clearTimeout(this.ReloadTimer), this.ReloadTimerTicks = 0, this.ReloadInProgress = !1;
}, BotDetect.prototype.UpdateProgressIndicator = function () {
  0 == this.ProgressIndicator.childNodes.length ? this.ProgressIndicator.appendChild(document.createTextNode(".")) : this.ProgressIndicator.firstChild.nodeValue = 0 === this.ReloadTimerTicks % 5 ? "." : this.ProgressIndicator.firstChild.nodeValue + ".";
}, BotDetect.prototype.PlaySound = function () {
  if (document.getElementById && !this.SoundPlayingInProgess && (!this.ControlsDisabled || this.SoundPlayDelayed)) if (this.DisableControls(), this.LimitSoundRegeneration && !BotDetect.SoundReplaySupported() && this.SoundPlayed) this.SoundPlayDelayed = !0, this.ReloadImage();else {
    this.SoundPlayingInProgess = !0;if (BotDetect.UseHtml5Audio()) {
      var a = this,
          b = document.getElementById("BDC_CaptchaSoundAudio_" + this.Id);b ? (b.currentTime = 0, this.SoundStartDelayTimer = setTimeout(function () {
        a && (clearTimeout(a.SoundStartDelayTimer), a.PrePlaySound(), document.getElementById("BDC_CaptchaSoundAudio_" + a.Id).play());
      }, this.SoundStartDelay)) : (this.SoundPlaceholder.innerHTML = "", b = this.SoundUrl, b = BotDetect.UpdateTimestamp(b), b = BotDetect.DetectSsl(b), b = new Audio(b), b.id = "BDC_CaptchaSoundAudio_" + this.Id, b.type = "audio/wav", b.autobuffer = !1, b.loop = !1, b.autoplay = !1, b.preload = "auto", this.SoundPlaceholder.appendChild(b), b.load(), BotDetect.RegisterHandler(b, "canplay", function () {
        a && (a.SoundStartDelayTimer = setTimeout(function () {
          clearTimeout(a.SoundStartDelayTimer);a.PrePlaySound();document.getElementById("BDC_CaptchaSoundAudio_" + a.Id).play();
        }, a.SoundStartDelay));
      }, !1));BotDetect.RegisterHandler(b, "ended", function () {
        if (a) {
          var b = document.getElementById("BDC_CaptchaSoundAudio_" + a.Id);1 == b.duration ? b.play() : (a.SoundPlayingInProgess = !1, a.EnableControls(), a = null);
        }
      }, !1);
    } else this.SoundPlaceholder.innerHTML = "", a = this, this.SoundStartDelayTimer = setTimeout(function () {
      clearTimeout(a.SoundStartDelayTimer);a.PrePlaySound();a.StartXhtmlSoundPlayback();
    }, this.SoundStartDelay);this.SoundPlayed = !0;
  }
}, BotDetect.prototype.StartXhtmlSoundPlayback = function () {
  var a = this.SoundUrl;a = BotDetect.UpdateTimestamp(a);a = BotDetect.DetectSsl(a);a = "<object id='BDC_CaptchaSoundObject_" + this.Id + "' classid='clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95' height='0' width='0' style='width:0; height:0;'><param name='AutoStart' value='1' /><param name='Volume' value='0' /><param name='PlayCount' value='1' /><param name='FileName' value='" + a + "' /><embed id='BDC_CaptchaSoundEmbed' src='" + a + "' autoplay='true' hidden='true' volume='100' type='" + BotDetect.GetMimeType() + "' style='display:inline;' /></object>";this.SoundPlaceholder.innerHTML = a;var b = this;this.SoundCooldownTimer = setTimeout(function () {
    b && (clearTimeout(b.SoundCooldownTimer), b.SoundPlayingInProgess = !1, b.EnableControls(), b = null);
  }, BotDetect.MinSoundCooldown);
}, BotDetect.prototype.StartAjaxValidation = function () {
  this.PreAjaxValidate();if (!BotDetect.AjaxError) {
    var a = this.GetUserInputElement();
    !a || !a.value || 0 > a.value.length ? this.AjaxValidationFailed() : this.StartValidationRequest();
  }
}, BotDetect.prototype.StartValidationRequest = function () {
  var a = this.GetUserInputElement();a = this.ValidationUrl + "&i=" + a.value;var b = this;this.AjaxTimer = setTimeout(b.AjaxValidationError, BotDetect.AjaxTimeout);BotDetect.Get(a, function (a) {
    clearTimeout(b.AjaxTimer);if (200 != a.status) b.AjaxValidationError();else {
      var c = !1;(a = BotDetect.ParseJson(a.responseText)) && (c = a);b.EndValidationRequest(c);
    }b = null;
  });
}, BotDetect.prototype.EndValidationRequest = function (a) {
  a ? this.AjaxValidationPassed() : this.AjaxValidationFailed();
}, BotDetect.ParseJson = function (a) {
  var b = null;"undefined" != typeof JSON && "function" == typeof JSON.parse && (b = JSON.parse(a));b || (b = eval("(" + a + ")"));return b;
}, BotDetect.prototype.InitEventListeners = function () {
  var a = this,
      b = document.getElementById(this.Id + "_ReloadLink");b && BotDetect.RegisterHandler(b, "click", function (b) {
    a.ReloadImage();this.blur();b.preventDefault ? b.preventDefault() : b.returnValue = !1;
  }, !1);(b = document.getElementById(this.Id + "_SoundLink")) && BotDetect.RegisterHandler(b, "click", function (b) {
    a.PlaySound();this.blur();b.preventDefault ? b.preventDefault() : b.returnValue = !1;
  }, !1);(b = document.getElementById(this.Id + "_HelpLink")) && BotDetect.RegisterHandler(b, "click", function (b) {
    a.OnHelpLinkClick();a.FollowHelpLink || (b.preventDefault ? b.preventDefault() : b.returnValue = !1);
  }, !1);
}, BotDetect.prototype.GetUserInputElement = function () {
  return this.UserInput ? this.UserInput : BotDetect.GetInputElement(this.InputId);
}, BotDetect.GetInputElement = function (a) {
  var b = null,
      c = document.getElementById(a);if (c) b = c;else if (c = document.querySelectorAll ? document.querySelectorAll("input[type=text]") : document.getElementsByTagName("input"), 0 !== c.length) for (var m = 0; m < c.length; m++) {
    if ("text" === c[m].type && -1 !== c[m].id.indexOf(a)) {
      b = c[m];break;
    }
  }return b;
}, BotDetect.prototype.PostInit = function () {
  this.IsCaptchaSecure() || console.error('Captcha.UserInputID is not set. Your implementation of BotDetect is not completely secure yet. \n Please add "$yourCaptchaInstance->UserInputID = <CAPTCHA_CODE_INPUT_ID>;" line to the code that adds Captcha to this form.');
  if (this.UseM()) {
    var a = this;this.P(function (b) {
      a.M(b, !1, !1);
    });
  }this.InitImageColorModeHandler();
}, BotDetect.prototype.PreReloadImage = function () {
  "none" !== this.ImageColorMode && this.HideImage();this.ClearInput();this.FocusInput();
}, BotDetect.prototype.PostReloadImage = function () {
  this.ValidationUrl = this.ImageSrcUrl.replace("get=image", "get=validation-result");if (this.AutoReloadExpiredImage) {
    this.AutoReloadTimer && clearTimeout(this.AutoReloadTimer);var a = this;this.AutoReloadTimer = setTimeout(function () {
      clearTimeout(a.AutoReloadTimer);
      a.AutoReloadPeriodSum >= a.AutoReloadTimeout ? (a.DisableControls(), a.SessionExpired = !0) : (a.AutoReloading = !0, a.ReloadImage(), a.AutoReloading = !1, a.AutoReloadPeriodSum += a.AutoReloadPeriod, a = null);
    }, a.AutoReloadPeriod);
  }this.SoundIconSrc ? (this.SoundPlaceholder.innerHTML = "", this.SoundPlayed = !1, this.SoundPlayDelayed ? (this.PlaySound(), this.SoundPlayDelayed = !1) : this.EnableControls()) : this.EnableControls();
}, BotDetect.prototype.PrePlaySound = function () {
  this.FocusInput();
}, BotDetect.prototype.OnHelpLinkClick = function () {}, BotDetect.prototype.PreAjaxValidate = function () {}, BotDetect.prototype.AjaxValidationFailed = function () {
  this.ReloadImage();
}, BotDetect.prototype.AjaxValidationPassed = function () {}, BotDetect.prototype.AjaxValidationError = function () {
  BotDetect.Xhr().abort();BotDetect.AjaxError = !0;
}, BotDetect.RegisterCustomHandler = function (a, b) {
  var c = BotDetect.prototype[a];BotDetect.prototype[a] = function () {
    b.call(this);c.call(this);
  };
}, BotDetect.prototype.FocusInput = function () {
  var a = this.GetUserInputElement();this.AutoFocusInput && a && (this.AutoReloading || a.focus());
}, BotDetect.prototype.ClearInput = function () {
  var a = this.GetUserInputElement();this.AutoClearInput && a && (a.value = "");
}, BotDetect.UpdateTimestamp = function (a) {
  var b = a.indexOf("&d=");-1 !== b && (a = a.substring(0, b));return a + "&d=" + BotDetect.GetTimestamp();
}, BotDetect.GetTimestamp = function () {
  var a = new Date();return a.getTime() + a.getTimezoneOffset() * BotDetect.MillisecondsInAMinute;
}, BotDetect.DetectSsl = function (a) {
  var b = a.indexOf("&e=");if (-1 !== b) {
    var c = a.length;a = a.substring(0, b) + a.substring(b + 4, c);
  }"https:" === document.location.protocol && (a += "&e=1");return a;
}, BotDetect.GetMimeType = function () {
  return "audio/x-wav";
}, BotDetect.UseHtml5Audio = function () {
  if (BotDetect.DetectAndroid() || BotDetect.DetectIOS()) var a = !0;else a = document.createElement("audio"), a = !!a.canPlayType && !!a.canPlayType("audio/wav") && !BotDetect.DetectIncompatibleAudio();return a;
}, BotDetect.DetectIncompatibleAudio = function () {
  return BotDetect.DetectFirefox3();
}, BotDetect.DetectAndroid = function () {
  var a = !1;navigator && navigator.userAgent && navigator.userAgent.match(/Linux; U; Android/) && (a = !0);return a;
}, BotDetect.DetectIOS = function () {
  var a = !1;if (navigator && navigator.userAgent) {
    var b = navigator.userAgent.toLowerCase();if (b.match(/like mac os/) || b.match(/like macos/)) a = !0;
  }return a;
}, BotDetect.DetectFirefox3 = function () {
  var a = !1;navigator && navigator.userAgent && navigator.userAgent.match(/(Firefox)\/(3\.6\.[^;\+,\/\s]+)/) && (a = !0);return a;
}, BotDetect.DetectSafariSsl = function () {
  var a = !1;if (navigator && navigator.userAgent) {
    var b = navigator.userAgent.match(/Safari/);
    b && ((b = navigator.userAgent.match(/Chrome/)) || "https:" !== document.location.protocol || (a = !0));
  }return a;
}, BotDetect.DetectAndroidBelow41 = function () {
  var a = !1;if (navigator && navigator.userAgent) {
    var b = navigator.userAgent.indexOf("Android");0 <= b && 4.1 > parseFloat(navigator.userAgent.slice(b + 8)) && (a = !0);
  }return a;
}, BotDetect.SoundReplaySupported = function () {
  return BotDetect.UseHtml5Audio() && !BotDetect.DetectAndroidBelow41();
}, BotDetect.DetectIE = function () {
  if (navigator && navigator.userAgent) {
    var a = navigator.userAgent.toLowerCase();
    if (-1 !== a.indexOf("msie") || -1 !== a.indexOf("trident/")) return !0;
  }return !1;
}, BotDetect.GetIosSafariVersion = function () {
  var a = null;if (navigator && navigator.userAgent) {
    var b = !1,
        c = navigator.userAgent;-1 === c.indexOf("iPhone OS") && -1 === c.indexOf("iPad") || -1 === c.indexOf("Safari") || -1 !== c.indexOf("CriOS") || -1 !== c.indexOf("FxiOS") || (b = !0);b && (b = c.split("Version/"), 2 === b.length && (a = parseFloat(b[1])));
  }return a;
}, BotDetect.DetectFilterCssSupport = function () {
  if (BotDetect.DetectIE()) return !1;var a = BotDetect.GetIosSafariVersion();
  if (a && 9 > a) return !1;a = document.createElement("div");a.style.cssText = "-webkit-filter: blur(1px)";return 0 === a.style.length ? !1 : !0;
}, BotDetect.prototype.DisableControls = function () {
  this.ControlsDisabled = !0;this.DisableReloadIcon();this.DisableSoundIcon();
}, BotDetect.prototype.EnableControls = function () {
  this.ControlsDisabled = !1;this.EnableReloadIcon();this.EnableSoundIcon();
}, BotDetect.prototype.DisableReloadIcon = function () {
  this.ReloadIconSrc && this.DisabledReloadIconSrc && (document.getElementById(this.Id + "_ReloadIcon").src = this.DisabledReloadIconSrc);
}, BotDetect.prototype.EnableReloadIcon = function () {
  this.ReloadIconSrc && this.DisabledReloadIconSrc && (document.getElementById(this.Id + "_ReloadIcon").src = this.ReloadIconSrc);
}, BotDetect.prototype.DisableSoundIcon = function () {
  this.SoundIconSrc && this.DisabledSoundIconSrc && (document.getElementById(this.Id + "_SoundIcon").src = this.DisabledSoundIconSrc);
}, BotDetect.prototype.EnableSoundIcon = function () {
  this.SoundIconSrc && this.DisabledSoundIconSrc && (document.getElementById(this.Id + "_SoundIcon").src = this.SoundIconSrc);
}, BotDetect.RegisterHandler = function (a, b, c, m) {
  if ("domready" == b) BotDetect.RegisterDomReadyHandler(c);else if ("undefined" != typeof a.addEventListener) a.addEventListener(b, c, m);else if ("undefined" != typeof a.attachEvent) {
    var d = b + c;a["e" + d] = c;a[d] = function (b) {
      "undefined" == typeof b && (b = window.event);a["e" + d](b);
    };a.attachEvent("on" + b, a[d]);
  } else if (b = "on" + b, "function" == typeof a[b]) {
    var n = a[b];a[b] = function () {
      n();return c();
    };
  } else a[b] = c;
}, BotDetect.RegisterDomReadyHandler = function (a) {
  if (document.addEventListener) document.addEventListener("DOMContentLoaded", function () {
    document.removeEventListener("DOMContentLoaded", arguments.callee, !1);a();
  }, !1);else if (document.attachEvent) {
    var b = !1;document.attachEvent("onreadystatechange", function () {
      "complete" === document.readyState && (document.detachEvent("onreadystatechange", arguments.callee), a(), b = !0);
    });document.documentElement.doScroll && window == window.top && function () {
      if (!b) {
        try {
          document.documentElement.doScroll("left");
        } catch (c) {
          setTimeout(arguments.callee, 1);return;
        }a();b = !0;
      }
    }();
  } else BotDetect.RegisterHandler(window, "load", a, !1);
}, BotDetect.Xhr = function () {
  var a = null;try {
    return a = new XMLHttpRequest();
  } catch (b) {}try {
    return a = new ActiveXObject("MSXML2.XMLHTTP.5.0");
  } catch (b) {}try {
    return a = new ActiveXObject("MSXML2.XMLHTTP.4.0");
  } catch (b) {}try {
    return a = new ActiveXObject("MSXML2.XMLHTTP.3.0");
  } catch (b) {}try {
    return a = new ActiveXObject("MSXML2.XMLHTTP");
  } catch (b) {}try {
    return a = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (b) {}return a;
}, BotDetect.Get = function (a, b) {
  BotDetect.AjaxError = !1;var c = BotDetect.Xhr();c && 0 == c.readyState && (c.onreadystatechange = function () {
    4 == c.readyState && b(c);
  }, c.open("GET", a, !0), c.send());
}, BotDetect.prototype.ConvertImageToBase64Image = function (a) {
  this.Base64Image = document.createElement("img");var b = this,
      c = !1;this.Base64Image.onload = function () {
    if (!c && b.ImagePlaceholder) {
      b.ImagePlaceholder.innerHTML = "";var m = BotDetect.ImageProcess.GetBase64ImageDataUrl(b.Base64Image);b.Base64Image.src = m;b.ImagePlaceholder.appendChild(b.Base64Image);b.ColorImageDataUrl = m;b.Image = b.Base64Image;b = null;c = !0;"function" === typeof a && a();
    }
  };this.Base64Image.id = this.Image.id;this.Base64Image.alt = this.Image.alt;this.Base64Image.src = this.Image.src;"none" !== this.ImageColorMode && this.Base64Image.setAttribute("style", "visibility: hidden !important");
}, BotDetect.prototype.ShowImage = function () {
  this.Image && (BotDetect.DetectFilterCssSupport() ? this.Image.setAttribute("style", "visibility: visible !important") : (this.ImagePlaceholder.innerHTML = "", this.Base64Image ? (this.Base64Image.setAttribute("style", "visibility: visible !important"), this.ImagePlaceholder.appendChild(this.Base64Image)) : (this.Image.style.visibility = "visible", this.ImagePlaceholder.appendChild(this.Image))));
}, BotDetect.prototype.HideImage = function () {
  this.Image && this.Image.setAttribute("style", "visibility: hidden !important");
}, BotDetect.prototype.InitImageColorModeHandler = function () {
  if (BotDetect.DetectFilterCssSupport()) {
    switch (this.ImageColorMode) {case "color":
        this.Image.setAttribute("style", "visibility: visible !important");break;case "grayscale":
        this.Image.setAttribute("style", BotDetect.GrayscaleImageFilterCss);}this.RegisterImageHoverHandler();
  } else if (BotDetect.IsCanvasSupported()) {
    var a = this;switch (this.ImageColorMode) {case "color":
        this.ConvertImageToBase64Image(function () {
          a.ShowImage();a.RegisterImageHoverHandler();
        });break;case "grayscale":
        this.ConvertImageToBase64Image(function () {
          a.ConvertColorImageToGrayscale(function () {
            a.ShowImage();a.RegisterImageHoverHandler();
          });
        });}
  } else this.ShowImage();
}, BotDetect.prototype.ConvertColorImageToGrayscale = function (a) {
  var b = 0;!this.ReloadInProgress && BotDetect.DetectIOS() && (b = BotDetect.ConvertGrayscaleImageTimerDelay);var c = this,
      m = function m() {
    setTimeout(function () {
      var b = BotDetect.ImageProcess.GetBase64GrayscaleImageDataUrl(d);d.src = b;c.GrayscaleImageDataUrl = b;"function" === typeof a && a();c = null;
    }, b);
  },
      d = this.Image;d.complete || 0 !== d.naturalHeight ? m() : d.onload = function () {
    m();
  };
}, BotDetect.prototype.RegisterImageHoverHandler = function () {
  if ("none" !== this.ImageColorMode) {
    var a = this;BotDetect.DetectFilterCssSupport() ? (BotDetect.RegisterHandler(this.Image, "mouseenter", function (b) {
      switch (a.ImageColorMode) {case "color":
          this.setAttribute("style", BotDetect.GrayscaleImageFilterCss);break;case "grayscale":
          this.setAttribute("style", "");}
    }, !1), BotDetect.RegisterHandler(this.Image, "mouseleave", function (b) {
      switch (a.ImageColorMode) {case "color":
          this.setAttribute("style", "");break;case "grayscale":
          this.setAttribute("style", BotDetect.GrayscaleImageFilterCss);}
    }, !1)) : (BotDetect.RegisterHandler(this.ImagePlaceholder, "mouseenter", function (b) {
      if (0 < this.children.length) switch (a.ImageColorMode) {case "color":
          a.GrayscaleImageDataUrl = BotDetect.ImageProcess.GetBase64GrayscaleImageDataUrl(this.children[0]);this.children[0].src = a.GrayscaleImageDataUrl;break;case "grayscale":
          this.children[0].src = a.ColorImageDataUrl;}
    }, !1), BotDetect.RegisterHandler(this.ImagePlaceholder, "mouseleave", function (b) {
      if (0 < this.children.length) switch (a.ImageColorMode) {case "color":
          this.children[0].src = a.ColorImageDataUrl;break;case "grayscale":
          this.children[0].src = a.GrayscaleImageDataUrl;}
    }, !1));
  }
}, BotDetect.ImageProcess = { GetBase64ImageDataUrl: function GetBase64ImageDataUrl(a) {
    var b = document.createElement("canvas");b.width = a.width;b.height = a.height;b.getContext("2d").drawImage(a, 0, 0);return b.toDataURL("image/jpeg");
  }, sRGBFromLinear: function sRGBFromLinear(a) {
    return .0031308 < a ? 1.055 * Math.pow(a, 1 / 2.4) - .055 : 12.92 * a;
  }, LinearFromsRGB: function LinearFromsRGB(a) {
    return .04045 <= a ? Math.pow((a + .055) / 1.055, 2.4) : a / 12.92;
  }, GetGrayscaleImageCanvas: function GetGrayscaleImageCanvas(a) {
    var b = new Image();b.src = a.src;var c = document.createElement("canvas"),
        m = c.getContext("2d"),
        d = a.naturalWidth;a = a.naturalHeight;c.width = d;c.height = a;m.drawImage(b, 0, 0);b = m.getImageData(0, 0, d, a);for (var n = 0; n < a; n++) {
      for (var l = 0; l < d; l++) {
        var q = 4 * n * d + 4 * l,
            r = this.LinearFromsRGB(b.data[q] / 255),
            p = this.LinearFromsRGB(b.data[q + 1] / 255),
            t = this.LinearFromsRGB(b.data[q + 2] / 255);r = Math.round(255 * this.sRGBFromLinear(.2126 * r + .7152 * p + .0722 * t));b.data[q] = r;b.data[q + 1] = r;b.data[q + 2] = r;b.data[q + 3] = 255;
      }
    }m.putImageData(b, 0, 0, 0, 0, d, a);return c;
  }, GetBase64GrayscaleImageDataUrl: function GetBase64GrayscaleImageDataUrl(a) {
    return this.GetGrayscaleImageCanvas(a).toDataURL("image/jpeg");
  } }, BotDetect.IsCanvasSupported = function () {
  return !!document.createElement("canvas").getContext;
}, BotDetect.prototype.UseM = function () {
  return this.JavaScriptRequired && this.UserInput && !this.IsTestModeEnabled;
}, BotDetect.prototype.IsCaptchaSecure = function () {
  return !(this.JavaScriptRequired && !this.IsTestModeEnabled && !this.UserInput);
}, BotDetect.prototype.M = function (a, b, c) {
  if (this.UserInput) {
    this._p = a;this._m = BotDetect.CM(this._p);this._bm = BotDetect.CInt2B(this._m);if (!c) {
      var m = this;BotDetect.RegisterHandler(this.UserInput, "keyup", function () {
        var a = this.selectionStart,
            b = this.selectionEnd;this.value = BotDetect.CC2C(this.value, m._bm);this.setSelectionRange && this.setSelectionRange(a, b);
      }, !1);
    }this.UserInput.removeAttribute("disabled");b && this.UserInput.focus();
  }
}, BotDetect.CM = function (a) {
  return a % 65533 + 1;
}, BotDetect.CC2C = function (a, b) {
  b = b.split("");var c = b.length,
      m = a.split(""),
      d = "";for (a = a.length - 1; 0 <= a; a--) {
    var n = b[c-- - 1];n = "undefined" !== typeof n && "1" === n ? m[a].toUpperCase() : m[a].toLowerCase();d = n + d;
  }return d;
}, BotDetect.CInt2B = function (a) {
  return (a >>> 0).toString(2);
}, BotDetect.prototype.P = function (a) {
  this.UserInput && (this.UserInput.setAttribute("disabled", "disabled"), this.FP(function (b) {
    a(b);
  }));
}, BotDetect.prototype.FP = function (a) {
  var b = document.getElementById("BDC_Hs_" + this.Id),
      c = document.getElementById("BDC_SP_" + this.Id);if (b && c) {
    var m = document.getElementById("BDC_VCID_" + this.Id).value,
        d = b.value,
        n,
        l = new BDCustomFor({ startingPos: c.value, step: 2200, eachElement: function eachElement(b) {
        n = "" + b;a1(n + m) === d && (l.stopIt(), a(b));
      } });l.runIt();
  }
}, BotDetect.prototype.GP = function (a) {
  if (!this.GPInProcess && (this.GPInProcess = !0, this.UserInput)) {
    this.UserInput.setAttribute("disabled", "disabled");this.PUrl = this.ImageSrcUrl.replace("get=image", "get=p");var b = this;BotDetect.Get(this.PUrl, function (c) {
      b.GPInProcess = !1;if (200 !== c.status) b = null;else try {
        a();var m = BotDetect.ParseJson(c.responseText),
            d = document.getElementById("BDC_Hs_" + b.Id),
            n = document.getElementById("BDC_SP_" + b.Id);d && n && (d.value = m.hs, n.value = m.sp, b.P(function (a) {
          b.M(a, b.AutoFocusInput, !0);
        }));
      } catch (l) {}
    });
  }
});
//# sourceMappingURL=bdc-traditional-api-script-include.js.map