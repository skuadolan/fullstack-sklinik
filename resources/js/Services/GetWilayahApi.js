import axios from 'axios'

const wilayahApi = {
  async getProvinsi() {
    try {
      const datas = await axios.get('/api/v1/search/wilayah/provinsi');
      toastrCustomize("info", "Info!", datas?.data.message);
      
      return datas?.data;
    } catch (error) {
      toastrCustomize("error", "Kesalahan!", error?.response?.data?.message);
    }
  },
  async getKabupaten(provinsiId) {
    try {
      const datas = await axios.get(`/api/v1/search/wilayah/kabupaten/${provinsiId}`);
      toastrCustomize("info", "Info!", datas?.data.message);
      
      return datas?.data;
    } catch (error) {
      toastrCustomize("error", "Kesalahan!", error?.response?.data?.message);
    }
  },
  async getKecamatan(kabupatenId) {
    try {
      const datas = await axios.get(`/api/v1/search/wilayah/kecamatan/${kabupatenId}`);
      toastrCustomize("info", "Info!", datas?.data.message);
      
      return datas?.data;
    } catch (error) {
      toastrCustomize("error", "Kesalahan!", error?.response?.data?.message);
    }
  },
 async getKelurahan(kecamatanId) {
  try {
      const datas = await axios.get(`/api/v1/search/wilayah/kelurahan/${kecamatanId}`);
      toastrCustomize("info", "Info!", datas?.data.message);
      
      return datas?.data;
    } catch (error) {
      toastrCustomize("error", "Kesalahan!", error?.response?.data?.message);
    }
  }
};

export default wilayahApi;