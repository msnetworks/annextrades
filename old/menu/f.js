;(function(){
window.menuApp = function()
{
	this.params = {
		weekDeltaBack: -3,
		weekDeltaFwd: 2
	};

	this.access = 'user';
	this.bCanEdit = false;
	this.options = {};

	this.div = $('<div class="layout"></div>');
	this.parts = {
		weekSelector: $('<div class="week-selector"></div>').appendTo(this.div),
		weekMenu: $('<div class="week-menu"></div>').appendTo(this.div),
		addForm: null,
		addFormHint: null,
		settingsButton: null
	};

	this.dateStart = null;
	this.dateFinish = null;

	this.hints_data = {};

	window.menuApp.loadLang($.proxy(function()
	{
		$($.proxy(this.ready, this));
	}, this));

	this.init();
};

window.menuApp.loadLang = function(fn)
{
	var supportedLangs = {
		'en':'lang/en.js',
		'de':'lang/de.js',
		'ru':'lang/ru.js',
		'ua':'lang/ua.js'
	};

	var currentLang = BX24.getLang();

	if(typeof supportedLangs[currentLang] == 'undefined')
		currentLang = 'en';

	$.getScript(supportedLangs[currentLang], fn);
};

window.menuApp.prototype.init = function()
{
	this.options = BX24.appOption.get('options');
	this.options.payment = this.options.payment == "1";

	if(BX24.isAdmin())
	{
		this.access = 'admin';
		this.initData();
	}
	else
	{
		BX24.callMethod('user.access', {ACCESS:this.options.access}, $.proxy(function(res){
				this.access = res.data() ? 'editor' : 'user';
				this.initData();
			}, this)
		);
	}
};

window.menuApp.prototype.ready = function()
{
	$("body").append(this.div);
	BX24.fitWindow();
};

window.menuApp.prototype.initData = function()
{
	this.bCanEdit = (this.access == 'admin' || this.access == 'editor');

	var weekStart = this.nullifyDate(new Date());
	weekStart.setUTCDate(weekStart.getUTCDate() - weekStart.getUTCDay() + parseInt(this.options.week_start)||0 - 1);

	var weekFinish = new Date(weekStart.valueOf());
	weekFinish.setUTCDate(weekStart.getUTCDate()+7);

	this.loadData(weekStart, weekFinish);
};

window.menuApp.prototype.loadData = function(dateStart, dateFinish)
{
	this.dateStart = dateStart;
	this.dateFinish = dateFinish;

	BX24.callMethod('entity.item.get', {
		ENTITY: 'menu',
		SORT: {DATE_ACTIVE_FROM: 'ASC', ID: 'ASC'},
		FILTER: {
			'>=DATE_ACTIVE_FROM': dateStart,
			'<DATE_ACTIVE_FROM': dateFinish
		}
	}, $.proxy(this.buildData, this));
};

window.menuApp.prototype.buildData = function(result)
{
	var d = this.params.weekDeltaBack * 7 * 86400 * 1000,
		ds = new Date(this.dateStart.valueOf() + d),
		df = new Date(this.dateFinish.valueOf() + d - 1),
		today = this.nullifyDate(new Date());

	/*
		callbacks and generators
	*/

	// week selector click
	var cb = $.proxy(this.loadData, this),
		gcb = function(tsStart, tsFinish){
			return function() {
				cb(new Date(tsStart), new Date(tsFinish));
			}
		};

	if(this.bCanEdit)
	{
		// add new dish callback
		var cbe = $.proxy(this.addForm, this),
			gcbe = function(tsStart, list)
			{
				return function()
				{
					cbe(new Date(tsStart), list);
				}
			};
		// delete dish from menu callback
		var cbd = $.proxy(this.del, this),
			gcbd = function(id)
			{
				return function()
				{
					cbd(id);
				}
			};
		// share day menu via livefeed
		var cbs = $.proxy(this.share, this),
			gcbs = function(item)
			{
				return function()
				{
					cbs(item);
				}
			};
	}

	if(this.access == 'admin')
	{
		this.buildAdmin();
	}

	if(!!this.parts.addForm)
	{
		this.parts.addForm.hide().appendTo($("body"));
	}

	this.parts.weekSelector.empty();
	this.parts.weekMenu.empty();

	for(var i = this.params.weekDeltaBack; i <= this.params.weekDeltaFwd; i++)
	{
		$('<div class="week-select'+(i == 0 ? ' week-selected' : '')+'">'+this.formatDate(ds, df)+'</div>').on('click', gcb(ds.valueOf(), df.valueOf()+1)).appendTo(this.parts.weekSelector);

		ds.setUTCDate(ds.getUTCDate() + 7);
		df.setUTCDate(df.getUTCDate() + 7);
	}

	if(result.error())
	{
		throw result.error();
	}
	else
	{
		var dishes = [], day = 0;

		for(var d = 0; d < result.data().length; d++)
		{
			var dish = result.data()[d];

			// IE8 doesn't accept ISO8601 date, so we use hack from https://github.com/csnover/js-iso8601
			dish.DATE_ACTIVE_FROM = new Date(Date.parse(dish.DATE_ACTIVE_FROM));
			day = dish.DATE_ACTIVE_FROM.getUTCDay();

			if(!dishes[day])
				dishes[day] = [dish];
			else
				dishes[day].push(dish);
		}

		ds = new Date(this.dateStart.valueOf());
		for(var i = 0; i < 7; i++)
		{
			day = ds.getUTCDay();

			var item = $('<div class="menu-day"><div class="menu-date">'+this.getDay(ds)+', '+this.formatDate(ds)+'</div></div>');

			var list = $('<ul class="menu-list"></ul>').appendTo(item);

			if(!!dishes[day])
			{
				for(var d = 0; d < dishes[day].length; d++)
				{
					var dish = $('<li class="menu-list-item"></li>')
						.append(
							$('<span class="menu-list-name"></span>')
							.text(dishes[day][d].NAME)
						);

					if(this.options.payment)
					{
						$('<span class="menu-list-price"></span>')
							.text(this.formatPrice(dishes[day][d].PROPERTY_VALUES.price))
							.appendTo(dish);
					}

					if(this.bCanEdit)
					{
						$('<span class="menu-list-delete"></span>')
							.on('click', gcbd(dishes[day][d].ID))
							.appendTo(dish);
					}

					dish.appendTo(list);
				}
			}

			if(this.bCanEdit)
			{
				$('<div class="menu-add"></div>')
					.text(window.menuMessage.MENU_DISH_ADD)
					.on('click', gcbe(ds.valueOf(), list))
					.appendTo(item);

				$('<div class="menu-share"></div>')
					.text(window.menuMessage.MENU_DISH_SHARE)
					.on('click', gcbs(item))
					.appendTo(item);
			}

			if(ds.valueOf() == today.valueOf())
				item.addClass('menu-day-today');

			item.appendTo(this.parts.weekMenu);
			ds.setUTCDate(ds.getUTCDate() + 1);
		}
	}

	BX24.fitWindow();
};

window.menuApp.prototype.buildAdmin = function()
{
	if(this.access == 'admin')
	{
		if(!this.parts.settingsButton)
		{
			this.parts.settingsButton = $('<span class="menu-settings"></span>')
				.on('click', $.proxy(this.settingsForm, this))
				.appendTo(this.div);
		}
	}
};

window.menuApp.prototype.settingsForm = function()
{
	if(this.access == 'admin')
	{
		this.div.detach();
		window.menuAppInstaller.makeHtml();
		window.menuAppInstaller.init($.proxy(function(){
			$('#install').replaceWith(this.div);
			this.init();
			this.ready();
		}, this));
	}
};

window.menuApp.prototype.addForm = function(ts, list)
{
	if(this.bCanEdit)
	{
		if(!this.parts.addForm)
		{
			this.parts.addForm = $('<li class="menu-list-item menu-list-item-edit"><form name="add_form"><input type="hidden" name="TS"><input type="hidden" name="ID"><span class="menu-list-name"><input type="text" class="input-name" name="NAME" placeholder="'+window.menuMessage.MENU_DISH_NAME+'" autocomplete="off" /></span>' + (this.options.payment ? '<span class="menu-list-price"><input type="text" class="input-price" name="PRICE" placeholder="'+window.menuMessage.MENU_DISH_PRICE+'" />&nbsp;'+this.options.currency : '')+'</span></form></li>')
				.hide()
				.appendTo(list)
				.slideDown(100, BX24.fitWindow);
			$('input', this.parts.addForm).keyup($.proxy(function(e)
				{
					if(e.keyCode == 13)
					{
						if(e.target.name == 'NAME' && e.target.value != '' && this.options.payment && document.forms.add_form.PRICE.value == '')
						{
							document.forms.add_form.PRICE.focus();
						}
						else if(document.forms.add_form.NAME.value.length > 0)
						{
							this.add();
							$('.menu-add').text(window.menuMessage.MENU_DISH_ADD)
						}
					}
					else if(e.keyCode == 27)
					{
						document.forms.add_form.NAME.value = '';
						this.parts.addForm.slideUp(100, BX24.fitWindow);
						$('.menu-add').text(window.menuMessage.MENU_DISH_ADD)
					}
					else if(e.target.name == 'NAME')
					{
						this.loadHint();
					}
				}, this)
			);
			$('input.input-name', this.parts.addForm)
				.focus($.proxy(this.loadHint, this))
				.blur($.proxy(this.closeHint, this));
		}
		else if($(list).children().index(this.parts.addForm) >= 0)
		{
			if(document.forms.add_form.NAME.value.length > 0)
			{
				$('.menu-add').text(window.menuMessage.MENU_DISH_ADD)
				this.add();
			}
			else
			{
				document.forms.add_form.NAME.value = '';
				this.parts.addForm.slideToggle(100, BX24.fitWindow);
			}
		}
		else
		{
			this.parts.addForm.appendTo(list);
			this.parts.addForm.slideDown(100, BX24.fitWindow);
		}

		$('.menu-add').text(window.menuMessage.MENU_DISH_ADD)

		if(this.parts.addForm.is(':visible'))
			$('.menu-add', list.parent()).text(window.menuMessage.MENU_DISH_SAVE);

		document.forms.add_form.TS.value = ts.toJSON();
		try{document.forms.add_form.NAME.focus();}catch(e){};
	}
};

window.menuApp.prototype.hideForm = function()
{
	this.parts.addForm.hide(400, 'slide');
};

window.menuApp.prototype.add = function()
{
	if(this.bCanEdit)
	{
		if(!!document.forms.add_form.NAME._value
			&& document.forms.add_form.NAME.value != document.forms.add_form.NAME._value)
		{
			document.forms.add_form.ID.value = '';
		}

		document.forms.add_form.NAME._value = null;

		var batch = [],
			dish = {
				ENTITY: 'dish',
				NAME: document.forms.add_form.NAME.value,
				PROPERTY_VALUES: {}
			};

		if(document.forms.add_form.ID.value > 0)
		{
			dish.ID = document.forms.add_form.ID.value;
		}

		dish["FILTER"] = {">=test" : "test"};

		batch = [
			["entity.item." + (!!dish.ID ? "update" : "add"), dish],
			['entity.item.add', {
				ENTITY: 'menu',
				NAME: dish.NAME,
				DATE_ACTIVE_FROM: document.forms.add_form.TS.value,
				PROPERTY_VALUES: {
					dish: !!dish.ID ? dish.ID : '$result[0]'
				}
			}]
		];

		if(this.options.payment)
		{
			batch[0][1].PROPERTY_VALUES.price = batch[1][1].PROPERTY_VALUES.price = document.forms.add_form.PRICE.value;
		}

		BX24.callBatch(batch, $.proxy(function(res) {
			// if(!res.error())
			// {
				this.parts.addForm.hide();
				this.hints_data = {};

				if(!!document.forms.add_form)
				{
					document.forms.add_form.NAME.value = '';
					document.forms.add_form.ID.value = '';
					if(!!document.forms.add_form.PRICE)
						document.forms.add_form.PRICE.value = '';
				}

				this.loadData(this.dateStart, this.dateFinish);
			// }
			// else
			// {
			// 	alert(res.error());
			// }
		}, this), true);

	}
};

window.menuApp.prototype.del = function(id)
{
	if(this.bCanEdit)
	{
		BX24.callMethod('entity.item.delete', {
			ENTITY: 'menu',
			ID: id
		}, $.proxy(function(res){
			if(res.error())
				throw res.error();
			else
				this.loadData(this.dateStart, this.dateFinish);
		}, this));
	}
};

window.menuApp.prototype.share = function(item)
{
	var list =  $('.menu-list-item', item),
		message = '',
		bPrice = this.options.payment;

	if(list.length > 0)
	{
		list.each(function(){
			var t = $('.menu-list-name', $(this)).text();
			if(t != '')
			{
				message += '[*]'
					+ t
					+ (bPrice ? (' - ' + $('.menu-list-price', $(this)).text()) : '')
			}
		});

		if(message.length > 0)
		{
			var params = {
				POST_TITLE: window.menuMessage.MENU_DISH_SHARE_TITLE
					.replace('#DATE#', $('.menu-date', item).text()),
				POST_MESSAGE: '[LIST]' + message + '[/LIST]'
			};

			BX24.callMethod('log.blogpost.add', params, function(r){
				if(!r.error())
				{
					$('.menu-share', item)
						.text(window.menuMessage.MENU_DISH_SHARED)
						.addClass('menu-share-finished')
						.off('click')
				}
			});

			return;
		}
	}

	$('.menu-share', item).effect("bounce", "slow");
};

window.menuApp.prototype.loadHint = function()
{
	if(this.bCanEdit)
	{
		if(document.forms.add_form)
		{
			if(!!this.hintTimeout)
			{
				clearTimeout(this.hintTimeout);
			}

			this.hintTimeout = setTimeout($.proxy(this.getHint, this), 500);
		}
	}
};

window.menuApp.prototype.getHint = function()
{
	if(this.bCanEdit)
	{
		if(document.forms.add_form)
		{
			var start = document.forms.add_form.NAME.value,
				cb = $.proxy(function(data){
					this.hints_data[start] = data;
					this.updateHint(data);
				}, this);
			if(!this.hints_data[start])
			{
				BX24.callMethod('entity.item.get', {
					ENTITY: 'dish',
					SORT: {
						DATE_CREATE: 'DESC',
						NAME: 'ASC'
					},
					FILTER: {
						'NAME': start + '%'
					}
				}, $.proxy(function(res){
					if(res.error())
					{
						throw res.error();
					}
					else
					{
						cb(res.data());
					}
				}, this));
			}
			else
			{
				cb(this.hints_data[start]);
			}
		}
	}
};

window.menuApp.prototype.setFormData = function(ID, NAME, PRICE)
{
	this.closeHint();
	if(document.forms.add_form)
	{
		document.forms.add_form.ID.value = ID;
		document.forms.add_form.NAME.value = NAME;
		document.forms.add_form.NAME._value = NAME;

		if(!!this.options.payment)
			document.forms.add_form.PRICE.value = PRICE;
	}
};

window.menuApp.prototype.updateHint = function(data)
{
	var cbh = $.proxy(this.setFormData, this),
		gcbh = function(ID, NAME, PRICE)
		{
			return function(){
				cbh(ID, NAME, PRICE);
			}
		};

	if(!this.addFormHint)
	{
		this.addFormHint = $('<div class="input-name-hint"></div>').hide();
	}

	this.addFormHint.empty();
	if(data.length > 0)
	{
		for(var i = 0; i < Math.min(data.length, 10); i++)
		{
			$('<div class="input-name-hint-item"></div>')
				.text(data[i].NAME)
				.appendTo(this.addFormHint)
				.on('click', gcbh(data[i].ID, data[i].NAME, data[i].PROPERTY_VALUES.price))
		}
	}

	this.addFormHint.css('top', $('li.menu-list-item-edit').height());

	this.addFormHint.slideDown(100, BX24.fitWindow);
	$('li.menu-list-item-edit').append(this.addFormHint);
};

window.menuApp.prototype.closeHint = function()
{
	if(!!this.addFormHint)
	{
		setTimeout($.proxy(function(){
			this.addFormHint.slideUp(100, BX24.fitWindow);
		}, this), 50);
	}
};

window.menuApp.prototype.nullifyDate = function(date)
{
	date.setUTCHours(0);
	date.setUTCMinutes(0);
	date.setUTCSeconds(0);
	date.setUTCMilliseconds(0);

	return date;
};

window.menuApp.prototype.formatDate = function(ds, df)
{
	return this.pad(ds.getUTCDate()) + '.' + this.pad(ds.getUTCMonth()+1) + '.' + (!!df
		? (' - ' + this.pad(df.getUTCDate()) + '.' + this.pad(df.getUTCMonth()+1) + '.' + df.getUTCFullYear())
		: ds.getUTCFullYear()
	);
};

window.menuApp.prototype.formatPrice = function(price)
{
	var str_price = (parseFloat(price)||0).toFixed(2) + '';

	if(str_price.length > 6)
	{
		for(var i = str_price.length-6; i > 0; i-= 3)
		{
			str_price = str_price.substring(0, i) + ' ' + str_price.substring(i, str_price.length);
		}
	}

	return str_price + ' ' + this.options.currency
};

window.menuApp.prototype.getDay = function(d)
{
	return window.menuMessage['WD' + d.getUTCDay()];
};

window.menuApp.prototype.pad = function(str)
{
	str += '';
	if(str.length < 2)
		str = '0' + str;
	return str;
};

window.menuAppInstaller = {
	init: function(cb)
	{
		BX24.setTitle(window.menuMessage.TITLE_INSTALL);
		window.menuAppInstaller.make(cb);
		$('#install').show();
	},
	make: function(finishCallback)
	{
		var options = BX24.appOption.get('options')||{},
			installData = {ACCESS:{}};
			bPayment = options.payment !== "0" && options.payment !== false;

		var cb_delete = function(right, node)
			{
				installData.ACCESS[right] = false;
				$(node).remove();
			},
			gcb_delete = function(right, node)
			{
				return function()
				{
					cb_delete(right, node);
				}
			};

		var make_rights_list = function(access){
			var s = '';

			for(var i = 0; i < access.length; i++)
			{
				if(access[i].id == 'AU' || access[i].id == 'G2')
					continue;

				var node = $('<li></li>');
				node.append(
					$('<span class="install-rights-item"></span>')
						.text(access[i].name)
						.append(
							$('<span class="menu-list-delete"></span>')
							.on('click', gcb_delete(access[i].id, node))
						)
				);
				node.appendTo($('#install_rights_result'));

				installData.ACCESS[access[i].id] = true;
			}
		};

		$('#install_payment_label').text(window.menuMessage.INST_PAYMENT);

		if(!bPayment)
		{
			$('#install_payment').removeAttr('checked');
		}

		$('#install_payment').bind('click', function()
		{
			if(this.checked)
				$('#install_payment_currency').slideDown();
			else
				$('#install_payment_currency').slideUp();
		});

		if(!bPayment)
		{
			$('#install_payment_currency').hide();
		}

		$('#install_payment_currency').prepend($('<span class="install-label"></span>').text(window.menuMessage.INST_PAYMENT_CURRENCY));
		$('#install_payment_currency>input').val(options.currency || window.menuMessage.INST_PAYMENT_CURRENCY_DEF);

		$('#install_rights')
			.append($('<span></span>').addClass('install-rights-caption').text(window.menuMessage.INST_SET_ACCESS))
			.append($('<span></span>').addClass('install-rights-requires').text('*'))
			.on('click', function(){
				var v = [];
				for(var i in installData.ACCESS)
				{
					if(installData.ACCESS[i] === true)
						v.push(i);
				}

				BX24.selectAccess('', v, make_rights_list);
			});

		if(!!options.access && options.access.length > 0)
		{
			for(var i = 0; i < options.access.length; i++)
			{
				installData.ACCESS[options.access[i]] = true;
			}

			BX24.callMethod('access.name', {ACCESS:options.access}, function(res)
			{
				if(!res.error())
				{
					var data = res.data(), access = [];
					for(var i in data)
					{
						access.push({
							id: i,
							name: data[i].name,
							provider: data[i].provider
						})
					}

					make_rights_list(access);
				}
			});
		}

		var defStart = options.week_start || (BX24.getLang() == 'en' ? 0 : 1);
		$('#install_weekstart').prepend($('<span class="install-label"></span>').text(window.menuMessage.INST_WS));
		for(var i = 0; i < 7; i++)
		{
			$('#week_start').append($('<option value="'+i+'">'+window.menuMessage['WD' + i]+'</option>').attr('selected', i == defStart));
		}

		$("#install_finish").text(window.menuMessage.INST_FINISH).on('click', function()
		{
			installData.PAYMENT = $('#install_payment').is(':checked');
			installData.PAYMENT_CURRENCY = $('#install_payment_currency>input').val();
			installData.WEEK_START = $('#week_start').val();

			var access = [],
				entity_access = {'AU':'R'},
				bAccess = false;
			for(var i in installData.ACCESS)
			{
				if(installData.ACCESS[i] === true)
				{
					entity_access[i] = 'W';
					access.push(i);
					bAccess = true;
				}
			}

			if(!bAccess)
			{
				$('#install_rights').effect("bounce", "slow");
			}
			else
			{
				var batch = [];

				batch.push(['entity.add', {'ENTITY': 'dish', 'NAME': 'Dishes', 'ACCESS': entity_access}]);
				batch.push(['entity.update', {'ENTITY': 'dish', 'ACCESS': entity_access}]);
				batch.push(['entity.add', {'ENTITY': 'menu', 'NAME': 'Menu', 'ACCESS': entity_access}]);
				batch.push(['entity.update', {'ENTITY': 'menu', 'ACCESS': entity_access}]);
				batch.push(['entity.item.property.add', {ENTITY: 'menu', PROPERTY: 'dish', NAME: 'Dish', TYPE: 'N'}]);

				if(installData.PAYMENT)
				{
					batch.push(['entity.item.property.add', {ENTITY: 'dish', PROPERTY: 'price', NAME: 'Price', TYPE: 'N'}]);
					batch.push(['entity.item.property.add', {ENTITY: 'menu', PROPERTY: 'price', NAME: 'Price', TYPE: 'N'}]);
				}

				var options = {payment: installData.PAYMENT?1:0, currency: installData.PAYMENT_CURRENCY, week_start: installData.WEEK_START, access: access};

				var q = 2, e = function(){
					if((--q) <= 0)
					{
						finishCallback.apply(document);
					}
				};

				BX24.callBatch(batch, e);
				BX24.appOption.set('options', options, e);
			}
		});
	},

	makeHtml: function(node)
	{
		$('<div id="install"></div>')
			.html('<div class="install-group"><div id="install_weekstart"><select id="week_start"></select></div></div><div class="install-group"><label for="install_payment" class="install-label" id="install_payment_label"></label><input type="checkbox" id="install_payment" checked="checked" /><div id="install_payment_currency"><input type="text" /></div></div><div class="install-group"><div id="install_rights"></div><ul id="install_rights_result"></ul></div><div id="install_finish"></div>')
			.appendTo($(node||'body'));
	}
};
})();