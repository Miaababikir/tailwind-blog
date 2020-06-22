module.exports = {
    purge: [],
    theme: {
        fontFamily: {
            'base': 'Inter',
        },
        extend: {
            spacing: {
                '96': '24rem',
            },
        },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/custom-forms'),
    ],
};
