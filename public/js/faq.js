var vm = new Vue({
    el: "#faq_fetch",
    data: {
        topics: [
            { title: 'Title 01', description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus accumsan mauris, ut aliquet massa iaculis nec. Aenean elementum, mi at bibendum pellentesque, enim justo tempor ligula, a ultrices nisl lacus et odio. Integer rhoncus ullamcorper odio a aliquam. ' },
            { title: 'Title 02', description: 'Phasellus pretium leo a semper bibendum. Duis venenatis lacus metus, in fringilla quam eleifend ac.' },
            { title: 'Title 03', description: 'Aenean pharetra, lacus vitae commodo condimentum, nibh ante tempor ante, id interdum orci ipsum eu augue. Aenean varius euismod purus et malesuada. Ut elementum ex eget lacus efficitur tincidunt.' },
            { title: 'Title 04', description: 'Vivamus faucibus consequat urna, sed vestibulum est. Suspendisse cursus eleifend ex, nec gravida orci. Quisque nec tellus quis mi aliquet aliquam id vel purus.' },
            { title: 'Title 05', description: 'In hac habitasse platea dictumst. Vivamus aliquet eleifend lacus suscipit tincidunt. Vivamus eros dui, efficitur ut quam eu, aliquam mollis nibh. Phasellus sapien lorem, pellentesque ullamcorper tempor sit amet, ultricies a ante. Pellentesque lobortis ante sit amet velit pretium, vel suscipit arcu pharetra. Praesent urna dolor, semper ac metus at, pellentesque cursus enim. Etiam in lobortis mi. Curabitur in molestie lectus. Etiam sed tortor massa. Fusce elit mi, molestie nec risus a, cursus vulputate magna. Suspendisse dapibus, libero nec malesuada suscipit, felis erat accumsan est, sed tempus ligula nulla id turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris lacinia pharetra metus ac sagittis. Nulla aliquet luctus est a sollicitudin.' },
            { title: 'Title 06', description: 'In hac habitasse platea dictumst. Vivamus aliquet eleifend lacus suscipit tincidunt. Vivamus eros dui, efficitur ut quam eu, aliquam mollis nibh. Phasellus sapien lorem, pellentesque ullamcorper tempor sit amet, ultricies a ante. Pellentesque lobortis ante sit amet velit pretium, vel suscipit arcu pharetra. Praesent urna dolor, semper ac metus at, pellentesque cursus enim. Etiam in lobortis mi. Curabitur in molestie lectus. Etiam sed tortor massa. Fusce elit mi, molestie nec risus a, cursus vulputate magna. Suspendisse dapibus, libero nec malesuada suscipit, felis erat accumsan est, sed tempus ligula nulla id turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris lacinia pharetra metus ac sagittis. Nulla aliquet luctus est a sollicitudin.' }
        ],
        filterWord: ""
    },
    computed: {
        filteredTopics() {
            var fw = this.filterWord.toLowerCase();

            // return topic based on a condition
            return this.topics.filter(topic => {
                // return all topics if there's no filter word
                if (fw == "") {
                    return topic;
                } else {
                    // return topic if filter word is found in title or description
                    if (topic.title.toLowerCase().indexOf(fw) != -1 || topic.description.toLowerCase().indexOf(fw) != -1) {
                        return topic;
                    }
                }
            });
        }
    },
    methods: {
        disparo: function (event) {
            var _self = event.target,
                parentTitle = _self.parentNode.parentNode,
                parentToggle = _self.parentNode.parentNode.parentNode,
                descriptionToggle = parentToggle.querySelectorAll('.toggle-inner')[0];

            if (parentTitle.classList.contains('active')) {
                parentTitle.classList.remove('active');
                descriptionToggle.style.display = 'none';
            } else {
                parentTitle.classList.add('active');
                descriptionToggle.style.display = 'block';
            }

        }
    }
});