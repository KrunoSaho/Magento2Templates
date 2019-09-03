define(
    ['jquery', 'ko', 'uiComponent'],
    function ($, ko, Component) {
        var self = null;

        return Component.extend({
            initialize: function (obj) {
                self = this;

                this._super();
                this.myData = JSON.parse(obj.myData);

                return this;
            },

            output: function () {
                /** @type {Object.<string, number>}*/
                const data = self.myData;
                return `${data.a}, ${data.b}`;
            }
        });
    });
