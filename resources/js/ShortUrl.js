export default {
    init() {
        this.instances = {
            btn: $('.js-url-btn'),
            input: $('.js-url-input'),
            errors: $('.errors'),
            lastWrapper: $('.js-last-short-urls')
        }

        this.loadLast();
        this.events();
    },
    events() {
        let _this = this;

        this.instances.btn.click(function () {
            _this.instances.errors.html('');

            $(this).prop('disabled', true);

            _this.save($('.js-url-input').val());
        });
    },

    save(url) {
        let _this = this;

        if (!url) {
            alert('Введите url!');
            this.instances.btn.prop('disabled', false);
            return;
        }

        $.post('/api/short-urls', {destination_url: url})
            .then(() => {
                _this.instances.input.val('');

                _this.instances.btn.prop('disabled', false);

                _this.loadLast();
            })
            .catch((xhr, status, error) => {
                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function (key, val) {
                        _this.instances.errors.append("<li style='color: red'>" + val[0] + "</li>")
                    });

                    return;
                }

                this.instances.btn.prop('disabled', false);

                alert('Ошибка генерации.')
            });
    },

    loadLast() {
        let _this = this;

        $.get('/api/short-urls/latest')
            .then((response) => {
                let items = '';

                $.each(response.data, function (index, item) {
                    items += '<li><a href="' + item.url + '">' + item.url + '</a></li>'
                });

                _this.instances.lastWrapper.html(items);
            })

    }
}
