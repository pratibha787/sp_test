path = "C:/Users/ashok/Downloads/Data_interview.2030/" \
           "Data_interview/20301112_8_20301112_23/DM_values.txt"

with open(path) as data_file:
    data = data_file.readlines()
    formatted_data = [string.replace("\n", "") for string in data if string != ""]
    formatted_data = [string.replace("  ", "") for string in formatted_data if string != ""]

    column1 = [int(int(number) / 10) for number in formatted_data]
    column2 = [int(int(number) % 10) for number in formatted_data]

    columns = [column1, column2]

    # print(columns)

    print("Folder Name: 20301112_8_20301112_23")
    print("File Name: DM_values.txt")

    print("\n\n")

    print("Serial No." "\t" + "Column A" + "\t" + "Column B")

    for x in range(1, len(column1) + 1):
        print(x, "\t\t\t", columns[0][x - 1], "\t\t\t", columns[1][x - 1])