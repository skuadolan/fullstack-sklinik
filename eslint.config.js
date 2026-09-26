import pluginVue from 'eslint-plugin-vue';
import vueTsEslintConfig from '@vue/eslint-config-typescript';
import prettier from 'eslint-plugin-prettier/recommended';

export default [
  ...pluginVue.configs['flat/recommended'],
  ...vueTsEslintConfig(),
  prettier, // ← Harus di akhir agar override rule ESLint yang konflik
  {
    files: ['resources/**/*.{ts,vue}'],
    rules: {
      'prettier/prettier': 'warn',
    },
  },
];