var Onestep = Class.create();
Onestep.prototype = {
	initialize: function(saveUrl, successUrl, parentId){
		this.saveUrl = saveUrl;
		this.successUrl = successUrl;
		this.parentId = parentId;
		this.onSave = this.nextStep.bindAsEventListener(this);
		this.onComplete = this.resetLoadWaiting.bindAsEventListener(this);
	},

	save: function(){
		var validator = new Validation(this.parentId);
		if(validator.validate()){
			checkout.setLoadWaiting('payment');
			var request = new Ajax.Request(
				this.saveUrl,
				{
					method: 'post',
					onComplete: this.onComplete,
					onSuccess: this.onSave,
					onFailure: checkout.ajaxFailure.bind(checkout),
					parameters: Form.serialize(this.parentId)
				}
			);
		}
	},

	resetLoadWaiting: function(transport){
		checkout.setLoadWaiting(false, this.isSuccess);
	},
	nextStep: function(transport){},
	isSuccess: false
}