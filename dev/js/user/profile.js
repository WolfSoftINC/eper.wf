class Profile{
    static gl(id) {
        var url = 'profile';
        var str = "";

        str += 'gl=1';

        if (data['user_id'])
        {
            str += "&user_id=" + data['user_id'];
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: str,
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            
            success: function(list){
                console.log(list);

                list = JSON.parse(list);
                
                // initial view
                
                var row = Profile.initial_row(list['login'], "Логин", "login");
                $("#profile_list").append(row);

                var row = Profile.initial_row(list['name'], "Имя", "name");
                $("#profile_list").append(row);
                
                var row = Profile.initial_row(list['phone'], "Номер телефона", "phone");
                $("#profile_list").append(row);
                
                var row = Profile.initial_row(list['mail'], "E-mail", "mail");
                $("#profile_list").append(row);
                
                var row = Profile.password_row("Пароль", "password");
                $("#profile_list").append(row);
                
                // Click edit_button

                $('#login_button').click(function() {
                    Profile.update_login(list, url, 1);
                });

                $('#name_button').click(function() {
                    Profile.update_name(list, url, 1);
                });
                
                $('#phone_button').click(function() {
                    Profile.update_phone(list, url, 1);
                });
                
                $('#mail_button').click(function() {
                    var row = Profile.edit(list['mail'], "Email", "mail");
                    $('#mail_block').remove();
                    $('#phone_block').after(row);
                });
                
                $('#password_button').click(function() {
                    var row = Profile.password_edit("Пароль", "password");
                    $('#password_block').remove();
                    $('#mail_block').after(row);
                });
            }
        });
    }
    
    //Initial text

    static initial_row(value, text, id) {
        var row = $('<div/>', {
            class: "block",
            id: id + "_block",
        });
        
        var _text = $('<p>',{
            text: text + " :",
            id: id + "_text",
        });
        row.append(_text);

        var _value = $('<p>',{
            text: value,
            id: id + "_value",
        });
        row.append(_value);

        var _button = $('<button>', {
            text: 'Изменить',
            id: id + '_button'
        });
        row.append(_button);

        return row;
    }

    // password initial text

    static password_row(text, id) {
        var row = $('<div/>', {
            class: "block",
            id: id + "_block",
        });
        
        var _text = $('<p>',{
            text: text + " :",
            id: id + "_text",
        });
        row.append(_text);

        var _button = $('<button>', {
            text: 'Изменить',
            id: id + '_button'
        });
        row.append(_button);

        return row;
    }

    // edit

    static edit(value, text, id) {
        var row = $('<div/>', {
            class: "block",
            id: id + "_block",
        });
        
        var _text = $('<p>',{
            text: text + " :",
            id: id + "_text",
        });
        row.append(_text);

        var _value = $('<input>',{
            value: value,
            placeholder: "Введите " + text,
            id: id + "_value",
        });
        row.append(_value);

        var _button = $('<button>', {
            text: 'Сохранить',
            id: id + '_update_button'
        });
        row.append(_button);
        
        var _button = $('<button>', {
            text: 'Отменить',
            id: id + '_cancel_button'
        });
        row.append(_button);

        return row;
    }

    // password edit

    static password_edit(text, id) {
        var row = $('<div/>', {
            class: "block",
            id: id + "_block",
        });
        
        var _text = $('<p>',{
            text: text + " :",
            id: id + "_text",
        });
        row.append(_text);

        var _value = $('<input>',{
            type: "password",
            placeholder: "Введите " + text,
            id: id + "_value",
        });
        row.append(_value);

        var _value = $('<input>',{
            type: "password",
            placeholder: "Повторите " + text,
            id: id + "_value",
        });
        row.append(_value);
        

        var _button = $('<button>', {
            text: 'Сохранить',
            id: id + '_update_button'
        });
        row.append(_button);
        
        var _button = $('<button>', {
            text: 'Отменить',
            id: id + '_cancel_button'
        });
        row.append(_button);

        return row;
    }

    //Update Login
    static update_login(list, url, type) {
        if (type == 1)
        {
            var row = Profile.edit(list['login'], "Логин", "login");
            $('#login_block').remove();
            $('#profile_list').prepend(row);
            
            $('#login_update_button').click(function(){
                Profile.update_login(list, url, 0);
            });
            $('#login_cancel_button').click(function(){
                var row = Profile.initial_row(list['login'], "Логин", "login");
                $('#login_block').remove();
                $('#profile_list').prepend(row);
                
                $('#login_button').click(function() {
                    Profile.update_login(list, url, 1);
                });
            });
            return;
        }

        var str = "login=1&user_id=" + list['user_id'] + "&user_login=" + $('#login_value').val();
        $.ajax({
            url: url,
            type: 'POST',
            data: str,
            success: function(data){
                data = JSON.parse(data);

                if (data == false)
                {
                    alert("Ошибка логина!");
                    data = list['login'];
                }
                else
                {
                    list['login'] = data;
                }

                var row = Profile.initial_row(data, "Логин", "login");
                $('#login_block').remove();
                $('#profile_list').prepend(row);
                
                $('#login_button').click(function(){
                    Profile.update_login(list, url, 1);
                });
            }
        });
    }

    //Update name
    static update_name(list, url, type) {
      
        if (type == 1)
        {
            var row = Profile.edit(list['name'], "Имя", "name");
            $('#name_block').remove();
            $('#login_block').after(row);

            $('#name_update_button').click(function(){
                Profile.update_name(list, url, 0);
            });

            $('#name_cancel_button').click(function(){
                var row = Profile.initial_row(list['name'], "Имя", "name");
                $('#name_block').remove();
                $('#login_block').after(row);

                $('#name_button').click(function() {
                    Profile.update_name(list, url, 1);
                });
            });

            return;
        }

        var str = "name=1&user_id=" + list['user_id'] + "&user_name=" + $('#name_value').val();
        $.ajax({
            url: url,
            type: 'POST',
            data: str,
            success: function(data){
                data = JSON.parse(data);

                if (data == false)
                {
                    alert("Ошибка имени!");
                    data = list['name'];
                }
                else
                {
                    list['name'] = data;
                }

                var row = Profile.initial_row(data, "Имя", "name");
                $('#name_block').remove();
                $('#login_block').after(row);
                
                $('#name_button').click(function(){
                    Profile.update_name(list, url, 1);
                });
            }
        });
    }

    //Update phone
    static update_phone(list, url, type) {
      
        if (type == 1)
        {
            var row = Profile.edit(list['phone'], "Номер телефона", "phone");
            $('#phone_block').remove();
            $('#name_block').after(row);

            $('#phone_update_button').click(function(){
                Profile.update_phone(list, url, 0);
            });

            $('#phone_cancel_button').click(function(){
                var row = Profile.initial_row(list['phone'], "Номер телефона", "phone");
                $('#phone_block').remove();
                $('#name_block').after(row);

                $('#phone_button').click(function() {
                    Profile.update_phone(list, url, 1);
                });
            });

            return;
        }

        var str = "phone=1&user_id=" + list['user_id'] + "&user_name=" + $('#phone_value').val();

        $.ajax({
            url: url,
            type: 'POST',
            data: str,
            success: function(data){
                data = JSON.parse(data);

                if (data == false)
                {
                    alert("Ошибка Пароля!");
                    data = list['phone'];
                }
                else
                {
                    list['phone'] = data;
                }

                var row = Profile.initial_row(data, "Номер Телефона", "phone");
                $('#phone_block').remove();
                $('#name_block').after(row);
                
                $('#phone_button').click(function(){
                    Profile.update_phone(list, url, 1);
                });
            }
        });
    }
}
