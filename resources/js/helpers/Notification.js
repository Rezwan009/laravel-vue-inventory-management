class Notification {

    success() {
        new Noty({
            type: 'success',
            layout: "topRight",
            text: 'Successfully done..',
            timeout: 1000,

        }).show();
    }


    error() {
        new Noty({
            type: 'danger',
            layout: "topRight",
            text: 'Something went wrong!!',
            timeout: 1000,

        }).show();

    }

    alert() {
        new Noty({
            type: 'alert',
            layout: "topRight",
            text: 'Ary you sure?',
            timeout: 1000,

        }).show();

    }
    warning() {
        new Noty({
            type: 'warning',
            layout: "topRight",
            text: 'Opps wrong!!',
            timeout: 1000,

        }).show();

    }

}

export default Notification = new Notification();